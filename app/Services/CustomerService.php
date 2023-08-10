<?php

namespace App\Services;

use App\Models\Customer;
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
     * @return Customer
     */
    public function createNewCustomer(array $requestData): Customer
    {
        return $this->customerRepository->createNew($requestData);
    }

    /**
     * @return Collection
     */
    public function getAllCustomersWithGroups(): Collection
    {
        return $this->customerRepository->getAllCustomersWithGroups();
    }

    /**
     * @param array $requestData
     * @param Customer $customer
     *
     * @return Customer
     */
    public function updateCustomer(array $requestData, Customer $customer): Customer
    {
        return $this->customerRepository->updateCustomer($requestData, $customer);
    }

    /**
     * @param Customer $customer
     *
     * @return bool
     */
    public function deleteCustomer(Customer $customer): bool
    {
        return $this->customerRepository->deleteCustomer($customer);
    }
}
