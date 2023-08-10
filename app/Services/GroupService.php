<?php

namespace App\Services;

use App\Repositories\GroupRepository;

class GroupService
{
    /**
     * @var GroupRepository
     */
    protected $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    /**
     * @return array
     */
    public function getGroupsAsArray(): array
    {
        return $this->groupRepository->getGroupsAsArray();
    }
}
