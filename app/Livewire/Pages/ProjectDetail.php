<?php
namespace App\Livewire\Pages;

use App\Models\Project;
use App\Models\Setting;
use Livewire\Component;

class ProjectDetail extends Component
{
    public $project;

    public function mount($project)
    {
        if (is_string($project)) {
            $this->project = Project::where('slug', $project)->firstOrFail();
        } else {
            $this->project = $project;
        }
    }

    public function render()
    {
        // Get related projects in the same category
        $relatedProjects = Project::where('category', $this->project->category)
            ->where('id', '!=', $this->project->id)
            ->take(3)
            ->get();

        return view('livewire.pages.project-detail', [
            'relatedProjects'   => $relatedProjects,
            'projectsCompleted' => Setting::getValue('stats_projects_completed', '150'),
        ]);
    }
}
