<?php

namespace App\Http\Controllers;

use App\Services\MailService;
use App\Http\Requests\MailRequest;
use App\Exceptions\EmailSendingException;

class MailController extends Controller
{
    /**
     * @var MailService
     */
    protected $mailService;

    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     *
     * @param MailRequest $request
     *
     * @throws EmailSendingException
     */
    public function sendEmail(MailRequest $request)
    {
        try {
            $this->mailService->sendEmailToCustomerGroup($request->all());

            return back()
                ->with('status', 'email-sent')
                ->with('message', 'Email was sent successfully');

        } catch(EmailSendingException $e) {

            return back()
                ->with('status', 'email-not-sent')
                ->with('message', $e->getMessage());
        }
    }
}
