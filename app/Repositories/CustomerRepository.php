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

    public function getAllCustomersWithGroups(): Collection
    {
        return Customer::with('groups')->get();
    }
}
