<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\Ticket;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CreateTicket extends Component implements HasForms
{
    use InteractsWithForms;

    protected static ?string $model = Ticket::class;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function create()
    {
        Ticket::create($this->form->getState() + [
            'assigned_by' => auth()->id(),
        ]);

        Notification::make()
            ->title('Ticket created successfully')
            ->success()
            ->send();

        return redirect()->route('tickets.index');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->autofocus()
                    ->required(),
                Textarea::make('description')
                    ->rows(3),
                Select::make('status')
                    ->options(self::$model::STATUS)
                    ->required()
                    ->in(self::$model::STATUS),
                Select::make('priority')
                    ->options(self::$model::PRIORITY)
                    ->required()
                    ->in(self::$model::PRIORITY),
                Select::make('assigned_to')
                    ->options(
                        User::whereHas('roles', function (Builder $query) {
                            $query->where('name', Role::ROLES['Agent']);
                        })->pluck('name', 'id')->toArray(),
                    )
                    ->required(),
                Textarea::make('comment')
                    ->rows(3),
                FileUpload::make('attachment')
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('livewire.create-ticket');
    }
}
