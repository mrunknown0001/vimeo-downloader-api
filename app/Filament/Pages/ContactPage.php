<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Enums\UserRole;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Section;

class ContactPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static string $view = 'filament.pages.contact-page';

    protected static ?string $navigationLabel = "Contact";

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'Contact';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(); // Optional: pre-fill form
    }

    // 🧩 Define your form schema
    protected function getFormSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Full Name')
                        ->required(),
        
                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->required(),
        
                    Forms\Components\Textarea::make('message')
                        ->label('Message')
                        ->rows(4),
                ]),
        ];
    }

    public function submit()
    {
        $data = $this->form->getState();

        // Example: save to database or process
        // MyModel::create($data);

        $this->notify('success', 'Form submitted successfully!');
    }

    public static function canAccess(): bool
    {
        return in_array(auth()->user()->role, [UserRole::User]);
    }
}
