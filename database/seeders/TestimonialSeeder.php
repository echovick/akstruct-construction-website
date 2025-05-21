<?php
namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Dr. Oluwaseun Adebayo',
                'position'    => 'CEO',
                'company'     => 'Lagos Medical Group',
                'content'     => 'Working with Akstruct Construction on our Calabar Healthcare Center was a seamless experience. Their attention to detail in designing a facility that promotes healing through sustainable practices exceeded our expectations. The team\'s commitment to quality and adherence to timelines was impressive.',
                'image'       => 'assets/img/testimonials/client1.jpg',
                'video_url'   => null,
                'audio_url'   => null,
                'is_featured' => true,
                'rating'      => 5,
            ],
            [
                'client_name' => 'Mrs. Aminat Ibrahim',
                'position'    => 'Property Developer',
                'company'     => 'Green Living Estates',
                'content'     => 'Akstruct brought our eco-friendly residential concept to life with innovative solutions we hadn\'t even considered. Their expertise in sustainable construction practices allowed us to offer truly green homes to our clients without compromising on luxury or comfort. The project was delivered on time and within budget.',
                'image'       => 'assets/img/testimonials/client2.jpg',
                'video_url'   => 'https://youtu.be/example1',
                'audio_url'   => null,
                'is_featured' => true,
                'rating'      => 5,
            ],
            [
                'client_name' => 'Mr. Emmanuel Okonkwo',
                'position'    => 'Operations Director',
                'company'     => 'NigerTech Manufacturing',
                'content'     => 'The industrial complex Akstruct designed and built for us has significantly reduced our operational costs through energy efficiency. Their team understood our manufacturing processes and created a facility that not only minimizes environmental impact but also optimizes productivity. We\'ve already contracted them for our expansion project.',
                'image'       => 'assets/img/testimonials/client3.jpg',
                'video_url'   => null,
                'audio_url'   => null,
                'is_featured' => false,
                'rating'      => 4,
            ],
            [
                'client_name' => 'Prof. Fatima Bello',
                'position'    => 'Chancellor',
                'company'     => 'Northern Education Trust',
                'content'     => 'The educational campus Akstruct created has transformed how our students learn. The thoughtful integration of indoor-outdoor spaces, natural lighting, and sustainable materials has created an environment where students thrive. Their team listened to our needs and delivered a campus that will serve generations of learners.',
                'image'       => 'assets/img/testimonials/client4.jpg',
                'video_url'   => null,
                'audio_url'   => 'assets/audio/testimonial-bello.mp3',
                'is_featured' => true,
                'rating'      => 5,
            ],
            [
                'client_name' => 'Chief Adebola Johnson',
                'position'    => 'Managing Director',
                'company'     => 'West African Developers',
                'content'     => 'Akstruct\'s consultancy services provided invaluable insights for our commercial development. Their expertise in sustainable building practices helped us navigate complex regulatory requirements while creating an environmentally responsible project. The ROI on their recommendations has been substantial.',
                'image'       => 'assets/img/testimonials/client5.jpg',
                'video_url'   => null,
                'audio_url'   => null,
                'is_featured' => false,
                'rating'      => 4,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
