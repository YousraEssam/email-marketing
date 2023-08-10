<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailSendingException;
use App\Http\Requests\MailRequest;
use App\Jobs\CustomerGroupSendEmailJob;

class MailController extends Controller
{
    /**
     *
     * @param MailRequest $request
     *
     * @throws EmailSendingException
     */
    public function sendEmail(MailRequest $request)
    {
        try {
            CustomerGroupSendEmailJob::dispatch($request->all());

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
