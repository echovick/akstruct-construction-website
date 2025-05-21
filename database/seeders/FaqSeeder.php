<?php
namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // General FAQs
            [
                'question'      => 'What types of construction projects does Akstruct handle?',
                'answer'        => 'Akstruct Construction specializes in a diverse range of projects including commercial buildings, residential developments, industrial facilities, healthcare centers, educational institutions, and infrastructure projects. We excel in both new construction and renovation/retrofitting of existing structures with a focus on sustainability.',
                'category'      => 'General',
                'display_order' => 1,
                'is_published'  => true,
            ],
            [
                'question'      => 'How long has Akstruct been in business?',
                'answer'        => 'Akstruct Construction was founded in 2015 and has since established itself as a leading sustainable construction company in Nigeria. With over 8 years of experience, we have successfully completed more than 150 projects across various sectors.',
                'category'      => 'General',
                'display_order' => 2,
                'is_published'  => true,
            ],

            // Sustainability FAQs
            [
                'question'      => 'How does Akstruct ensure sustainability in its projects?',
                'answer'        => 'Sustainability is at the core of our approach. We implement this through: (1) Energy-efficient designs that reduce consumption, (2) Integration of renewable energy systems like solar, (3) Water conservation through rainwater harvesting and greywater recycling, (4) Use of locally-sourced and eco-friendly materials, (5) Waste reduction strategies during construction, (6) Smart building technologies for optimal resource management, and (7) Pursuing green certifications like LEED where appropriate.',
                'category'      => 'Sustainability',
                'display_order' => 3,
                'is_published'  => true,
            ],
            [
                'question'      => 'Do sustainable buildings cost more to construct?',
                'answer'        => 'While the initial investment in sustainable buildings can sometimes be 2-5% higher than conventional construction, this is quickly offset by significant operational savings. Energy-efficient buildings typically reduce utility costs by 30-50% over their lifetime. Additionally, sustainable buildings often command premium values and higher occupancy rates, providing a strong return on investment. We work closely with clients to identify sustainable features that offer the best value and return for their specific project.',
                'category'      => 'Sustainability',
                'display_order' => 4,
                'is_published'  => true,
            ],

            // Project Process FAQs
            [
                'question'      => 'What is Akstruct\'s typical project process?',
                'answer'        => 'Our comprehensive project process includes: (1) Initial consultation to understand your needs and vision, (2) Feasibility study and site analysis, (3) Conceptual design and budget development, (4) Detailed design and engineering, (5) Permitting and regulatory approvals, (6) Construction planning and scheduling, (7) Construction execution with regular progress updates, (8) Quality control and inspections, (9) Project completion and handover, and (10) Post-construction support and warranty service.',
                'category'      => 'Process',
                'display_order' => 5,
                'is_published'  => true,
            ],
            [
                'question'      => 'How can I get a quote for my construction project?',
                'answer'        => 'You can request a quote by filling out our online form on the "Request a Quote" page of our website. Alternatively, you can contact us directly by phone or email. To provide you with the most accurate quote, we\'ll need details about your project scope, location, timeline, and any specific requirements. After receiving your information, our team will arrange an initial consultation, which may include a site visit, before providing a detailed proposal.',
                'category'      => 'Process',
                'display_order' => 6,
                'is_published'  => true,
            ],

            // Capacity FAQs
            [
                'question'      => 'Can Akstruct handle large-scale projects?',
                'answer'        => 'Yes, Akstruct Construction has the capacity, expertise, and resources to handle large-scale projects. Our portfolio includes major developments such as commercial complexes, multi-unit residential properties, and substantial industrial facilities. We have a strong team of experienced professionals, established relationships with quality subcontractors, and robust financial backing to successfully execute projects of significant scale and complexity. For particularly large projects, we can also form strategic partnerships with other firms to ensure optimal delivery.',
                'category'      => 'Capacity',
                'display_order' => 7,
                'is_published'  => true,
            ],
            [
                'question'      => 'Does Akstruct work on small renovation projects?',
                'answer'        => 'While we specialize in medium to large-scale projects, we do consider select smaller renovation projects, particularly those with a focus on sustainability or those for existing clients. Our minimum project value is typically ₦10 million. For smaller projects, we\'re happy to recommend trusted partners who specialize in that scale of work.',
                'category'      => 'Capacity',
                'display_order' => 8,
                'is_published'  => true,
            ],

            // Services FAQs
            [
                'question'      => 'Does Akstruct provide design services or only construction?',
                'answer'        => 'Akstruct offers both design and construction services, allowing for a seamless integrated approach. Our design capabilities include architectural conceptualization, detailed design development, and engineering solutions across structural, mechanical, electrical, and plumbing disciplines. We excel in design-build projects where we manage both aspects, but we also gladly collaborate with external architects and designers if clients have existing relationships. This flexibility ensures we can adapt to your preferred project delivery method.',
                'category'      => 'Services',
                'display_order' => 9,
                'is_published'  => true,
            ],
            [
                'question'      => 'Does Akstruct handle project permits and approvals?',
                'answer'        => 'Yes, we provide comprehensive permit management services. Our experienced team navigates the complex regulatory landscape to secure all necessary approvals, including building permits, environmental clearances, zoning variances, and utility connections. We maintain strong relationships with regulatory authorities across Nigeria, which helps streamline the approval process. This service ensures compliance with all applicable codes and regulations while minimizing delays to your project timeline.',
                'category'      => 'Services',
                'display_order' => 10,
                'is_published'  => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
