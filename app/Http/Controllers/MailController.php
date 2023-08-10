<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailSendingException;
use App\Http\Requests\MailRequest;
use App\Services\MailService;
use Illuminate\View\View;

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
     *
     * @return View
     */
    public function sendEmail(MailRequest $request): View
    {
        try{
            $this->mailService->sendEmailToCustomerGroup($request->all());

            return view('dashboard')
                ->with('status', 'email-sent')
                ->with('message', 'Email was sent successfully');

        } catch (EmailSendingException $e){
            return view('dashboard')
                ->with('status', 'email-not-sent')
                ->with('message', $e->getMessage());
        }
    }
}
