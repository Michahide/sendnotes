<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    /*    public function submit()
    {
        $this->validate([
            'noteTitle' => 'required',
            'noteBody' => 'required',
            'noteRecipient' => 'required',
            'noteSendDate' => 'required',
        ]);

        $note = Auth::user()->notes()->create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
        ]);

        $this->emit('noteCreated', $note->id);
    }
*/
    public function submit()
    {
        dd($this->noteTitle, $this->noteBody, $this->noteRecipient, $this->noteSendDate);
    }
}; ?>

<div>
    <form wire:submit='submit'>
        <x-input wire:model="noteTitle" type="text" label="Title" placeholder="Title" />
        <x-textarea wire:model="noteBody" label="Body" placeholder="Type your note here..." />
        <x-input wire:model="noteRecipient" type="text" label="Recipient" placeholder="Recipient" />
        <x-input wire:model="noteSendDate" type="date" label="Send Date" />
        <x-button wire:click="submit">Submit</x-button>
    </form>
</div>
