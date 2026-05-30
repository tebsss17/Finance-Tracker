<?php

use Livewire\Component;
use App\Models\Categories;

new class extends Component
{
    public $name = '';
    public $showeditModal = false;
    public $showdeleteModal = false;
    public $showAddModal = false;
    public $selectedCategory = null;

    public function openAddModal()
    {
        $this->showAddModal = true;
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->reset('name');
    }

    public function openEditModal(Categories $category)
    {
        $this->showeditModal = true;
        $this->selectedCategory = $category;
    }

    public function closeEditModal () {
        $this->showeditModal = false;
        $this->reset('name');
    }

    public function openDeleteModal(Categories $category)
    {
        $this->showdeleteModal = true;
        $this->selectedCategory = $category;
    }

    public function closeDeleteModal ()
    {
        $this->showdeleteModal = false;
        $this->reset('name');
    }


    public function getCategoriesProperty()
    {
        return auth()->user()->categories ?? collect();
    }


};
?>

<div class="space-y-6">
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">
            Home
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Categories
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl">
                Categories
            </flux:heading>

            <flux:text>
                Manage your categories by adding ,editing, or deleting
            </flux:text>
        </div>

        <flux:button
            wire:click='openAddModal'
            variant="primary"
            icon="plus-circle"
        >
            Add Categories
        </flux:button>
    </div>

    @forelse ($this->categories as $category )
         <flux:card class="p-4 flex items-center justify-between">

        <div>
            <flux:heading size="lg">
                {{ $category->name }}
            </flux:heading>
        </div>

        <div class="flex gap-2">

            <flux:button
                size="sm"
                wire:click="openEditModal({{ $category->id }})"
            >
                Edit
            </flux:button>

            <flux:button
                size="sm"
                variant="danger"
                wire:click="openDeleteModal({{ $category->id }})"
            >
                Delete
            </flux:button>

        </div>

    </flux:card>

    @empty
        <flux:card class="p-8 flex flex-col items-center justify-center gap-4">
            <flux:text class="text-zinc-500 italic">
                No categories yet. Add one
            </flux:text>

            <flux:button
                wire:click='openAddModal'
                variant="primary"
            >
                    Add Category
            </flux:button>

        </flux:card>

    @endforelse


</div>
