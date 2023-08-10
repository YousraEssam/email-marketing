<?php

namespace App\Exceptions;

use Exception;

class EmailSendingException extends Exception
{
    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $customerEmail;


    public function __construct(string $subject, string $customerEmail)
    {
        $this->subject = $subject;
        $this->customerEmail = $customerEmail;
    }

    /**
     * Get the exception's context information.
     *
     * @return array<string, mixed>
     */
    public function context(): array
    {
        return [
            'customer_email' => $this->customerEmail
        ];
    }
}
