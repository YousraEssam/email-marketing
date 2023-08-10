<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository
{
    /**
     * @return array
     */
    public function getGroupsAsArray(): array
    {
        return Group::all()->pluck('id', 'name')->toArray();
    }

    /**
     * @return array
     */
    public function getGroupsIdsAsArray(): array
    {
        return Group::all()->pluck('id')->toArray();
    }

    /**
     * @param array $requestData
     *
     * @return Group
     */
    public function createNew(array $requestData): Group
    {
        return Group::create($requestData);
    }

    /**
     * @param array $groupsIds
     *
     * @return array
     */
    public function getCustomerEmailsByGroupId(array $groupsIds): array
    {
        $groups = Group::with('customers')->whereIn('id', $groupsIds)->get();

        $customersEmails = [];
        $groups->map(function (Group $group) use (&$customersEmails) {

            $groupCustomers = $group->customers()->pluck('email')->toArray();

            $customersEmails = array_unique(array_merge($customersEmails, $groupCustomers));

        });

        return array_unique($customersEmails);
    }
}
