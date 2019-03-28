<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Term;

class TermsUpdated extends Mailable {

    use Queueable,
        SerializesModels;

    public $term;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Term $term) {
        $this->term = $term;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('emails.terms_updated');
    }

}
