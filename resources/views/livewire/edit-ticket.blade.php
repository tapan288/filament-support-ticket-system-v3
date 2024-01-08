<x-filament::section class="max-w-7xl mx-auto items-center justify-center">
    <x-slot name="heading">
        Edit Ticket
    </x-slot>
    <form wire:submit="update" class="max-w-7xl mx-auto items-center justify-center">
        {{ $this->form }}

        <x-filament::button type="submit" style="margin-top:30px">
            Submit
        </x-filament::button>
    </form>
</x-filament::section>
