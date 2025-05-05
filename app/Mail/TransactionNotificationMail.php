<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TransactionNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public float $amount;
    public string $type;
    public string $transactionType;
    public string $transactionId;
    public string $transactionDate;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, float $amount, string $type, string $transactionType)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->type = $type;
        $this->transactionType = strtolower($transactionType);
        $this->transactionId = 'TXN-' . now()->format('Ymd') . '-' . strtoupper(substr(md5(uniqid()), 0, 8));
        $this->transactionDate = now()->format('D, M j, Y \a\t g:i A');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $action = $this->transactionType === 'credit' ? 'Received' : 'Processed';
        return new Envelope(
            subject: "Your {$this->type} Transaction Has Been {$action}"
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.transaction_notification',
            with: [
                'user' => $this->user,
                'amount' => $this->amount,
                'type' => $this->type,
                'transactionType' => $this->transactionType,
                'transactionId' => $this->transactionId,
                'transactionDate' => $this->transactionDate,
                'currency' => $this->user->currency ?? '$',
                'status' => 'Completed',
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
