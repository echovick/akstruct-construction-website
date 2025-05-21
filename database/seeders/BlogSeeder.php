<?php
namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title'          => 'The Future of Sustainable Construction in Africa',
                'slug'           => 'future-sustainable-construction-africa',
                'excerpt'        => 'Exploring the trends, challenges, and opportunities in sustainable construction across the African continent.',
                'content'        => '<p>The construction industry in Africa is at a pivotal moment. As the continent experiences rapid urbanization and population growth, the demand for infrastructure and housing continues to rise exponentially. However, this growth presents both challenges and opportunities for sustainable development.</p>

<p>Africa has the unique opportunity to leapfrog traditional construction methods and embrace sustainable practices from the outset. By leveraging new technologies, innovative materials, and renewable energy sources, the construction sector can minimize environmental impact while addressing critical infrastructure needs.</p>

<h3>Key Trends in Sustainable Construction</h3>

<p>Several trends are shaping the future of sustainable construction in Africa:</p>

<ul>
    <li><strong>Locally Sourced Materials</strong>: Using indigenous materials reduces transportation emissions and supports local economies.</li>
    <li><strong>Climate-Responsive Design</strong>: Incorporating passive cooling and natural ventilation to reduce energy consumption.</li>
    <li><strong>Renewable Energy Integration</strong>: Building-integrated solar systems and other renewable technologies.</li>
    <li><strong>Water Conservation</strong>: Implementing rainwater harvesting and greywater recycling systems.</li>
</ul>

