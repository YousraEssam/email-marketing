<?php

namespace App\Http\Controllers;

use App\Enums\GenderType;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Group;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = Group::all()->pluck('id', 'name')->toArray();
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
        $customer = Customer::create($request->only(['first_name', 'last_name', 'email', 'gender', 'birth_date']));
        $customer->groups()->attach($request->only('group_id'));
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
