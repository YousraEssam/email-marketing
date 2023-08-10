<?php

namespace App\Services;

use App\Models\Group;
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

    /**
     * @param array $requestData
     *
     * @return Group
     */
    public function createNew(array $requestData): Group
    {
        return $this->groupRepository->createNew($requestData);
    }
}
