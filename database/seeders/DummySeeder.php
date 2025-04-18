<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Car;
use App\Models\CarGallery;
use App\Models\Booking;
use App\Models\Transaction;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        // Users
        $user1 = User::create([
            'name' => 'Asep Bensin',
            'email' => 'asep@example.com',
            'phone_number' => '081234567890',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'Aisyah Nurul',
            'email' => 'aisyah@example.com',
            'phone_number' => '081234567891',
            'password' => Hash::make('password'),
        ]);

        // Cars
        $car1 = Car::create([
            'name' => 'Toyota Avanza',
            'price' => 350000,
            'color' => 'Silver',
            'status' => 'available',
            'seats' => 7,
            'cc' => 1500,
            'top_speed' => 180,
            'description' => 'Mobil keluarga irit bahan bakar',
        ]);

        $car2 = Car::create([
            'name' => 'Honda Civic',
            'price' => 500000,
            'color' => 'Hitam',
            'status' => 'available',
            'seats' => 5,
            'cc' => 1800,
            'top_speed' => 220,
            'description' => 'Mobil sporty dan cepat',
        ]);

        // Car Galleries
        CarGallery::create([
            'car_id' => $car1->id,
            'image_path' => 'images/cars/avanza-1.jpg',
        ]);
        CarGallery::create([
            'car_id' => $car1->id,
            'image_path' => 'images/cars/avanza-2.jpg',
        ]);
        CarGallery::create([
            'car_id' => $car2->id,
            'image_path' => 'images/cars/civic-1.jpg',
        ]);

        // Bookings
        $booking1 = Booking::create([
            'user_id' => $user1->id,
            'car_id' => $car1->id,
            'booking_date' => now()->addDays(1),
            'duration_days' => 3,
            'status' => 'pending',
        ]);

        $booking2 = Booking::create([
            'user_id' => $user2->id,
            'car_id' => $car2->id,
            'booking_date' => now()->addDays(2),
            'duration_days' => 2,
            'status' => 'confirmed',
        ]);

        // Transactions
        Transaction::create([
            'booking_id' => $booking1->id,
            'amount' => $car1->price * 3,
            'payment_status' => 'unpaid',
        ]);

        Transaction::create([
            'booking_id' => $booking2->id,
            'amount' => $car2->price * 2,
            'payment_status' => 'paid',
        ]);
    }
}
