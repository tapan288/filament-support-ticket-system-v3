<div>
    <x-slot name="heading">
        Create Ticket
    </x-slot>
    <form wire:submit="create" class="max-w-7xl mx-auto items-center justify-center">
        {{ $this->form }}

        <x-filament::button type="submit" style="margin-top:30px">
            Submit
        </x-filament::button>
    </form>
</div>
