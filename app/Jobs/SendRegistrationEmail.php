<?php

namespace App\Jobs;

use App\Mail\RegistrationMail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;




class SendRegistrationEmail implements ShouldQueue
{
    use Queueable;
    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
       // Check the type of email to send
       Log::info('Email Job Data:', $this->data);

       // Check if 'type' key exists and send the appropriate email
       if (!empty($this->data['type']) && $this->data['type'] === "forgotPasswordLink") {
           Log::info('Sending Forgot Password Email to: ' . $this->data['email']);
           Mail::to($this->data['email'])->send(new ForgotPasswordMail($this->data));
       } else {
           Log::info('Sending Registration Email to: ' . $this->data['email']);
           Mail::to($this->data['email'])->send(new RegistrationMail($this->data));
       }
        // Mail::to($this->data['email'])->send(new RegistrationMail($this->data));

    }
}
