<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Enums\GenderType;
use App\Services\GroupService;
use App\Services\CustomerService;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerEditRequest;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * @var GroupService
     */
    protected $groupService;

    /**
     * @var CustomerService
     */
    protected $customerService;

    public function __construct(GroupService $groupService, CustomerService $customerService)
    {
        $this->groupService = $groupService;
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerService->getAllCustomersWithGroups();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = $this->groupService->getGroupsAsArray();
        $genderTypes = GenderType::cases();

        return view('customers.create', compact('groups', 'genderTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        $customer = $this->customerService->createNewCustomer($request->all());

        if($customer) {
            return back()->with('status', 'customer-created')
                ->with('message', $customer->full_name .' was created successfully.');
        }

        return back()->with('status', 'customer-not-created')
            ->with('message', 'Customer was not created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     *
     * @return View
     */
    public function edit(Customer $customer): View
    {
        if(!$customer) {
            return back()->with('status', 'invalid-customer')
                ->with('message', 'Invalid Customer.');
        }

        $groups = $this->groupService->getGroupsAsArray();
        $customerGroups = $customer->groups()->pluck('name')->toArray();
        $genderTypes = GenderType::cases();

        return view('customers.edit', compact('customer', 'groups', 'genderTypes', 'customerGroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerEditRequest $request
     * @param Customer $customer
     *
     * @return RedirectResponse
     */
    public function update(CustomerEditRequest $request, Customer $customer): RedirectResponse
    {
        $customer = $this->customerService->updateCustomer($request->all(), $customer);

        if($customer) {
            return back()
                ->with('status', 'customer-updated')
                ->with('message', $customer->full_name . ' has been updated successfully.');
        }

        return back()
            ->with('status', 'customer-not-updated')
            ->with('message', $customer->full_name . ' has not been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     *
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $this->customerService->deleteCustomer($customer);

        if ($customer->trashed()) {
            return back()->with('status', 'customer-deleted')
                ->with('message', $customer->full_name . ' has been deleted successfully.');
        }

        return back()->with('status', 'customer-not-deleted')
            ->with('message', $customer->full_name . ' has not been deleted.');
    }
}
