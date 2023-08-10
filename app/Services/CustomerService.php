<?php

namespace App\Services;

use App\Repositories\CustomerRepository;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param array $requestData
     */
    public function createNewCustomer(array $requestData): void
    {
        $this->customerRepository->createNew($requestData);
    }

    public function getAllCustomersWithGroups(): Collection
    {
        return $this->customerRepository->getAllCustomersWithGroups();
    }
}
