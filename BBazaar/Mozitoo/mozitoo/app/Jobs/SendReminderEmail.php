<?php

namespace App\Jobs;
use App\Jobs\Job;
use Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReminderEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $tenant_details;
    protected $formatted_name;
    public function __construct($tenant_details, $formatted_name)
    {

        $this->tenant_details= $tenant_details;
        $this->formatted_name= $formatted_name;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Reminder email
        $send_mail = Mail::send('reminder_email_format',['user' => $this->tenant_details], function ($message) {
            $message->to($this->tenant_details->email, $this->tenant_details->name)
                ->subject('Rent Invoice')
                ->from('rental@mozitoooo.com', 'Mozitoo');
            });
    }
}
