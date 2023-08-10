<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Exceptions\EmailSendingException;
use App\Jobs\CustomerGroupSendEmailJob;

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

        $this->sendEmail($requestData['subject'], $requestData['body'], $customersEmails);
    }

    /**
     * @param string $subject
     * @param string $body
     * @param array $customersEmails
     *
     * @throws EmailSendingException
     */
    public function sendEmail(string $subject, string $body, array $customersEmails)
    {
        try {
            CustomerGroupSendEmailJob::dispatch([
                'subject' => $subject,
                'body' => $body,
                'customerEmails' => $customersEmails
            ]);

        } catch(EmailSendingException $e) {
            return $e->getMessage();
        }
    }
}
