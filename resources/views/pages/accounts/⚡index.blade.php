<?php

use Livewire\Component;
use App\Models\Accounts;

new class extends Component
{
    public $showDeleteModal = false;
    public $accountID = null;
    public $selectedAccount = null;

    public function getAccountsProperty()
    {
        return auth()->user()->accounts;
    }

    public function delete(Accounts $account)
    {
        $this->accountID = $account->id;
        $this->selectedAccount = $account;
        $this->showDeleteModal = true;
    }

    public function destroy()
    {
        $deleteID = $this->accountID;

        if ($deleteID) {
            $this->closeDeleteModal();
            Accounts::findOrFail($deleteID)->delete();
        }
    }

    public function closeDeleteModal()
    {
        $this->reset([
            'showDeleteModal',
            'accountID',
            'selectedAccount',
        ]);
    }
};

?>

<div class="space-y-6">

    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">
            Home
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Accounts
        </flux:breadcrumbs.item>
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

        <flux:button
            variant="primary"
            icon="plus-circle"
            href="{{ route('accounts.create') }}"
        >
            Add Account
        </flux:button>

    </div>

    {{-- Empty State --}}
    @if ($this->accounts->isEmpty())

        <flux:card class="p-8 flex flex-col items-center justify-center gap-4 dark:bg-blue-400">

            <flux:text class="text-zinc-500 italic">
                You have no accounts yet.
            </flux:text>

            <flux:button
                href="{{ route('accounts.create') }}"
                icon="plus-circle"
            >
                Add Account
            </flux:button>

        </flux:card>

    @else

        {{-- Accounts Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach ($this->accounts as $account)

                {{-- Binigyan ng natatanging wire:key para alam ni Livewire kung aling card ang nabura --}}
                <flux:card class="p-6 shadow-md space-y-4" wire:key="account-card-{{ $account->id }}">

                    <div class="space-y-1">

                        <flux:heading size="lg">
                            {{ strtoupper($account->provider) }}
                        </flux:heading>

                        <flux:text class="text-zinc-500">
                            {{ ucfirst($account->type) }}
                        </flux:text>

                        <flux:text>
                            {{ strtoupper($account->currency) }}
                        </flux:text>

                    </div>

                    <div class="flex justify-end gap-2">

                        <flux:button
                            variant="filled"
                            href="{{ route('accounts.edit', $account) }}"
                        >
                            Edit
                        </flux:button>

                        <flux:button
                            variant="danger"
                            wire:click="delete({{ $account->id }})"
                        >
                            Delete
                        </flux:button>

                    </div>

                </flux:card>

            @endforeach

        </div>

    @endif

    {{-- DELETE MODAL --}}
    @if ($showDeleteModal === true)

        <div
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
            wire:click="closeDeleteModal"
        >

            <div
                class="bg-white rounded-2xl p-6 w-full max-w-md space-y-6 shadow-xl"
                wire:click.stop
            >

                <div class="space-y-2">

                    <flux:heading size="xl">
                        Delete Account no. {{ $selectedAccount->id }}
                    </flux:heading>

                    <flux:text class="text-zinc-500">

                        Are you sure you want to delete your

                        <span class="font-semibold">
                            {{ strtoupper($selectedAccount->provider) }}
                        </span>

                         account?

                    </flux:text>

                </div>

                <div class="flex justify-end gap-3">

                    <flux:button
                        wire:click="closeDeleteModal"
                    >
                        Cancel
                    </flux:button>

                    <flux:button
                        variant="danger"
                        wire:click="destroy"
                    >
                        Delete
                    </flux:button>

                </div>

            </div>

        </div>

    @endif

</div>
