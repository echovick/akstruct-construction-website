<?php
namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin@akstruct.com',
        ]);

        // Call all other seeders
        $this->call([
            PageSeeder::class,
            SettingSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            TestimonialSeeder::class,
            BlogSeeder::class,
            FaqSeeder::class,
            CareerSeeder::class,
        ]);
    }
}
