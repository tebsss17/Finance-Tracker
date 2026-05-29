<?php

use Livewire\Component;

new class extends Component
{

};
?>

<div class="space-y-6">
    {{-- Breadcrumbs --}}
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">
            Home
        </flux:breadcrumbs.item>

        <flux:breadcrumbs.item>
            Transactions
        </flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="flex justify-between">
        <div>
            <flux:heading size="xl">
                Transactions
            </flux:heading>
            <flux:text class="text-zinc-500">
                View your transactions
        </div>
        </flux:text>

        <flux:button
        variant="primary"
        icon="plus-circle"
        href="{{ route('transactions.create') }}"
        >
            Create Transaction
        </flux:button>

    </div>
