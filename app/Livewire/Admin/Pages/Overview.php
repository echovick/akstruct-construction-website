<?php
namespace App\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithPagination;

class Overview extends Component
{
    use WithPagination;

    public $search        = '';
    public $sortBy        = 'name';
    public $sortDirection = 'asc';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    public function delete($id)
    {
        Page::findOrFail($id)->delete();

        session()->flash('message', 'Page deleted successfully.');
    }

    public function togglePublished($id)
    {
        $page = Page::findOrFail($id);
        $page->update(['is_published' => ! $page->is_published]);

        session()->flash('message', 'Page status updated successfully.');
    }

    public function render()
    {
        $pages = Page::query()
            ->when($this->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.pages.overview', [
            'pages' => $pages,
        ])->layout('layout.admin');
    }
}
