<?php

namespace App\Http\Controllers;

use App\Services\GroupService;
use App\Services\CustomerService;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\RedirectResponse;

class GroupController extends Controller
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
        return view('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupRequest $request
     *
     * @return RedirectResponse
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        $group = $this->groupService->createNew($request->only('name'));
        if($group) {
            return back()->with('status', 'group-created')
                ->with('message', $group->name .' was created successfully');
        }

        return back()->with('status', 'group-not-created')
            ->with('message', 'Group was not created.');
    }
}
