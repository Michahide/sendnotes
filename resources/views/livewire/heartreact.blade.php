<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartCount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

/*    public function incrementHeartCount()
    {
        $this->note->increment('heart_count');
        $this->heartCount = $this->note->fresh()->heart_count;
    }
*/
    public function increaseHeartCount()
    {
        $this->note->heart_count++;
        $this->note->save();
        $this->heartCount = $this->note->heart_count;
    }
}; ?>

<div class="ml-4">
    <x-button xs wire:click='increaseHeartCount' rose icon="heart" spinner>{{ $heartCount }}</x-button>
</div>
