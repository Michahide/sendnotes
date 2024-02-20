<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public function mount(Note $note)
    {
        // $this->note = $note;
        $this->authorize('update', $note);
        $this->fill($note->toArray());
    }
}; ?>

<div>
    {{$note->title}}
    {{$note->body}}
</div>
