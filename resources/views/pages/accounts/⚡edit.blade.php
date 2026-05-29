<?php

use Livewire\Component;
use App\Models\Accounts;

new class extends Component
{
    public $type = '';
    public $provider = '';
    public $balance = '';
    public $currency = '';
    public $selectedAccount = null;
    public Accounts $account;

    public function getProvidersProperty()
    {
        return $this->type
            ? config("providers.{$this->type}", [])
            : [];
    }

    public function updatedType()
    {
        $this->provider = '';
    }

    public function update()
    {
        $validated = $this->validate([
            'type' => 'required',
            'provider' => 'required',
            'balance' => 'required|min:0.01|numeric',
            'currency' => 'required',
        ]);


        $this->account->update($validated);

        return redirect()->route('accounts.index');
    }

    public function mount(Accounts $account)
    {
        $this->account = $account;

        $this->type = $account->type;
        $this->provider = $account->provider;
        $this->balance = $account->balance;
        $this->currency = $account->currency;
    }

};
?>

<div class="space-y-8">

    {{-- HEADER --}}
    <div class="space-y-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="{{ route('accounts.index') }}">
                Accounts
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                Edit
            </flux:breadcrumbs.item>
            <flux:breadcrumbs.item>
                {{ ucfirst($account->provider) }}
            </flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <div>
            <flux:heading size="xl">Edit your account</flux:heading>
            <flux:text class="text-zinc-500 border-b pb-3 border-zinc-400">
                Edit your existing account
            </flux:text>
        </div>
    </div>

    {{-- FORM GRID --}}
    <form wire:submit='update' class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- TYPE --}}
            <flux:select
                label="Type"
                wire:model.live="type"
                placeholder="Select account type"
            >
                <flux:select.option value="bank">Bank</flux:select.option>
                <flux:select.option value="e-wallet">E-wallet</flux:select.option>
                <flux:select.option value="crypto">Crypto</flux:select.option>
            </flux:select>

            {{-- PROVIDER --}}
            <flux:select
                label="Provider"
                wire:model.live="provider"
                placeholder="Select provider"
                :disabled="empty($type)"
            >
                @foreach ($this->providers as $key => $provider)
                    <flux:select.option value="{{ $key }}">
                        {{ $provider['name'] }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <flux:input
            type="number"
            wire:model="balance"
            placeholder="Input amount"
            label="Amount"
            step="0.01"
        >
        </flux:input>

        <flux:select
        label="Currency"
        wire:model="currency"
        placeholder="Select your preferred currency"
        >
            <flux:select.option value="php">PHP</flux:select.option>
            <flux:select.option value="usd">USD</flux:select.option>
            <flux:select.option value="euro">EURO</flux:select.option>
        </flux:select>

        <div class="flex justify-end gap-4">
            <flux:button href="{{ route('accounts.index') }}">Cancel</flux:button>
            <flux:button type="submit">Save</flux:button>
        </div>
    </form>



</div>
