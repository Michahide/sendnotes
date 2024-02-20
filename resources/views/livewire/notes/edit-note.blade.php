<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        // $this->note = $note;
        $this->authorize('update', $note);
        $this->fill($note->toArray());
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:3', 'max:255'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->redirect(route('notes.index'));

        $this->dispatch('note-saved');
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-2xl sm:px-6 lg:px-8">
            <form wire:submit='saveNote' class="space-y-4">
                <x-input wire:model="noteTitle" type="text" label="Note Title" placeholder="Greetings!" />
                <x-textarea wire:model="noteBody" label="Body"
                    placeholder="Tell a story or something to your friend" />
                <x-input icon="user" wire:model="noteRecipient" type="text" label="Recipient"
                    placeholder="Your friend email" />
                <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send Date" />
                <x-checkbox wire:model="noteIsPublished" label="Note Published" />
                <x-button icon="check" wire:click="saveNote" primary spinner>Save Note</x-button>
                <x-button icon="arrow-left" href="{{ route('notes.index') }}" wire:navigate secondary>
                    Back to Notes
                </x-button>
                <x-action-message on="note-saved" />
                <x-errors />
            </form>
        </div>
    </div>
