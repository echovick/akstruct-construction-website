<?php
namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title'             => 'Lekki Peninsula Luxury Residential Complex',
                'description'       => 'A state-of-the-art residential complex featuring 50 luxury apartments with sustainable design elements, energy-efficient systems, and premium amenities including a rooftop pool, gym, and landscaped gardens.',
                'short_description' => 'Modern luxury apartments with sustainable features and premium amenities in Lagos.',
                'category'          => 'Residential',
                'location'          => 'Lekki, Lagos',
                'year'              => '2022',
                'client'            => 'Peninsula Development Company',
                'area'              => '8,500',
                'duration'          => '24',
                'floors'            => '8',
                'status'            => 'Completed',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Victoria Island Corporate Headquarters',
                'description'       => 'A modern corporate headquarters designed for a leading financial institution. This project features open-plan office spaces, smart building technology, solar panels, and a distinctive glass facade that maximizes natural light.',
                'short_description' => 'State-of-the-art corporate headquarters with sustainable features for a leading financial institution.',
                'category'          => 'Commercial',
                'location'          => 'Victoria Island, Lagos',
                'year'              => '2021',
                'client'            => 'Premier Banking Group',
                'area'              => '12,000',
                'duration'          => '30',
                'floors'            => '15',
                'status'            => 'Completed',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Abuja Smart City Development',
                'description'       => 'A mixed-use development featuring residential towers, office spaces, and retail areas. This project incorporates smart city technologies including integrated IoT systems for security, energy management, and community services.',
                'short_description' => 'Integrated mixed-use development with cutting-edge smart city technologies in Abuja.',
                'category'          => 'Mixed-Use',
                'location'          => 'Abuja, FCT',
                'year'              => '2023',
                'client'            => 'Federal Capital Development Authority',
                'area'              => '25,000',
                'duration'          => '36',
                'floors'            => '20',
                'status'            => 'In Progress',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Port Harcourt Healthcare Center',
                'description'       => 'A modern healthcare facility designed to provide specialized medical services. The center includes state-of-the-art medical equipment, patient wards, surgical theaters, and an emergency department, all designed with patient comfort and staff efficiency in mind.',
                'short_description' => 'Cutting-edge healthcare facility offering specialized medical services in Port Harcourt.',
                'category'          => 'Healthcare',
                'location'          => 'Port Harcourt, Rivers',
                'year'              => '2020',
                'client'            => 'Rivers Health Corporation',
                'area'              => '6,800',
                'duration'          => '18',
                'floors'            => '4',
                'status'            => 'Completed',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Kano Educational Campus',
                'description'       => 'A comprehensive educational campus featuring classrooms, laboratories, library, administrative buildings, dormitories, and sports facilities. The project incorporates sustainable building practices and creates an optimal learning environment.',
                'short_description' => 'Modern educational complex with state-of-the-art facilities and sustainable design.',
                'category'          => 'Educational',
                'location'          => 'Kano, Kano State',
                'year'              => '2021',
                'client'            => 'Kano Education Trust',
                'area'              => '15,200',
                'duration'          => '24',
                'floors'            => '3',
                'status'            => 'Completed',
                'is_featured'       => false,
            ],
            [
                'title'             => 'Calabar Waterfront Hospitality Development',
                'description'       => 'A luxury hotel and resort complex located on the Calabar waterfront. The development includes guest rooms, suites, restaurants, conference facilities, spa, and recreational areas, all designed to maximize views of the river and provide a premium hospitality experience.',
                'short_description' => 'Premium waterfront hotel and resort offering luxurious accommodations and amenities.',
                'category'          => 'Hospitality',
                'location'          => 'Calabar, Cross River',
                'year'              => '2022',
                'client'            => 'Eastern Hospitality Group',
                'area'              => '18,500',
                'duration'          => '30',
                'floors'            => '12',
                'status'            => 'Completed',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Enugu Cultural Center',
                'description'       => 'A modern cultural center designed to showcase the rich heritage of the region. The facility includes exhibition spaces, a theater, multipurpose halls, workshops, and outdoor performance areas, creating a vibrant hub for cultural activities.',
                'short_description' => 'Vibrant cultural center celebrating local heritage through innovative architecture and flexible spaces.',
                'category'          => 'Cultural',
                'location'          => 'Enugu, Enugu State',
                'year'              => '2023',
                'client'            => 'Enugu State Cultural Commission',
                'area'              => '9,800',
                'duration'          => '22',
                'floors'            => '3',
                'status'            => 'Completed',
                'is_featured'       => false,
            ],
            [
                'title'             => 'Lagos Sustainable Industrial Park',
                'description'       => 'An industrial complex designed with sustainability at its core. The development includes manufacturing facilities, warehouses, distribution centers, and administrative buildings, all powered by renewable energy and featuring water recycling systems.',
                'short_description' => 'Eco-friendly industrial park featuring renewable energy systems and sustainable operations.',
                'category'          => 'Industrial',
                'location'          => 'Badagry, Lagos',
                'year'              => '2021',
                'client'            => 'Lagos Industrial Development Corporation',
                'area'              => '42,000',
                'duration'          => '36',
                'floors'            => '2',
                'status'            => 'Completed',
                'is_featured'       => false,
            ],
            [
                'title'             => 'Ibadan Urban Renewal Project',
                'description'       => 'A comprehensive urban renewal project involving the restoration of historic buildings, infrastructure improvements, and the development of public spaces. The project aims to preserve the city\'s heritage while enhancing livability and economic vitality.',
                'short_description' => 'Holistic urban renewal initiative balancing heritage preservation with modern infrastructure improvements.',
                'category'          => 'Urban Planning',
                'location'          => 'Ibadan, Oyo State',
                'year'              => '2023',
                'client'            => 'Oyo State Urban Development Agency',
                'area'              => '320,000',
                'duration'          => '48',
                'floors'            => 'N/A',
                'status'            => 'In Progress',
                'is_featured'       => true,
            ],
            [
                'title'             => 'Benin Sports Complex',
                'description'       => 'A modern sports facility featuring a main stadium, indoor arenas, swimming pools, tennis courts, and training facilities. The complex is designed to host national and international competitions while also serving as a community sports hub.',
                'short_description' => 'Comprehensive sports complex designed to international standards with facilities for multiple sports.',
                'category'          => 'Sports',
                'location'          => 'Benin City, Edo State',
                'year'              => '2022',
                'client'            => 'Edo State Sports Commission',
                'area'              => '85,000',
                'duration'          => '36',
                'floors'            => '3',
                'status'            => 'Completed',
                'is_featured'       => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::create(array_merge($project, [
                'slug'                   => Str::slug($project['title']),
                'cost'                   => rand(500000, 10000000),
                'sustainability_focus'   => 'Energy efficiency, sustainable materials, waste reduction',
                'gallery_images'         => json_encode([
                    'assets/img/projects/project1.jpg',
                    'assets/img/projects/project2.jpg',
                    'assets/img/projects/project3.jpg',
                ]),
                'highlights'             => json_encode([
                    'Reduced energy consumption by 30%',
                    'Used locally-sourced materials',
                    'Implemented water recycling systems',
                    'Solar panels for renewable energy',
                ]),
                'completion_certificate' => $project['status'] === 'Completed' ? 'documents/certificates/cert_' . Str::slug($project['title']) . '.pdf' : null,
                'case_study_pdf'         => 'documents/case_studies/case_' . Str::slug($project['title']) . '.pdf',
            ]));
        }
    }
}
