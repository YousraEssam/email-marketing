<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Exceptions\EmailSendingException;
use App\Mail\CustomerGroupsMail;
use Illuminate\Support\Facades\Mail;

use function Termwind\render;

class MailService
{
    /**
     * @var GroupRepository
     */
    public $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @param array $requestData
     *
     * @throws EmailSendingException
     */
    public function sendEmailToCustomerGroup(array $requestData)
    {
        $customersEmails = $this->groupRepository->getCustomerEmailsByGroupId($requestData['group_id']);

        foreach($customersEmails as $email) {
            $this->sendEmail($requestData['subject'], $requestData['body'], $email);
        }
    }

    /**
     * @param string $subject
     * @param string $body
     * @param string $email
     *
     * @throws EmailSendingException
     */
    public function sendEmail(string $subject, string $body, string $email)
    {
        try {
            Mail::to($email)->send(new CustomerGroupsMail($subject, $body, $email));

        } catch(EmailSendingException $e) {
            return $e->getMessage();
        }
    }
}
