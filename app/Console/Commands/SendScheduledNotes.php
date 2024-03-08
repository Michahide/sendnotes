<?php

namespace App\Console\Commands;

use App\Models\Note;
use App\Jobs\SendEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $notes = Note::where('is_published', true)
            ->where('send_date', $now->toDateString())
            ->get();
        
        $noteCount = $notes->count();
        $this->info("Sending {$noteCount} scheduled notes...");
        
            foreach ($notes as $note) {
            // send email to all recipients
            SendEmail::dispatch($note);
            // if (!$this->sendEmail($note)) {
            //     $this->error("Failed to send email for note {$note->id}");
            //     continue;
            // }

            // $note->update(['sent_at' => $now]);
        }
    }
}
