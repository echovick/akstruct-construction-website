<?php
namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'name'         => 'home',
                'slug'         => 'home',
                'title'        => 'Home - Akstruct Construction',
                'description'  => 'Welcome to Akstruct Construction, your trusted partner for premium construction services.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-1',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Building Excellence, Creating Legacies',
                                'subtitle'         => 'Premium Construction Services',
                                'description'      => 'Transform your vision into reality with our expert construction and architectural services.',
                                'background_image' => '/assets/img/hero-bg.jpg',
                                'button_text'      => 'Get Started',
                                'button_url'       => '/quote',
                            ],
                        ],
                        [
                            'id'   => 'features-1',
                            'type' => 'features',
                            'data' => [
                                'title'       => 'Why Choose Akstruct?',
                                'description' => 'We deliver exceptional results through innovation, quality, and dedication.',
                                'items'       => [
                                    ['title' => 'Expert Team', 'description' => 'Professional architects and contractors'],
                                    ['title' => 'Quality Materials', 'description' => 'Premium materials for lasting results'],
                                    ['title' => 'Timely Delivery', 'description' => 'Projects completed on schedule'],
                                ],
                            ],
                        ],
                        [
                            'id'   => 'cta-1',
                            'type' => 'cta',
                            'data' => [
                                'title'            => 'Ready to Start Your Project?',
                                'description'      => 'Get a free consultation and quote for your construction needs.',
                                'button_text'      => 'Request Quote',
                                'button_url'       => '/quote',
                                'background_color' => '#f3f4f6',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 1,
            ],
            [
                'name'         => 'about',
                'slug'         => 'about',
                'title'        => 'About Us - Akstruct Construction',
                'description'  => 'Learn about our history, mission, and commitment to excellence in construction.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-2',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'About Akstruct Construction',
                                'subtitle'         => 'Building Dreams Since 2010',
                                'description'      => 'We are a leading construction company dedicated to delivering exceptional projects.',
                                'background_image' => '/assets/img/about-hero.jpg',
                                'button_text'      => 'Our Services',
                                'button_url'       => '/services',
                            ],
                        ],
                        [
                            'id'   => 'text-1',
                            'type' => 'text',
                            'data' => [
                                'content'   => 'Founded in 2010, Akstruct Construction has grown from a small local business to a trusted name in the construction industry. Our commitment to quality, innovation, and customer satisfaction has earned us a reputation for excellence.',
                                'alignment' => 'left',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 2,
            ],
            [
                'name'         => 'services',
                'slug'         => 'services',
                'title'        => 'Our Services - Akstruct Construction',
                'description'  => 'Explore our comprehensive range of construction and architectural services.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-3',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Our Services',
                                'subtitle'         => 'Comprehensive Construction Solutions',
                                'description'      => 'From residential to commercial projects, we handle every aspect of construction.',
                                'background_image' => '/assets/img/services-hero.jpg',
                                'button_text'      => 'View Projects',
                                'button_url'       => '/project-portfolio',
                            ],
                        ],
                        [
                            'id'   => 'text-2',
                            'type' => 'text',
                            'data' => [
                                'content'   => 'Our team of experienced professionals provides end-to-end construction services, ensuring your project is completed to the highest standards.',
                                'alignment' => 'center',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 3,
            ],
            [
                'name'         => 'projects',
                'slug'         => 'project-portfolio',
                'title'        => 'Project Portfolio - Akstruct Construction',
                'description'  => 'Browse our portfolio of completed construction projects.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-4',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Project Portfolio',
                                'subtitle'         => 'Our Work Speaks for Itself',
                                'description'      => 'Discover the quality and craftsmanship that defines our work.',
                                'background_image' => '/assets/img/projects-hero.jpg',
                                'button_text'      => 'Contact Us',
                                'button_url'       => '/contact',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 4,
            ],
            [
                'name'         => 'blog',
                'slug'         => 'blog',
                'title'        => 'Blog - Akstruct Construction',
                'description'  => 'Stay updated with the latest construction trends and company news.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-5',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Construction Blog',
                                'subtitle'         => 'Industry Insights & Updates',
                                'description'      => 'Read the latest articles about construction trends, tips, and our projects.',
                                'background_image' => '/assets/img/blog-hero.jpg',
                                'button_text'      => 'Browse Articles',
                                'button_url'       => '#articles',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 5,
            ],
            [
                'name'         => 'careers',
                'slug'         => 'careers',
                'title'        => 'Careers - Akstruct Construction',
                'description'  => 'Join our team and build your career with Akstruct Construction.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-6',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Join Our Team',
                                'subtitle'         => 'Build Your Career With Us',
                                'description'      => 'Explore exciting career opportunities in the construction industry.',
                                'background_image' => '/assets/img/careers-hero.jpg',
                                'button_text'      => 'View Openings',
                                'button_url'       => '#openings',
                            ],
                        ],
                        [
                            'id'   => 'text-3',
                            'type' => 'text',
                            'data' => [
                                'content'   => 'At Akstruct Construction, we believe our people are our greatest asset. We offer competitive benefits, professional development opportunities, and a collaborative work environment.',
                                'alignment' => 'left',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 6,
            ],
            [
                'name'         => 'contact',
                'slug'         => 'contact',
                'title'        => 'Contact Us - Akstruct Construction',
                'description'  => 'Get in touch with our team for your construction needs.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-7',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Contact Us',
                                'subtitle'         => 'Let\'s Discuss Your Project',
                                'description'      => 'Ready to start your construction project? Get in touch with our team today.',
                                'background_image' => '/assets/img/contact-hero.jpg',
                                'button_text'      => 'Get Quote',
                                'button_url'       => '/quote',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 7,
            ],
            [
                'name'         => 'quote',
                'slug'         => 'quote',
                'title'        => 'Request Quote - Akstruct Construction',
                'description'  => 'Request a free quote for your construction project.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-8',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Request a Quote',
                                'subtitle'         => 'Free Project Consultation',
                                'description'      => 'Tell us about your project and we\'ll provide a detailed quote.',
                                'background_image' => '/assets/img/quote-hero.jpg',
                                'button_text'      => 'Fill Form',
                                'button_url'       => '#quote-form',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 8,
            ],
            [
                'name'         => 'faq',
                'slug'         => 'faq',
                'title'        => 'FAQ - Akstruct Construction',
                'description'  => 'Find answers to frequently asked questions about our services.',
                'content'      => [
                    'blocks' => [
                        [
                            'id'   => 'hero-9',
                            'type' => 'hero',
                            'data' => [
                                'title'            => 'Frequently Asked Questions',
                                'subtitle'         => 'Get Your Answers',
                                'description'      => 'Find answers to common questions about our construction services.',
                                'background_image' => '/assets/img/faq-hero.jpg',
                                'button_text'      => 'Contact Support',
                                'button_url'       => '/contact',
                            ],
                        ],
                    ],
                ],
                'is_published' => true,
                'sort_order'   => 9,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['name' => $pageData['name']],
                $pageData
            );
        }
    }
}
