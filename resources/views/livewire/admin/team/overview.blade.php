<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\TeamMember;

new #[Layout('layout.admin')] class extends Component {
    use WithPagination;

    public $search = '';
    public $departmentFilter = '';
    public $departments = [];

    public function mount()
    {
        $this->departments = TeamMember::distinct('department')->pluck('department')->filter()->values()->toArray();
    }

    public function getTeamMembers()
    {
        return TeamMember::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('position', 'like', '%' . $this->search . '%')
                        ->orWhere('department', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->departmentFilter, function ($query) {
                $query->where('department', $this->departmentFilter);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(10);
    }

    public function togglePublished($memberId)
    {
        $member = TeamMember::find($memberId);
        $member->published = !$member->published;
        $member->save();
    }

    public function deleteMember($memberId)
    {
        $member = TeamMember::find($memberId);
        if ($member->image) {
            Storage::disk('public')->delete($member->image);
        }
        $member->delete();
        session()->flash('message', 'Team member deleted successfully.');
    }

    public function updateOrder($items)
    {
        foreach ($items as $item) {
            TeamMember::find($item['value'])->update(['sort_order' => $item['order']]);
        }
    }
}; ?>

<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-semibold text-gray-800">Team Members</h2>
        <a href="{{ route('admin.team.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary-dark text-white rounded-md hover:bg-primary-darker transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Team Member
        </a>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.live="search" id="search"
                        class="pl-10 focus:ring-primary-dark focus:border-primary-dark block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Search by name, position, or department...">
                </div>
            </div>

            <!-- Department Filter -->
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                <select wire:model.live="departmentFilter" id="department"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-dark focus:border-primary-dark sm:text-sm rounded-md">
                    <option value="">All Departments</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Team Members Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($this->getTeamMembers() as $member)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="relative">
                    @if ($member->image)
                        <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}"
                            class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="h-20 w-20 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">
                        <button wire:click="togglePublished({{ $member->id }})"
                            class="rounded-full p-1 {{ $member->published ? 'bg-green-500' : 'bg-gray-300' }} text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $member->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $member->position }}</p>
                    @if ($member->department)
                        <p class="text-sm text-gray-500 mt-1">{{ $member->department }}</p>
                    @endif

                    <div class="mt-4 flex items-center space-x-4">
                        @if ($member->email)
                            <a href="mailto:{{ $member->email }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </a>
                        @endif
                        @if ($member->phone)
                            <a href="tel:{{ $member->phone }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </a>
                        @endif
                        @if ($member->social_links)
                            @foreach (json_decode($member->social_links, true) ?? [] as $platform => $url)
                                <a href="{{ $url }}" target="_blank"
                                    class="text-gray-400 hover:text-gray-500">
                                    @switch($platform)
                                        @case('linkedin')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                        @break

                                        @case('twitter')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                            </svg>
                                        @break

                                        @default
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z" />
                                            </svg>
                                    @endswitch
                                </a>
                            @endforeach
                        @endif
                    </div>

                    <div class="mt-4 flex justify-end space-x-3">
                        <a href="{{ route('admin.team.edit', $member->id) }}"
                            class="text-primary-dark hover:text-primary-darker">Edit</a>
                        <button wire:click="deleteMember({{ $member->id }})"
                            wire:confirm="Are you sure you want to delete this team member?"
                            class="text-red-600 hover:text-red-900">Delete</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6 rounded-lg shadow">
        {{ $this->getTeamMembers()->links() }}
    </div>
</div>
