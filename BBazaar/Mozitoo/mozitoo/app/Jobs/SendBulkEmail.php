<?php

namespace App\Jobs;
use App\User;
use App\Jobs\Job;
use Mail;
use App\Functions\CustomFunctions;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendBulkEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $tenant_details;
    protected $full_path;
    protected $formatted_name;
    public function __construct($tenant_details, $full_path, $formatted_name)
    {

        $this->tenant_details= $tenant_details;
        $this->full_path= $full_path;
        $this->formatted_name= $formatted_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //Mail with attachment
        $send_mail = Mail::send('rental_invoice_mail_format',['user' =>$this->tenant_details], function ($message) {
            $message->to($this->tenant_details->email, $this->tenant_details->name)
                ->subject('Rent Invoice')
                ->from('rental@mozitoooo.com', 'Mozitoo')
                ->attach($this->full_path, [
                    'as' => $this->formatted_name, 
                    'mime' => 'application/pdf'
                      ]);
                
          });

    }
}
