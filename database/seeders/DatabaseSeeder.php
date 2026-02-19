<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin OemahKori',
            'email' => 'admin@oemahkori.com',
            'password' => bcrypt('admin123'),
            'phone' => '081997186379',
            'role' => 'admin',
        ]);

        // Create sample guest
        User::create([
            'name' => 'Guest',
            'email' => 'guest@example.com',
            'password' => bcrypt('guest123'),
            'phone' => '+62 812 0000 0001',
            'role' => 'guest',
        ]);

        // Real OemahKori rooms
        $rooms = [
            [
                'name' => 'Jepun Room',
                'type' => 'standard',
                'description' => 'A cozy and comfortable room with a 160x200 bed, perfect for solo travelers or couples. Features include a private bathroom with shower & water heater, Smart TV, free WiFi, wardrobe, and workbench. Enjoy a peaceful night in our warmly decorated Jepun room adorned with floral artwork.',
                'price_per_night' => 300000,
                'capacity' => 2,
                'image' => 'rooms/jepun.jpg',
            ],
            [
                'name' => 'Melati Room',
                'type' => 'superior',
                'description' => 'A spacious room featuring a larger 180x200 bed with premium bedding. Equipped with a private bathroom with shower & water heater, Smart TV, free WiFi, wardrobe, and workbench. The Melati room offers a serene atmosphere with beautiful floral paintings and warm lighting for a restful stay.',
                'price_per_night' => 402500,
                'capacity' => 2,
                'image' => 'rooms/melati.jpg',
            ],
            [
                'name' => 'Cempaka Room',
                'type' => 'superior',
                'description' => 'A charming room with a 160x200 bed and a private balcony overlooking the surroundings. Features include a private bathroom with shower & water heater, Smart TV, free WiFi, wardrobe, and workbench. The Cempaka room is perfect for guests who enjoy fresh air and a view.',
                'price_per_night' => 402500,
                'capacity' => 2,
                'image' => 'rooms/cempaka.jpg',
            ],
            [
                'name' => 'Sandat Room',
                'type' => 'deluxe',
                'description' => 'Our most spacious room with a 180x200 bed and premium amenities. Features a private bathroom with shower & water heater, Smart TV, free WiFi, wardrobe, workbench, kitchen (for long-stay guests), dining table, sofa, and a private balcony. The Sandat room is ideal for extended stays and guests seeking extra space and comfort.',
                'price_per_night' => 460000,
                'capacity' => 2,
                'image' => 'rooms/sandat.jpg',
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
