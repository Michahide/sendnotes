<?php

use Livewire\Volt\Component;

new class extends Component {
    /*    public function with(): array
    {
        return [
            'notes' => [
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
            ],
        ];
    }
*/

    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }

    public function deleteNote($noteId)
    {
        $note = \App\Models\Note::find($noteId);
        $this->authorize('delete', $note);
        $note->delete();
    }
}; ?>

<div>
    {{-- <p>Hi!</p> --}}
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <h1 class="text-lg font-semibold leading-tight text-gray-800">No notes found</h1>
                <p class="mt-1 text-sm text-gray-600">Let's create your first note to send.</p>
                <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create
                    a Note</x-button>
            </div>
        @else
            <div class="flex justify-end">
                <x-button primary icon-right="plus" class="mt-6 mb-4" href="{{ route('notes.create') }}"
                    wire:navigate>Create
                    a Note</x-button>
            </div>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($notes as $note)
                    <x-card>
                        <div class="flex justify-between">
                            <div>
                                <a href="#" class="text-xl font bold hover:underline hover:text-blue-600">
                                    {{ $note->title }}
                                </a>
                                <p class="text-xs mt-2 text-gray-600">
                                    {{ Str::limit($note->body, 100) }}
                                </p>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('d M Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs">
                                Recipient:
                                <span class="font-semibold">
                                    {{ $note->recipient }}
                                </span>
                            </p>
                            <div>
                                {{-- Passing all data about note --}}
                                <x-button.circle icon="eye"
                                    href="{{ route('notes.edit', $note) }}"></x-button.circle>
                                {{-- Delete note --}}
                                <x-button.circle icon="trash"
                                    wire:click="deleteNote('{{ $note->id }}')"></x-button.circle>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
