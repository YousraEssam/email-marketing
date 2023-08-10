<?php

namespace App\Console\Commands;

use App\Exceptions\EmailSendingException;
use App\Repositories\GroupRepository;
use App\Services\MailService;
use Illuminate\Console\Command;

class SendCustomerGroupEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-customer-group-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send customer groups email';

    /**
     * Execute the console command.
     * @throws EmailSendingException
     *
     */
    public function handle()
    {
        $groupRepository = new GroupRepository();
        $groupsIds = $groupRepository->getGroupsIdsAsArray();

        $mailService = new MailService($groupRepository);
        try{
            $mailService->sendEmailToCustomerGroup([
                'subject' => 'Test Subject',
                'body' => '<p>Test Body</p>',
                'group_id' => $groupsIds
            ]);

            $this->info("Email sent");

        } catch(EmailSendingException $e) {
            $this->info("Email not sent with error message: ." $e->getMessage());
        }
    }
}
