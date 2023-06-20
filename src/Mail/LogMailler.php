<?php

namespace Oguzkurukaya\LogMonitoring\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LogMailler extends Mailable
{
    use Queueable, SerializesModels;


    use Queueable, SerializesModels;

    private const DEFAULT_VIEW = 'log-monitoring::email.defaultEmail';
    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view =  config('mail.log-monitoring.mail_view') ?? self::DEFAULT_VIEW;
        return $this->subject('You Have Log From ' . config('app.name'))
            ->view($view);
    }
}
