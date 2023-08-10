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
}
