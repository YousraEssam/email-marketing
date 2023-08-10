<?php

namespace App\Http\Controllers;

use App\Enums\GenderType;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Services\GroupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
        $this->customerService->createNewCustomer($request->all());
        return back()->with('status', 'customer-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
