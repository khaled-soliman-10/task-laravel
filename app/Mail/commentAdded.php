<?php

namespace App\Mail;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class commentAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $post;
    public $comment;
    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post, Comment $comment, User $post_owner)
    {
        $this->post = $post;
        $this->comment = $comment;
        $this->user = $post_owner;
    }

    public function build() {
        return $this->subject('New Comment on Your Post')
            ->view('emails.comment_added');
    }

}
