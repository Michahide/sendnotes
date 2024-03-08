<?php

namespace App\Jobs;

use App\Mail\SendEmail as MailSendEmail;
use App\Models\Note;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Note $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;
        // \Mail::to($this->note->user)->send(new \App\Mail\NoteCreated($this->note, $noteUrl));
        // $emailContent = "Email content for note {$this->note->id} at {$noteUrl}";
        // Mail::raw($emailContent, function ($message) {
        //     $message->from($this->note->user->email, $this->note->user->name)
        //         ->to($this->note->recipient)
        //         ->subject('You have a new note: ', $this->note->title);
        // });
        // Mail::send('emails.note-created', ['note' => $this->note, 'noteUrl' => $noteUrl], function ($message) {
        //     $message->from($this->note->user->email, $this->note->user->name)
        //         ->to($this->note->recipient)
        //         ->subject('You have a new note: ', $this->note->title);
        // });
        Mail::to($this->note->recipient)
            ->send(new MailSendEmail($this->note));
    }
}
