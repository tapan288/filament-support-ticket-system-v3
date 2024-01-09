<x-filament::section class="max-w-7xl mx-auto items-center justify-center">
    <x-slot name="heading">
        Tickets List
    </x-slot>

    <x-slot name="headerEnd">
        <x-filament::button href="{{ route('tickets.create') }}" tag="a">
            Add Ticket
        </x-filament::button>
    </x-slot>

    {{ $this->table }}
</x-filament::section>
