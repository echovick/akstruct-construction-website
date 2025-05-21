<?php
namespace App\Livewire\Admin\Projects;

use App\Models\Project;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $project;
    public $projectId;
    public $title             = '';
    public $slug              = '';
    public $description       = '';
    public $short_description = '';
    public $category          = '';
    public $location          = '';
    public $year              = '';
    public $client            = '';
    public $area              = '';
    public $duration          = '';
    public $floors            = '';
    public $status            = 'Completed';
    public $is_featured       = false;
    public $image;
    public $gallery         = [];
    public $existingGallery = [];

    public $statuses   = ['Completed', 'In Progress', 'Planned'];
    public $categories = [
        'Residential',
        'Commercial',
        'Industrial',
        'Educational',
        'Healthcare',
        'Hospitality',
        'Mixed-Use',
        'Cultural',
        'Sports',
        'Urban Planning',
    ];

    public function mount($id = null)
    {
        $this->projectId = $id;

        if ($id) {
            $this->project           = Project::findOrFail($id);
            $this->title             = $this->project->title;
            $this->slug              = $this->project->slug;
            $this->description       = $this->project->description;
            $this->short_description = $this->project->short_description;
            $this->category          = $this->project->category;
            $this->location          = $this->project->location;
            $this->year              = $this->project->year;
            $this->client            = $this->project->client;
            $this->area              = $this->project->area;
            $this->duration          = $this->project->duration;
            $this->floors            = $this->project->floors;
            $this->status            = $this->project->status;
            $this->is_featured       = $this->project->is_featured;
            $this->existingGallery   = $this->project->gallery ?? [];
        } else {
            $this->year = date('Y');
        }
    }

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate([
            'title'       => 'required|min:3|max:255',
            'slug'        => 'required|unique:projects,slug,' . $this->projectId,
            'description' => 'required',
            'category'    => 'required',
            'location'    => 'required',
            'year'        => 'required',
            'image'       => $this->projectId ? 'nullable|image|max:2048' : 'nullable|image|max:2048',
            'gallery.*'   => 'nullable|image|max:2048',
        ]);

        $data = [
            'title'             => $this->title,
            'slug'              => $this->slug,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'category'          => $this->category,
            'location'          => $this->location,
            'year'              => $this->year,
            'client'            => $this->client,
            'area'              => $this->area,
            'duration'          => $this->duration,
            'floors'            => $this->floors,
            'status'            => $this->status,
            'is_featured'       => $this->is_featured,
        ];

        // Handle main image upload
        if ($this->image) {
            $imagePath          = $this->image->store('assets/projects', 'public');
            $data['image_path'] = $imagePath;
        }

        // Handle gallery images upload
        if (count($this->gallery) > 0) {
            $galleryPaths = [];

            // Include existing gallery images
            if (is_array($this->existingGallery)) {
                $galleryPaths = $this->existingGallery;
            }

            // Add new gallery images
            foreach ($this->gallery as $image) {
                $path           = $image->store('assets/projects/gallery', 'public');
                $galleryPaths[] = $path;
            }

            $data['gallery'] = $galleryPaths;
        }

        if ($this->projectId) {
            $this->project->update($data);
            $message = 'Project updated successfully!';
        } else {
            Project::create($data);
            $message = 'Project created successfully!';
        }

        $this->dispatch('notify', [
            'type'    => 'success',
            'message' => $message,
        ]);

        return redirect()->route('admin.projects.index');
    }

    public function removeGalleryImage($index)
    {
        unset($this->existingGallery[$index]);
        $this->existingGallery = array_values($this->existingGallery);
    }

    public function render()
    {
        return view('livewire.admin.projects.form');
    }
}
