<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Closure;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Squire\Models\Country;

class Register extends Component implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public function mount(): void
    {
        if (auth()->check()) {
            redirect()->intended();
        }

        $this->form->fill();
    }

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function save()
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.throttled', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $data = $this->form->getState();

        $user = User::create(
            collect($data)
                ->only([
                    'first_name',
                    'last_name',
                    'date_of_birth',
                    'clubgg_id',
                    'email',
                    'password',
                    'phone_number',
                    'country',
                    'accepts_marketing',
                ])
                ->all()
        );

        auth()->login($user);

        return redirect()->intended();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make()
                ->columns([
                    'md' => 2,
                ])
                ->schema([
                    TextInput::make('first_name')
                        ->label('First name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('last_name')
                        ->label('Last name')
                        ->required()
                        ->maxLength(255),
                    DatePicker::make('date_of_birth')
                        ->label('Date of birth')
                        ->required()
                        ->maxDate(now()->subYears(18)),
                    TextInput::make('clubgg_id')
                        ->label('ClubGG ID')
                        ->required()
                        ->maxLength(255)
                        ->unique(table: User::class)
                        ->rules([
                            static function () {
                                return static function (string $attribute, $value, Closure $fail) {
                                    if (! preg_match('/^[0-9-]+$/', $value)) {
                                        $fail('Invalid ClubGG ID');
                                    }
                                };
                            },
                        ]),
                    TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->maxLength(255)
                        ->confirmed()
                        ->unique(table: User::class),
                    TextInput::make('email_confirmation')
                        ->label('Confirm email address')
                        ->email()
                        ->required(),
                    TextInput::make('password')
                        ->label('Password')
                        ->password()
                        ->required()
                        ->confirmed()
                        ->dehydrateStateUsing(static fn (string $state): string => Hash::make($state)),
                    TextInput::make('password_confirmation')
                        ->label('Confirm password')
                        ->password()
                        ->required(),
                    TextInput::make('phone_number')
                        ->label('Phone number')
                        ->required()
                        ->tel()
                        ->maxLength(255)
                        ->unique(table: User::class),
                    Select::make('country')
                        ->label('Country')
                        ->options(Country::all()->pluck('name', 'id'))
                        ->searchable()
                        ->required(),
                    Grid::make(1)
                        ->schema([
                            Checkbox::make('above_18')
                                ->label('I am over 18 years of age and have read, understand, and accept the Terms and Conditions')
                                ->required(),
                            Checkbox::make('privacy_policy')
                                ->label('I have read, understand, and accept the Privacy Policy')
                                ->required(),
                            Checkbox::make('accepts_marketing')
                                ->label('Occasionally email me important information to help me never miss a new giveaway or player promotion.')
                                ->helperText('Please be assured that your email address is confidential and will never be sold, rented, or shared with a third party.')
                                ->default(true),
                        ]),
                ]),
        ];
    }
}
