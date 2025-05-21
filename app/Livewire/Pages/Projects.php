<?php
namespace App\Livewire\Pages;

use App\Models\Project;
use App\Models\Setting;
use Livewire\Component;

class Projects extends Component
{
    // Properties for filtering
    public $selectedCategory = 'all';
    public $selectedYear     = 'all';

    public function render()
    {
        // Get unique categories and years for filtering
        $categories = Project::select('category')->distinct()->pluck('category')->filter()->toArray();
        $years      = Project::select('year')->distinct()->pluck('year')->filter()->toArray();

        // Filter projects based on selections
        $query = Project::query();

        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }

        if ($this->selectedYear !== 'all') {
            $query->where('year', $this->selectedYear);
        }

        $projects = $query->orderBy('created_at', 'desc')->get();

        return view('livewire.pages.projects', [
            'projects'          => $projects,
            'categories'        => $categories,
            'years'             => $years,
            'featuredProjects'  => Project::where('is_featured', true)->take(6)->get(),
            'projectsCompleted' => Setting::getValue('stats_projects_completed', '150'),
            'yearsExperience'   => Setting::getValue('stats_years_experience', '8'),
        ]);
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSelectedYear()
    {
        $this->resetPage();
    }

    public function resetPage()
    {
        // Reset pagination when filters change
    }
}
