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
        // ---------------------------------------------
        // 1. Users
        // ---------------------------------------------
        $usersData = [
            ['name' => 'Asep Bensin', 'email' => 'asep@example.com', 'phone_number' => '081234567890'],
            ['name' => 'Aisyah Nurul', 'email' => 'aisyah@example.com', 'phone_number' => '081234567891'],
            ['name' => 'Iwan Setiawan', 'email' => 'iwan@example.com', 'phone_number' => '081234567892'],
            ['name' => 'Siti Aminah', 'email' => 'siti@example.com', 'phone_number' => '081234567893'],
            ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone_number' => '081234567894'],
        ];
        $users = [];
        foreach ($usersData as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'password' => Hash::make('password'),
            ]);
            $users[] = $user;
        }

        // ---------------------------------------------
        // 2. Cars
        // ---------------------------------------------
        $carsData = [
            ['name' => 'Toyota Avanza', 'price' => 350000, 'color' => 'Silver', 'seats' => 7, 'cc' => 1500, 'top_speed' => 180, 'description' => 'Mobil keluarga irit bahan bakar'],
            ['name' => 'Honda Civic', 'price' => 500000, 'color' => 'Black', 'seats' => 5, 'cc' => 1800, 'top_speed' => 220, 'description' => 'Mobil sporty dan cepat'],
            ['name' => 'Daihatsu Xenia', 'price' => 300000, 'color' => 'White', 'seats' => 7, 'cc' => 1300, 'top_speed' => 175, 'description' => 'Praktis untuk keluarga kecil'],
            ['name' => 'Honda Jazz', 'price' => 450000, 'color' => 'Red', 'seats' => 5, 'cc' => 1500, 'top_speed' => 200, 'description' => 'Lincah di kota'],
            ['name' => 'Toyota Innova', 'price' => 600000, 'color' => 'Blue', 'seats' => 8, 'cc' => 2000, 'top_speed' => 190, 'description' => 'Kenyamanan maksimal'],
        ];
        $cars = [];
        foreach ($carsData as $data) {
            $car = Car::create(array_merge($data, ['status' => 'available']));
            $cars[] = $car;
        }

        // ---------------------------------------------
        // 3. Car Galleries
        // ---------------------------------------------
        foreach ($cars as $car) {
            CarGallery::create(['car_id' => $car->id, 'image_path' => "images/cars/{$car->id}-1.jpg"]);
            CarGallery::create(['car_id' => $car->id, 'image_path' => "images/cars/{$car->id}-2.jpg"]);
        }

        // ---------------------------------------------
        // 4. Bookings & Transactions
        // ---------------------------------------------
        foreach (range(0, 4) as $i) {
            $booking = Booking::create([
                'user_id' => $users[$i]->id,
                'car_id' => $cars[$i]->id,
                'booking_date' => now()->addDays($i + 1),
                'duration_days' => $i + 1,
                'status' => 'confirmed',
            ]);

            Transaction::create([
                'booking_id' => $booking->id,
                'amount' => $cars[$i]->price * ($i + 1),
                'payment_status' => 'paid',
            ]);
        }
    }
}
