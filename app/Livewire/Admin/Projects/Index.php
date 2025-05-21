<?php
namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search        = '';
    public $category      = '';
    public $sortField     = 'created_at';
    public $sortDirection = 'desc';
    public $perPage       = 10;

    public $confirmingProjectDeletion = false;
    public $projectToDelete           = null;

    public function mount()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function confirmProjectDeletion($id)
    {
        $this->confirmingProjectDeletion = true;
        $this->projectToDelete           = $id;
    }

    public function deleteProject()
    {
        $project = Project::find($this->projectToDelete);

        if ($project) {
            $project->delete();
            $this->dispatch('notify', [
                'type'    => 'success',
                'message' => 'Project deleted successfully!',
            ]);
        }

        $this->confirmingProjectDeletion = false;
        $this->projectToDelete           = null;
    }

    public function toggleFeatured($id)
    {
        $project = Project::find($id);

        if ($project) {
            $project->is_featured = ! $project->is_featured;
            $project->save();

            $this->dispatch('notify', [
                'type'    => 'success',
                'message' => $project->is_featured
                ? 'Project set as featured!'
                : 'Project removed from featured!',
            ]);
        }
    }

    public function render()
    {
        $query = Project::query()
            ->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                return $query->where('category', $this->category);
            })
            ->orderBy($this->sortField, $this->sortDirection);

        $projects   = $query->paginate($this->perPage);
        $categories = Project::select('category')->distinct()->pluck('category');

        return view('livewire.admin.projects.index', [
            'projects'   => $projects,
            'categories' => $categories,
        ]);
    }
}
