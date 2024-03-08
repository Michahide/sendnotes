<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function submit()
    {
        $validated = $this->validate([
            /*'noteTitle' => 'required',*/
            'noteTitle' => ['required', 'string', 'min:3', 'max:255'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        $note = Auth::user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => true, //default value for new notes.
            ]);

        redirect()->route('notes.index');
        // $this->emit('noteCreated', $note->id);
    }

    /*    public function submit()
    {
        dd($this->noteTitle, $this->noteBody, $this->noteRecipient, $this->noteSendDate);
    }
*/
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-input wire:model="noteTitle" type="text" label="Note Title" placeholder="Greetings!" />
        <x-textarea wire:model="noteBody" label="Body" placeholder="Tell a story or something to your friend" />
        <x-input icon="user" wire:model="noteRecipient" type="text" label="Recipient"
            placeholder="Your friend email" />
        <x-input icon="calendar" wire:model="noteSendDate" type="date" label="Send Date" />
        <x-button wire:click="submit" primary right-icon="calendar" spinner>Schedule Note</x-button>
    </form>
</div>
