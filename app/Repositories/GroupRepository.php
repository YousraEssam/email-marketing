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
     * @param array $requestData
     *
     * @return Group
     */
    public function createNew(array $requestData): Group
    {
        return Group::create($requestData);
    }
}
