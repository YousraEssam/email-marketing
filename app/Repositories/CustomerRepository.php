<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    /**
     * @param array $requestData
     *
     * @return Customer
     */
    public function createNew(array $requestData): Customer
    {
        $customer = Customer::create($requestData);
        $customer->groups()->attach($requestData['group_id']);
        return $customer;
    }

    /**
     * @return Collection
     */
    public function getAllCustomersWithGroups(): Collection
    {
        return Customer::with('groups')->get();
    }

    /**
     * @param array $requestData
     * @param Customer $customer
     *
     * @return Customer
     */
    public function updateCustomer(array $requestData, Customer $customer): Customer
    {
        $customer->update($requestData);
        $customer->groups()->sync($requestData['group_id']);

        return $customer;
    }

    /**
     * @param Customer $customer
     *
     * @return boolean
     */
    public function deleteCustomer(Customer $customer): bool
    {
        $customer->groups()->detach();
        return $customer->delete();
    }
}
