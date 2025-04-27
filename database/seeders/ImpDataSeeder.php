<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ImpDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'middle_name' => 'A',
            'last_name' => 'Admin',
            'gender' => 'Male',
            'mobile_no' => '9999999999',
            'email' => 'admin@admin.com',
            'is_verified' => true,
            'is_admin' => true,
            'details_complete' => true,
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('user_details')->insert([

            'user_id' => 1,
            'dob' => '1999-05-29',
            'pincode' => 396445,
            'city_id' => 986,
            'state_id' => 12,
            'country_id' => 101,
            'adhar_card_number' => 123456789012,
            'adhar_card_image' => '/assets/userDetails/1/adharcard/aadhaarCardImage.png',
            'pan_card_number' => 1234567890,
            'pan_card_image' => '/assets/userDetails/1/pancard/panCardImage.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('temples')->insert([
            [

            'name' => 'Shri Ram Janmbhoomi Teerth Kshetra',
            'country' => 'India',
            'state' => 'Uttar Pradesh',
            'city' => 'Ayodhya',
            'phone' => '8009522111',
            'email' => 'contact@srjbtkshetra.org',
            'address' => 'Mandir Nirman Karyashala, Ramghat Chauraha, Near Manas Bhawan, Ayodhya, Uttar Pradesh – 224123 ',
            'description' => 'The Ram Mandir (Ram Temple) in Ayodhya, Uttar Pradesh, is a grand Hindu temple dedicated to Lord Shri Ram, one of the most revered deities in Indian culture and mythology.
                              It is being constructed at the birthplace of Lord Ram, a site of immense religious, cultural, and historical significance for millions of devotees worldwide. The temples design is inspired by ancient Indian temple architecture, featuring intricate carvings, a majestic shikhara (spire), and sanctum sanctorum to house the idol of Lord Ram.
                              The temple symbolizes devotion, perseverance, and cultural heritage. Upon completion, it will also host facilities for pilgrims, including darshan arrangements, cultural exhibitions, and other amenities to enhance the devotional experience. The Ram Mandir is not just a religious monument but also a symbol of unity and spiritual enlightenment.',
            'live_darshan' => 'https://www.youtube.com/embed/rZL7PRUetns?si=Avol68PtF8yvIDO0',
            'main_image' => 'assets/images/temple/1/mainimage/mainimg.jpg',
            'season' => 'all',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
                'name' => 'Kashi Vishwanath Temple',
                'country' => 'India',
                'state' => 'Uttar Pradesh',
                'city' => 'Varanasi',
                'phone' => '5422392629',
                'email' => 'info@shrivikashvishwanath.org',
                'address' => 'Lahori Tola, Varanasi, Uttar Pradesh – 221001',
                'description' => 'The Kashi Vishwanath Temple is one of the twelve Jyotirlingas dedicated to Lord Shiva. Located in the holy city of Varanasi, it holds immense spiritual significance for Hindus worldwide.',
                'main_image' => 'assets/images/temple/2/mainimage/mainimg.jpg',
                'live_darshan' => 'https://www.youtube.com/embed/pxxSMT02I3w?si=-osHmIp6jOIYxBee',
                'season' => 'all',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kedarnath Temple',
                'country' => 'India',
                'state' => 'Uttarakhand',
                'city' => 'Kedarnath',
                'phone' => '1352431793',
                'email' => 'info@kedarnathtemple.in',
                'address' => 'Kedarnath, Rudraprayag District, Uttarakhand – 246445',
                'description' => 'The Kedarnath Temple is one of the holiest Hindu temples dedicated to Lord Shiva and a part of the Chota Char Dham pilgrimage. Located in the Himalayas near the Mandakini River, the temple has great spiritual and historical significance.',
                'main_image' => 'assets/images/temple/3/mainimage/mainimg.jpg',
                'live_darshan' => 'https://www.youtube.com/embed/u1XIrLNEp3U?si=MRc94033GiTJXx44',
                'season' => 'winter',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
        DB::table('temple_images')->insert([
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520939089.jpg',
                'image_name' => '17379520939089.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520938990.jpg',
                'image_name' => '17379520938990.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520939980.jpg',
                'image_name' => '17379520939980.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520939952.jpg',
                'image_name' => '17379520939952.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520931639.jpg',
                'image_name' => '17379520931639.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 1,
                'image_url' => 'assets/images/temple/1/fetureimages/17379520938630.jpg',
                'image_name' => '17379520938630.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 2,
                'image_url' => 'assets/images/temple/2/fetureimages/17384298916388.jpg',
                'image_name' => '17384298916388.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 2,
                'image_url' => 'assets/images/temple/2/fetureimages/17384298919140.jpg',
                'image_name' => '17384298919140.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 2,
                'image_url' => 'assets/images/temple/2/fetureimages/17384298915053.jpg',
                'image_name' => '17384298915053.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 2,
                'image_url' => 'assets/images/temple/2/fetureimages/17384298915168.jpg',
                'image_name' => '17384298915168.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305572190.jpg',
                'image_name' => '17384305572190.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305579900.jpg',
                'image_name' => '17384305579900.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305573420.jpg',
                'image_name' => '17384305573420.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305579455.jpg',
                'image_name' => '17384305579455.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305574197.jpg',
                'image_name' => '17384305574197.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'temple_id' => 3,
                'image_url' => 'assets/images/temple/3/fetureimages/17384305574702.jpg',
                'image_name' => '17384305574702.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
