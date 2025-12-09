<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
use App\Models\PackageDate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Nasrotul Ummah',
            'email' => 'admin@nasrotulummah.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '085710615365'
        ]);

        // Create sample user
        User::create([
            'name' => 'Syafrina Maulana',
            'email' => 'syafrinamaulana@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '081234567890',
            'address' => 'Jl. Contoh No. 123, Jakarta',
            'emergency_contact_name' => 'Ahmad',
            'emergency_contact_phone' => '081298765432'
        ]);

        // Create packages
        $packages = [
            [
                'name' => 'Umroh + Dubai',
                'slug' => 'umroh-dubai',
                'description' => 'Paket Umroh yang ditawarkan oleh Nasrotul Ummah adalah salah satu pilihan untuk melaksanakan Ibadah Umroh ke Tanah Suci sekaligus berwisata ke kota Dubai.',
                'duration_days' => 12,
                'type' => 'plus_dubai',
                'double_price' => 30000000,
                'triple_price' => 25000000,
                'quad_price' => 22000000,
                'airline' => 'Saudia Airlines',
                'hotel_madinah' => 'Concorde Al Khair 4**',
                'hotel_makkah' => 'Shuhada 5**',
                'facilities' => json_encode(['Flight Direct', 'City Tour Dubai', 'Buku Umroh Gratis']),
                'image_url' => 'umroh_dubai_potrait.png'
            ],
            [
                'name' => 'Umroh + Turki',
                'slug' => 'umroh-turki',
                'description' => 'Paket Umroh yang ditawarkan oleh Nasrotul Ummah adalah salah satu pilihan untuk melaksanakan Ibadah Umroh ke Tanah Suci sekaligus berwisata ke kota Turki.',
                'duration_days' => 12,
                'type' => 'plus_turki',
                'double_price' => 32000000,
                'triple_price' => 27000000,
                'quad_price' => 24000000,
                'airline' => 'Saudia Airlines',
                'hotel_madinah' => 'Concorde Al Khair 4**',
                'hotel_makkah' => 'Shuhada 5**',
                'facilities' => json_encode(['Flight Direct', 'City Tour Turki', 'Buku Umroh Gratis']),
                'image_url' => 'turki.jpeg'
            ],
            [
                'name' => 'Umroh Reguler',
                'slug' => 'umroh-reguler',
                'description' => 'Paket Umroh reguler dengan fokus utama pada ibadah umroh sesuai sunnah.',
                'duration_days' => 9,
                'type' => 'reguler',
                'double_price' => 25000000,
                'triple_price' => 20000000,
                'quad_price' => 18000000,
                'airline' => 'Saudia Airlines',
                'hotel_madinah' => 'Concorde Al Khair 4**',
                'hotel_makkah' => 'Shuhada 5**',
                'facilities' => json_encode(['Flight Direct', 'Kereta Cepat Haramain', 'Buku Umroh Gratis']),
                'image_url' => 'umroh_reguler_potrait.png'
            ]
        ];

        foreach ($packages as $packageData) {
            $package = Package::create($packageData);

            // Add dates for each package
            $dates = [
                [
                    'departure_date' => '2025-01-22',
                    'display_date' => '22 Januari 2025',
                    'available_slots' => 30
                ],
                [
                    'departure_date' => '2025-02-15',
                    'display_date' => '15 Februari 2025',
                    'available_slots' => 30
                ],
                [
                    'departure_date' => '2025-03-10',
                    'display_date' => '10 Maret 2025',
                    'available_slots' => 30
                ]
            ];

            foreach ($dates as $dateData) {
                PackageDate::create(array_merge($dateData, ['package_id' => $package->id]));
            }
        }

        // Create sample booking
        $booking = \App\Models\Booking::create([
            'user_id' => 2,
            'package_id' => 1,
            'package_date_id' => 1,
            'room_type' => 'triple',
            'total_price' => 25000000,
            'status' => 'confirmed',
            'payment_status' => 'paid'
        ]);
    }
}
