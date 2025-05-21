<?php
namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General settings
            [
                'key'       => 'site_name',
                'value'     => 'Akstruct Construction',
                'group'     => 'general',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'site_tagline',
                'value'     => 'Building Sustainable Futures',
                'group'     => 'general',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'company_founding_year',
                'value'     => '2015',
                'group'     => 'general',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'logo',
                'value'     => 'assets/img/logo.svg',
                'group'     => 'general',
                'is_public' => true,
                'type'      => 'image',
            ],
            [
                'key'       => 'favicon',
                'value'     => 'assets/img/favicon.ico',
                'group'     => 'general',
                'is_public' => true,
                'type'      => 'image',
            ],

            // Contact information
            [
                'key'       => 'company_address',
                'value'     => 'Third Floor, Global Plaza, Suit C410, Jabi, Abuja 900108, Federal Capital Territory',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'company_email',
                'value'     => 'akstructltd@gmail.com',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'company_phone_1',
                'value'     => '08140993888',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'company_phone_2',
                'value'     => '07082323113',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'office_hours',
                'value'     => 'Monday - Friday: 8:00 AM - 5:00 PM | Saturday: 9:00 AM - 1:00 PM',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'google_map_embed',
                'value'     => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3939.9262738913984!2d7.4102385!3d9.062379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0babd4d6c2e5%3A0x82d36e1c3f08c0d1!2sGlobal%20Plaza%2C%20Jabi%2C%20Abuja!5e0!3m2!1sen!2sng!4v1651234567890!5m2!1sen!2sng',
                'group'     => 'contact',
                'is_public' => true,
                'type'      => 'textarea',
            ],

            // Social media
            [
                'key'       => 'instagram_handle',
                'value'     => '@akstruct_africa',
                'group'     => 'social',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'instagram_url',
                'value'     => 'https://www.instagram.com/akstruct_africa?igsh=dTB0YWY2cjAzeDVv',
                'group'     => 'social',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'linkedin_url',
                'value'     => 'https://linkedin.com/company/akstruct',
                'group'     => 'social',
                'is_public' => true,
                'type'      => 'text',
            ],

            // Company Vision & Mission
            [
                'key'       => 'vision',
                'value'     => 'To be the leading sustainable construction company in Africa, building infrastructure that positively impacts communities and environments for generations to come.',
                'group'     => 'company',
                'is_public' => true,
                'type'      => 'textarea',
            ],
            [
                'key'       => 'mission',
                'value'     => 'To provide environmentally friendly, client-centric engineering solutions that exceed expectations through professionalism, innovation, and a commitment to excellence.',
                'group'     => 'company',
                'is_public' => true,
                'type'      => 'textarea',
            ],

            // Homepage Settings
            [
                'key'       => 'hero_title',
                'value'     => 'Building Tomorrow\'s Infrastructure Today',
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'hero_subtitle',
                'value'     => 'Professional construction and engineering solutions with a focus on sustainability',
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'hero_carousel_images',
                'value'     => json_encode([
                    'assets/img/hero/project1.jpg',
                    'assets/img/hero/project2.jpg',
                    'assets/img/hero/project3.jpg',
                ]),
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'json',
            ],
            [
                'key'       => 'stats_projects_completed',
                'value'     => '150',
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'stats_happy_clients',
                'value'     => '123',
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'text',
            ],
            [
                'key'       => 'stats_years_experience',
                'value'     => '8',
                'group'     => 'homepage',
                'is_public' => true,
                'type'      => 'text',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
