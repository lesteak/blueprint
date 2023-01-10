<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Yadda\Enso\Newsletter\Contracts\NewsletterModelContract;

class UserEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var NewsletterModelContract
     */
    public $newsletter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(NewsletterModelContract $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_enquiry');
    }
}
