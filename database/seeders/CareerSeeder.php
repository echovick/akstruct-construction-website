<?php
namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $careers = [
            [
                'title'            => 'Senior Project Manager',
                'department'       => 'Project Management',
                'location'         => 'Abuja, Nigeria',
                'description'      => 'We\'re seeking an experienced Senior Project Manager to lead our complex construction projects from initiation through completion. You will be responsible for ensuring projects are delivered on time, within budget, and to the highest quality standards while maintaining our commitment to sustainability.',
                'responsibilities' => "- Manage all aspects of assigned construction projects, including planning, execution, and closeout
- Develop and maintain project schedules, budgets, and resource allocation plans
- Coordinate with architects, engineers, contractors, and clients to ensure project success
- Lead risk assessment and mitigation strategies
- Ensure compliance with quality standards, safety regulations, and sustainability goals
- Manage client relationships and communication
- Mentor and develop junior project management staff
- Prepare detailed reports on project progress and financial performance",
                'requirements'     => "- Bachelor's degree in Civil Engineering, Construction Management, or related field (Master's preferred)
- 8+ years of experience in construction project management, with at least 3 years in a senior role
- PMP certification or equivalent professional qualification
- Strong understanding of sustainable construction practices and green building standards
- Excellent leadership, communication, and problem-solving skills
- Proficiency in project management software and MS Office suite
- Experience with BIM (Building Information Modeling) technologies
- Knowledge of Nigerian building codes and regulations",
                'benefits'         => "- Competitive salary and performance bonuses
- Comprehensive health insurance
- Professional development opportunities and certification support
- Career advancement pathways
- Collaborative and innovative work environment
- Company vehicle or transportation allowance
- Paid time off and holiday benefits",
                'salary_min'       => 12000000.00,
                'salary_max'       => 18000000.00,
                'is_remote'        => false,
                'is_active'        => true,
                'valid_until'      => '2024-07-30',
            ],
            [
                'title'            => 'Sustainability Specialist',
                'department'       => 'Design & Engineering',
                'location'         => 'Abuja, Nigeria',
                'description'      => 'Join our team as a Sustainability Specialist to help integrate innovative, environmentally responsible solutions into our construction projects. You\'ll work closely with our design and project teams to enhance the sustainability performance of our buildings and infrastructure.',
                'responsibilities' => "- Evaluate and recommend sustainable design strategies and green building technologies
- Conduct energy modeling and performance analysis for projects
- Support LEED, EDGE, and other green building certification processes
- Research and stay current on emerging sustainable construction practices
- Develop sustainability guidelines and standards for projects
- Collaborate with project teams to implement sustainable solutions
- Track and report on sustainability metrics and performance outcomes
- Provide training and guidance on sustainability best practices",
                'requirements'     => "- Bachelor's degree in Environmental Engineering, Architecture, Sustainable Design, or related field
- 3+ years of experience in sustainable building design or consulting
- LEED AP, EDGE Expert, or equivalent certification
- Strong knowledge of energy modeling software and sustainability assessment tools
- Understanding of building systems, materials, and construction methods
- Excellent analytical and problem-solving abilities
- Strong communication and presentation skills
- Passion for environmental sustainability and innovation",
                'benefits'         => "- Competitive salary package
- Health and wellness benefits
- Professional development support
- Collaborative work environment
- Opportunity to make significant environmental impact
- Flexible working arrangements
- Career growth opportunities",
                'salary_min'       => 8000000.00,
                'salary_max'       => 12000000.00,
                'is_remote'        => true,
                'is_active'        => true,
                'valid_until'      => '2024-06-15',
            ],
            [
                'title'            => 'Civil Engineer',
                'department'       => 'Engineering',
                'location'         => 'Abuja, Nigeria',
                'description'      => 'We are looking for a talented Civil Engineer to join our growing team in Abuja. In this role, you will design and oversee the construction of various infrastructure projects, ensuring they meet technical specifications, safety standards, and sustainability goals.',
                'responsibilities' => "- Develop detailed civil engineering designs for construction projects
- Prepare technical specifications, calculations, and cost estimates
- Review and approve engineering drawings and documents
- Conduct site inspections to monitor construction progress and quality
- Identify and resolve engineering challenges and design issues
- Coordinate with multidisciplinary teams including architects and other engineers
- Ensure compliance with applicable codes, standards, and regulations
- Participate in project planning and feasibility studies",
                'requirements'     => "- Bachelor's degree in Civil Engineering (Master's degree preferred)
- 3-5 years of experience in civil engineering, particularly in construction projects
- Professional engineering license or registration
- Proficiency in AutoCAD, Civil 3D, and other relevant engineering software
- Strong technical knowledge of civil engineering principles and practices
- Excellent analytical and problem-solving skills
- Good understanding of sustainable engineering practices
- Effective communication and teamwork abilities",
                'benefits'         => "- Competitive salary
- Performance bonuses
- Health insurance coverage
- Professional development opportunities
- Career advancement pathways
- Collaborative work environment
- Challenging and diverse projects",
                'salary_min'       => 7000000.00,
                'salary_max'       => 10000000.00,
                'is_remote'        => false,
                'is_active'        => true,
                'valid_until'      => '2024-05-30',
            ],
            [
                'title'            => 'Digital Marketing Specialist',
                'department'       => 'Marketing & Communications',
                'location'         => 'Abuja, Nigeria',
                'description'      => 'We\'re seeking a creative and data-driven Digital Marketing Specialist to boost our online presence and generate quality leads. You\'ll be responsible for developing and implementing digital marketing strategies that highlight our sustainable construction expertise and showcase our impressive project portfolio.',
                'responsibilities' => "- Develop and execute comprehensive digital marketing campaigns
- Manage and optimize the company website and social media channels
- Create engaging content including case studies, blog posts, and project highlights
- Implement SEO strategies to improve online visibility
- Set up and manage digital advertising campaigns
- Track and analyze marketing metrics to measure campaign effectiveness
- Collaborate with the project teams to gather content for marketing materials
- Maintain brand consistency across all digital platforms",
                'requirements'     => "- Bachelor's degree in Marketing, Digital Media, Communications, or related field
- 3+ years of experience in digital marketing, preferably in construction or related industries
- Strong knowledge of SEO, SEM, social media marketing, and content strategy
- Experience with web analytics tools and digital marketing platforms
- Excellent writing and communication skills
- Creative thinking with analytical capabilities
- Basic understanding of graphic design and video editing
- Familiarity with construction industry terminology is a plus",
                'benefits'         => "- Competitive salary
- Performance bonuses
- Health benefits package
- Professional growth opportunities
- Collaborative and creative work environment
- Flexible working arrangements
- Learning and development support",
                'salary_min'       => 5000000.00,
                'salary_max'       => 8000000.00,
                'is_remote'        => true,
                'is_active'        => true,
                'valid_until'      => null,
            ],
            [
                'title'            => 'Construction Site Supervisor',
                'department'       => 'Operations',
                'location'         => 'Port Harcourt, Nigeria',
                'description'      => 'We are looking for an experienced Construction Site Supervisor to oversee daily operations at our project sites in Port Harcourt. You will ensure that construction activities are executed according to plans, schedules, quality standards, and safety requirements.',
                'responsibilities' => "- Supervise and coordinate construction activities on site
- Monitor work progress and ensure adherence to project schedules
- Ensure compliance with safety standards and regulations
- Conduct quality control inspections and address any deficiencies
- Coordinate with subcontractors and material suppliers
- Manage site workers and resolve any labor issues
- Maintain daily logs of site activities, resources, and progress
- Report to the Project Manager on project status, issues, and needs
- Implement sustainable construction practices on site",
                'requirements'     => "- Minimum of Higher National Diploma (HND) in Building Technology, Civil Engineering, or related field
- 5+ years of experience in construction supervision
- Strong knowledge of construction methods, materials, and equipment
- Familiarity with building codes and safety regulations
- Excellent leadership and communication skills
- Problem-solving abilities and attention to detail
- Experience with sustainable construction practices
- Computer literacy and basic knowledge of construction software",
                'benefits'         => "- Competitive salary
- Performance-based incentives
- Health insurance
- Transportation allowance
- Professional development opportunities
- Safety training and certifications
- Opportunity for career advancement",
                'salary_min'       => 6000000.00,
                'salary_max'       => 9000000.00,
                'is_remote'        => false,
                'is_active'        => true,
                'valid_until'      => '2024-04-15',
            ],
        ];

        foreach ($careers as $career) {
            Career::create($career);
        }
    }
}
