<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Notes') }}
        </h2>
    </x-slot>
            {{-- $notes = [
            [
                'id' => 1,
                'title' => 'First Note',
                'content' => 'This is the first note',
            ],
            [
                'id' => 2,
                'title' => 'Second Note',
                'content' => 'This is the second note',
            ],
            [
                'id' => 3,
                'title' => 'Third Note',
                'content' => 'This is the third note',
            ],
        ]; --}}
    {{-- @php
        $notes = App\Models\Note::all()
            ->where('user_id', auth()->user()->id)
            ->sortByDesc('updated_at');
    @endphp --}}

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg"> --}}
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    {{-- <x-button primary>Hi There Notes</x-button> --}}
                    {{-- <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                        @foreach ($notes as $note)
                            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                                <h3 class="text-lg font-semibold leading-tight text-gray-800">{{ $note['title'] }}</h3>
                                <p class="mt-2 text-gray-600">{{ $note['content'] }}</p>
                            </div>
                        @endforeach
                    </div> --}}
                    <livewire:notes.show-notes />
                </div>
            {{-- </div> --}}
        </div>
    </div>
</x-app-layout>
