<?php

namespace App\Http\Livewire\Member\Billing;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class Deposit extends Component implements HasForms
{
    use InteractsWithForms;

    public function mount(): void
    {
        if (! auth()->check()) {
            redirect()->route('auth.login');
        }

        $this->form->fill();
    }

    public function render(): View
    {
        return view('livewire.member.billing.deposit');
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Billing information')
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('amount')
                                    ->label('Amount')
                                    ->required()
                                    ->numeric()
                                    ->mask(static fn (TextInput\Mask $mask) => $mask->money())
                                    ->minValue(50),
                            ]),
                    ]),

                Wizard\Step::make('Payment')
                    ->schema([

                    ]),
            ])->submitAction(new HtmlString('<button type="submit">Submit</button>')),
        ];
    }
}