<p>At Akstruct Construction, we\'re committed to pioneering these sustainable practices in our projects across Nigeria and beyond.</p>',
                'featured_image' => 'assets/img/blog/sustainable-future.jpg',
                'category'       => 'Sustainability',
                'author'         => 'Oluwaseyi Adekoya',
                'reading_time'   => 5,
                'is_published'   => true,
                'published_at'   => '2023-12-15 09:00:00',
                'tags'           => json_encode(['sustainability', 'green building', 'Africa', 'future trends']),
            ],
            [
                'title'          => 'How to Choose the Right Construction Partner for Your Project',
                'slug'           => 'choose-right-construction-partner',
                'excerpt'        => 'Essential factors to consider when selecting a construction company for your next building project.',
                'content'        => '<p>Selecting the right construction partner is perhaps the most critical decision you\'ll make for your building project. The choice you make will impact everything from cost and quality to timeline and sustainability features.</p>

<p>Whether you\'re developing a commercial property, industrial facility, or residential complex, here are key factors to consider when evaluating potential construction partners:</p>

<h3>1. Experience and Expertise</h3>

<p>Look for a company with proven experience in projects similar to yours. Review their portfolio and ask specifically about projects that match your scale, complexity, and type. Specialized expertise is often more valuable than general experience.</p>

<h3>2. Sustainability Commitment</h3>

<p>In today\'s world, sustainability shouldn\'t be an afterthought. Evaluate the company\'s track record in environmentally responsible construction. Do they have experience with green certifications? Can they demonstrate measurable environmental benefits from previous projects?</p>

<h3>3. Financial Stability</h3>

<p>Your construction partner should have the financial resources to complete your project without delays caused by cash flow issues. Don\'t hesitate to ask for evidence of financial stability.</p>

<h3>4. Communication and Transparency</h3>

<p>The best construction partners prioritize clear communication and transparency. From the first meeting, assess how responsive they are and how well they explain complex concepts and processes.</p>

<p>At Akstruct Construction, we pride ourselves on meeting all these criteria and more, ensuring that your project achieves both your immediate goals and long-term sustainability objectives.</p>',
                'featured_image' => 'assets/img/blog/choosing-partner.jpg',
                'category'       => 'Tips',
                'author'         => 'Chioma Nwosu',
                'reading_time'   => 4,
                'is_published'   => true,
                'published_at'   => '2023-11-10 14:30:00',
                'tags'           => json_encode(['construction partners', 'project planning', 'selection criteria', 'sustainability']),
            ],
            [
                'title'          => 'Lagos Green Towers: A Case Study in Commercial Sustainability',
                'slug'           => 'lagos-green-towers-case-study',
                'excerpt'        => 'An in-depth look at how the Lagos Green Towers project is setting new standards for commercial construction in West Africa.',
                'content'        => '<p>The Lagos Green Towers project represents a significant milestone in sustainable commercial construction in West Africa. As one of Akstruct Construction\'s flagship projects, it embodies our commitment to environmental responsibility while delivering exceptional quality and functionality.</p>

<h3>Project Overview</h3>

<p>Lagos Green Towers is a mixed-use commercial complex spanning 25,000 square meters in the heart of Lagos\'s business district. The development includes office spaces, retail areas, and amenity zones designed to create a cohesive, productive environment for tenants and visitors.</p>

<h3>Sustainability Features</h3>

<p>What sets this project apart is its comprehensive sustainability strategy:</p>

<ul>
    <li><strong>Energy Efficiency</strong>: The building\'s design achieves a 40% reduction in energy consumption compared to conventional buildings of similar size. This is accomplished through high-performance glazing, optimized orientation, and state-of-the-art building management systems.</li>
    <li><strong>Renewable Energy</strong>: A rooftop solar array generates 30% of the building\'s electricity needs, significantly reducing operational carbon emissions.</li>
    <li><strong>Water Conservation</strong>: Rainwater harvesting systems capture and reuse water for irrigation and non-potable purposes, reducing water consumption by 60%.</li>
    <li><strong>Sustainable Materials</strong>: Over 40% of construction materials were locally sourced, and 30% included recycled content.</li>
</ul>

<h3>Economic Impact</h3>

<p>Beyond environmental benefits, Lagos Green Towers demonstrates that sustainability makes economic sense. Tenants benefit from lower operational costs, with utility expenses approximately 35% below comparable properties. The building\'s prestige has also attracted premium tenants, maintaining high occupancy rates despite market fluctuations.</p>

<p>This project exemplifies how commercial developments can prioritize sustainability without compromising on quality, functionality, or financial performance.</p>',
                'featured_image' => 'assets/img/blog/green-towers-case.jpg',
                'category'       => 'Project Updates',
                'author'         => 'Oluwaseyi Adekoya',
                'reading_time'   => 6,
                'is_published'   => true,
                'published_at'   => '2023-10-05 11:15:00',
                'tags'           => json_encode(['case study', 'commercial construction', 'Lagos', 'green building', 'LEED']),
            ],
            [
                'title'          => 'The Role of Construction in Achieving Nigeria\'s Climate Goals',
                'slug'           => 'construction-nigeria-climate-goals',
                'excerpt'        => 'How the construction industry can contribute to Nigeria\'s national climate action plans and sustainability targets.',
                'content'        => '<p>As Nigeria works to meet its commitments under the Paris Climate Agreement, the construction industry has a crucial role to play. Buildings and construction account for approximately 36% of global energy use and 39% of energy-related carbon dioxide emissions annually. In Nigeria, with rapid urbanization and infrastructure development, these percentages could be even higher.</p>

<h3>Nigeria\'s Climate Commitments</h3>

<p>Nigeria has pledged to reduce its greenhouse gas emissions by 20% unconditionally and 45% conditionally by 2030. Meeting these targets requires significant changes across all sectors, including construction.</p>

<h3>Construction Industry Impact</h3>

<p>The construction industry can contribute to climate goals through several approaches:</p>

<ul>
    <li><strong>Energy-Efficient Buildings</strong>: Implementing designs that minimize energy consumption for heating, cooling, and lighting.</li>
    <li><strong>Renewable Energy Integration</strong>: Incorporating solar, wind, and other renewable sources into building designs.</li>
    <li><strong>Sustainable Materials</strong>: Using low-carbon materials and reducing waste in construction processes.</li>
    <li><strong>Green Infrastructure</strong>: Developing projects that support climate resilience and adaptation.</li>
</ul>

<h3>Policy and Regulation</h3>

<p>Government policies play a vital role in driving sustainable construction. Building codes that mandate energy efficiency, incentives for green certification, and carbon pricing mechanisms can accelerate the industry\'s transformation.</p>

<h3>Economic Opportunities</h3>

<p>The shift to sustainable construction creates economic opportunities through job creation, innovation, and cost savings. Energy-efficient buildings reduce operational expenses, while growing demand for green technologies stimulates new business development.</p>

<p>At Akstruct Construction, we\'re committed to supporting Nigeria\'s climate goals through our sustainable construction practices and advocacy for industry-wide change.</p>',
                'featured_image' => 'assets/img/blog/climate-goals.jpg',
                'category'       => 'Construction News',
                'author'         => 'Emeka Okafor',
                'reading_time'   => 5,
                'is_published'   => true,
                'published_at'   => '2023-09-20 10:00:00',
                'tags'           => json_encode(['climate change', 'policy', 'sustainability', 'Paris Agreement', 'Nigeria']),
            ],
            [
                'title'          => '5 Innovations Transforming Construction in 2023',
                'slug'           => '5-innovations-transforming-construction-2023',
                'excerpt'        => 'Exploring the cutting-edge technologies and methods that are revolutionizing the construction industry this year.',
                'content'        => '<p>The construction industry is experiencing a technological revolution that\'s transforming how we design, build, and maintain structures. At Akstruct Construction, we\'re committed to embracing innovations that enhance quality, sustainability, and efficiency. Here are five transformative innovations making an impact in 2023:</p>

<h3>1. Digital Twins</h3>

<p>Digital twin technology creates virtual replicas of physical buildings that update in real-time. These digital models allow for:
<ul>
    <li>Predictive maintenance to address issues before they become problems</li>
    <li>Optimization of building performance and energy usage</li>
    <li>Testing modifications virtually before implementing them physically</li>
</ul>
We\'ve begun implementing digital twins in our larger commercial projects with tremendous success.</p>

<h3>2. 3D Printing</h3>

<p>Construction 3D printing has moved beyond the experimental stage to practical applications. This technology:
<ul>
    <li>Reduces material waste by up to 60%</li>
    <li>Decreases construction time by 50-70%</li>
    <li>Allows for complex geometric designs that would be challenging with traditional methods</li>
</ul>
Our recent pilot project using 3D printing for non-structural elements demonstrated significant time and cost savings.</p>

<h3>3. Sustainable Materials</h3>

<p>Innovative materials are expanding possibilities for sustainable construction:
<ul>
    <li>Self-healing concrete that can repair its own cracks</li>
    <li>Transparent wood as an alternative to glass with better insulating properties</li>
    <li>Mycelium-based insulation made from fungal roots</li>
</ul>
We\'re currently testing several of these materials in controlled environments before wider implementation.</p>

<h3>4. AI and Machine Learning</h3>

<p>Artificial intelligence is revolutionizing project planning and management:
<ul>
    <li>Predictive analytics for more accurate project timelines and budgeting</li>
    <li>Risk assessment tools that identify potential issues before they occur</li>
    <li>Resource optimization algorithms that reduce waste and improve efficiency</li>
</ul></p>

<h3>5. Robotics and Automation</h3>

<p>Robotic systems are increasingly handling dangerous or repetitive tasks:
<ul>
    <li>Bricklaying robots that can place 1,000+ bricks per day</li>
    <li>Autonomous equipment for site preparation and excavation</li>
    <li>Drones for site monitoring, inspections, and surveys</li>
</ul>
Our integration of drone technology has already improved our site monitoring capabilities by 40%.</p>

<p>At Akstruct Construction, we\'re committed to balancing technological innovation with proven construction practices to deliver exceptional projects that stand the test of time while embracing the future.</p>',
                'featured_image' => 'assets/img/blog/innovations.jpg',
                'category'       => 'Construction News',
                'author'         => 'Chioma Nwosu',
                'reading_time'   => 7,
                'is_published'   => true,
                'published_at'   => '2023-08-15 08:45:00',
                'tags'           => json_encode(['innovation', 'technology', '3D printing', 'digital twins', 'AI', 'robotics']),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
