<?php

namespace App\Mail\Transport;

use Illuminate\Mail\Transport\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use Symfony\Component\Mime\Part\HtmlPart;
use Swift_Mime_SimpleMessage;

class SymfonyMailTransport extends Transport
{
    protected $mailer;

    public function __construct($host, $port, $encryption, $username, $password)
    {
        $transport = new EsmtpTransport($host, $port, $encryption);
        $transport->setUsername($username);
        $transport->setPassword($password);

        $this->mailer = new Mailer($transport);
    }

    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $email = (new Email())
            ->from($message->getFrom())
            ->to($message->getTo())
            ->cc($message->getCc())
            ->bcc($message->getBcc())
            ->subject($message->getSubject())
            ->text($message->getBody());

        // Handling attachments
        foreach ($message->getChildren() as $attachment) {
            $email->attach($attachment->getBody(), $attachment->getFilename(), $attachment->getContentType());
        }

        $this->mailer->send($email);

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }
}
