<?php

use Livewire\Component;
use App\Models\Accounts;

new class extends Component

{
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $accountID = null;

    public function getAccountsProperty()
    {
        return auth()->user()->accounts;
    }

    public function edit(Accounts $account)
    {
        $this->accountID = $account->id;
        $this->showEditModal = true;
    }


    public function delete(Accounts $account)
    {
        $this->accountID = $account->id;
        $this->showDeleteModal = true;
    }
};
?>

<div class="space-y-6">

    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Home</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Accounts</flux:breadcrumbs.item>
    </flux:breadcrumbs>


    {{-- Header --}}
    <div class="flex items-center justify-between">

        <div>
            <flux:heading size="xl">
                Accounts
            </flux:heading>

            <flux:text class="text-zinc-500">
                Manage your bank, crypto and e-wallet accounts
            </flux:text>
        </div>

        <flux:button variant="primary" icon="plus-circle" href="{{ route('accounts.create') }}" wire:navigate>
            Add Account
        </flux:button>

    </div>

    {{-- Content Card --}}

    @if ($this->accounts->isEmpty())
            <flux:card class="p-6 flex justify-center items-center space-y-4 flex-col">
                    <flux:text class="text-zinc-500 italic">You have no accounts.</flux:text>
                    <flux:button href="{{ route('accounts.create') }}" icon="plus-circle">Add Account</flux:button>
            </flux:card>
        </div>
    @else
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($this->accounts as $account)
                <flux:card  class="p-6 shadow-md">
                    <p> {{ $account->provider }}</p>
                    <p>{{ $account->type }}</p>
                    <p>{{ strtoupper($account->currency) }}</p>
                    <div class="flex justify-end gap-2">
                        <flux:button variant="filled" wire:click='edit({{ $account->id }})'>Edit</flux:button>
                        <flux:button variant="danger" wire:click='delete({{ $account->id }})'>Delete</flux:button>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @endif

    @if ($showEditModal)

    <div
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        wire:click="$set('showEditModal', false)"
    >

        <div
            class="bg-white p-6 rounded-xl w-full max-w-md"
            wire:clic
        >

            <h1 class="text-xl font-bold">
                Edit Modal
            </h1>

            <p>
                Account ID:
                {{ $accountID }}
            </p>

            <button
                wire:click="$set('showEditModal', false)"
                class="bg-black text-white px-4 py-2 rounded mt-4"
            >
                Close
            </button>

        </div>

    </div>

@endif


</div>
