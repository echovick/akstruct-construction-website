<?php
namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title'            => 'Construction Management',
                'description'      => 'Professional oversight of construction projects from planning to completion, ensuring quality, timeliness, and budget adherence.',
                'icon'             => 'construction-management.svg',
                'long_description' => 'Our construction management services provide comprehensive oversight of your project from initial planning through completion. We coordinate all aspects of the construction process, manage subcontractors, ensure quality control, monitor schedules, and maintain budget oversight. With our experienced team at the helm, we mitigate risks, solve problems proactively, and deliver successful projects that meet or exceed expectations.',
                'is_featured'      => true,
                'display_order'    => 1,
            ],
            [
                'title'            => 'Sustainable Design and Build',
                'description'      => 'Eco-friendly construction solutions that minimize environmental impact while maximizing efficiency and long-term value.',
                'icon'             => 'sustainable-design.svg',
                'long_description' => 'Our sustainable design and build services integrate environmentally responsible practices throughout the construction process. We incorporate energy-efficient systems, sustainable materials, waste reduction strategies, and innovative green technologies. Our approach not only reduces environmental impact but also creates healthier spaces, lowers operating costs, and enhances the long-term value of your property. We help achieve LEED certification and other sustainability benchmarks.',
                'is_featured'      => true,
                'display_order'    => 2,
            ],
            [
                'title'            => 'Real Estate Development',
                'description'      => 'End-to-end property development services, from site selection and acquisition to design, construction, and property management.',
                'icon'             => 'real-estate.svg',
                'long_description' => 'Our real estate development services encompass the entire development lifecycle. We handle site selection, feasibility studies, land acquisition, financing strategies, design development, construction oversight, and property management. Our integrated approach ensures cohesive project execution, risk mitigation, and optimal return on investment. We specialize in both residential and commercial developments that meet market demands while enhancing communities.',
                'is_featured'      => true,
                'display_order'    => 3,
            ],
            [
                'title'            => 'Engineering Solutions',
                'description'      => 'Specialized engineering services providing technical expertise across structural, mechanical, electrical, and civil disciplines.',
                'icon'             => 'engineering.svg',
                'long_description' => 'Our engineering solutions provide specialized technical expertise across multiple disciplines. We offer structural, mechanical, electrical, plumbing (MEP), and civil engineering services tailored to your project needs. Our engineers leverage advanced technologies and innovative methods to solve complex challenges, optimize designs, ensure code compliance, and enhance project performance. We collaborate closely with architects and contractors to deliver integrated solutions that balance function, aesthetics, and cost-effectiveness.',
                'is_featured'      => false,
                'display_order'    => 4,
            ],
            [
                'title'            => 'Renovation and Retrofitting',
                'description'      => 'Transforming existing structures through strategic upgrades, modernization, and performance enhancements.',
                'icon'             => 'renovation.svg',
                'long_description' => 'Our renovation and retrofitting services breathe new life into existing structures. We specialize in modernizing outdated buildings, improving energy efficiency, enhancing structural integrity, and upgrading systems to meet current codes and standards. Whether for historical preservation, adaptive reuse, or performance improvement, our team delivers thoughtful renovations that respect original character while incorporating contemporary functionality and sustainability features.',
                'is_featured'      => false,
                'display_order'    => 5,
            ],
            [
                'title'            => 'Project Consultancy',
                'description'      => 'Expert advisory services for construction projects, providing strategic guidance, problem-solving, and specialized knowledge.',
                'icon'             => 'consultancy.svg',
                'long_description' => 'Our project consultancy services provide expert guidance throughout your construction project lifecycle. We offer specialized knowledge in feasibility assessment, budget planning, scheduling, risk management, value engineering, and quality assurance. Our consultants serve as trusted advisors, helping you navigate complex decisions, resolve challenges, and optimize project outcomes. With our strategic insights, you gain the confidence to make informed choices that enhance project success.',
                'is_featured'      => false,
                'display_order'    => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
