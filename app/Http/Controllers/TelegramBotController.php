<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Models\Passenger;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Booking;
use App\Models\Carpool;

class TelegramBotController extends Controller
{
    private $telegramToken;

    public function __construct()
    {
        $this->telegramToken = env('TELEGRAM_BOT_TOKEN');
    }

    public function handleWebhook(Request $request)
    {
        Log::info('Telegram Webhook Received:', $request->all());
        
        $update = $request->all();
        if (!isset($update['message']) && !isset($update['callback_query'])) {
            Log::error('Invalid Telegram Update:', $update);
            return response()->json(['error' => 'Invalid request'], 400);
        }

        if (isset($update['callback_query'])) {
            $callbackData = $update['callback_query']['data'];
            $chatId = $update['callback_query']['message']['chat']['id'];
            Log::info("Button Clicked: {$callbackData}");
            return $this->handleCallback($chatId, $callbackData);
        }

        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = $message['text'] ?? '';

        Log::info("Chat ID: $chatId, Text: $text");

        if ($text === "/start") {
            return $this->handleStartCommand($chatId);
        }

        return response()->json(['status' => 'success']);
    }

    private function handleStartCommand($chatId)
    {
        $passenger = Passenger::where('chat_id', $chatId)->first();

        if ($passenger) {
            $this->sendMessage($chatId, "✅ Welcome back, {$passenger->name}! You are linked to UiTM Carpool.");
            $this->sendMenu($chatId);
        } else {
            $this->sendMessage($chatId, "❌ You are not registered. Please sign up on the website.");
        }
    }

    private function sendMenu($chatId)
    {
        $keyboard = [
            'inline_keyboard' => [
                [['text' => '📌 Show driver\'s details', 'callback_data' => 'show_driver_details']],
                [['text' => '🚗 Show car\'s details', 'callback_data' => 'show_car_details']],
                //[['text' => '💰 Show fare details', 'callback_data' => 'show_fare_details']],
                [['text' => '📆 Show booking status', 'callback_data' => 'show_booking_status']],
            ]
        ];

        $this->sendMessage($chatId, "✅ Choose an option below:", $keyboard);
    }

    private function handleCallback($chatId, $data)
    {
        switch ($data) {
            case 'show_driver_details':
                return $this->showDriverDetails($chatId);
            case 'show_car_details':
                return $this->showCarDetails($chatId);
            case 'show_fare_details':
                return $this->showFareDetails($chatId);
            case 'show_booking_status':
                return $this->showBookingStatus($chatId);
            case 'join_carpool':
                return $this->joinCarpool($chatId);
            default:
                return $this->sendMessage($chatId, "❌ Unknown command.");
        }
    }

    private function showDriverDetails($chatId)
    {
        $passenger = Passenger::where('chat_id', $chatId)->first();
        if (!$passenger) {
            return $this->sendMessage($chatId, "❌ You are not registered.");
        }

        $booking = Booking::where('passenger_id', $passenger->id)->first();
        if (!$booking) {
            return $this->sendMessage($chatId, "❌ No active booking found.");
        }

        $carpool = Carpool::find($booking->carpool_id);
        $driver = Driver::find($carpool->driverID);

        if (!$driver) {
            return $this->sendMessage($chatId, "❌ Driver details not available.");
        }

        $maskedstudentID = substr($driver->studentID, 0, 6) . 'XXXX';
        $message = "🚗 Driver Details:\n\n"
            . "👤 Name: {$driver->fullname}\n"
            . "🆔 Student ID: {$maskedstudentID}\n"
            . "📞 Phone: {$driver->phoneNum}\n"
            . "⚧ Gender: {$driver->gender}";

        return $this->sendMessage($chatId, $message);
    }

    private function showCarDetails($chatId)
    {
        $passenger = Passenger::where('chat_id', $chatId)->first();
        if (!$passenger) {
            return $this->sendMessage($chatId, "❌ You are not registered.");
        }

        $booking = Booking::where('passenger_id', $passenger->id)->first();
        if (!$booking) {
            return $this->sendMessage($chatId, "❌ No active booking found.");
        }

        $carpool = Carpool::find($booking->carpool_id);
        $car = Car::where('driverID', $carpool->driverID)->first();

        if (!$car) {
            return $this->sendMessage($chatId, "❌ car details not available.");
        }

        $message = "🚘 Car Details:\n\n"
            . "🚗 Model: {$car->carModel}\n"
            . "🔢 Plate: {$car->carPlate}\n"
            . "🎨 Color: {$car->carColor}\n"
            . "👥 Capacity: {$car->carCapacity}";

        return $this->sendMessage($chatId, $message);
    }

    private function showBookingStatus($chatId)
    {
        $passenger = Passenger::where('chat_id', $chatId)->first();
        if (!$passenger) {
            return $this->sendMessage($chatId, "❌ You are not registered.");
        }

        $booking = Booking::where('passenger_id', $passenger->id)->where('status', 'pending')->first();
        if (!$booking) {
            return $this->sendMessage($chatId, "❌ No active booking found.");
        }

        $carpool = carpool::find($booking->carpool_id);
        $message = "📆 Booking Status:\n\n"
            . "📍 Pickup: {$carpool->pickup_loc}\n"
            . "🎯 Destination: {$carpool->dropoff_loc}\n"
            . "🕒 Time: {$carpool->pickup_time}\n"
            . "👥 Passengers: {$booking->number_of_passengers}\n"
            . "🔄 Status: {$booking->status}";

        return $this->sendMessage($chatId, $message);
    }

    private function showFareDetails($chatId)
{
    // Fetch the latest active carpool
    $carpool = Carpool::with('car')->where('pickup_date', '>=', now())->first();

    if (!$carpool) {
        $message = "❌ No active carpool found.";
    } else {
        $car = $carpool->car;

        if (!$car || $car->carCapacity <= 0) {
            $message = "❌ car details are missing or invalid.";
        } else {
            // Count the number of passengers in this carpool
            $passengerCount = Booking::where('carpool_id', $carpool->id)
                                     ->where('status', 'accepted')
                                     ->count();

            // Base fare for the trip (example: RM20 total fare)
            $baseFare = 20.00;

            // Avoid division by zero
            $carpool-> fare_per_head = number_format($c->total_fare / $booking->number_of_passengers, 2);

            $message = "💰 Fare Details 💰\n\n"
                    . "📍 Pickup Location: " . $carpool->pickup_loc . "\n"
                     . "🛣  Destination: " . $carpool->dropoff_loc . "\n"
                     . "🚗 Car: " . $car->carModel . " (" . $car->carPlate . ")\n"
                     . "👥 Passengers Count: " . $booking->number_of_passengers . "\n"
                     . "💵 Fare per Passenger: RM" . $carpool->fare_per_head. "\n\n"
                     . "ℹ️ The more passengers join, the cheaper the fare!";
        }
    }

    $this->sendMessage($chatId, $message);
}

    private function sendMessage($chatId, $message, $keyboard = null)
    {
        $client = new Client(['verify' => false]);
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'HTML'
        ];
        if ($keyboard) {
            $data['reply_markup'] = json_encode($keyboard);
        }
        $url = "https://api.telegram.org/bot{$this->telegramToken}/sendMessage";
        $response = $client->post($url, ['json' => $data]);
        return json_decode($response->getBody(), true);
    }
}
