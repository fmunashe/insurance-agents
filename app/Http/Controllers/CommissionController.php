<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Http\Requests\StoreCommissionRequest;
use App\Http\Requests\UpdateCommissionRequest;
use App\Models\Commission;
use App\Models\ProductCategory;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commissions = Commission::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $commissions = Commission::query()
                ->where('user_id', '=', auth()->user()->id)
                ->get();
        }

        return view('commissions.index', compact('commissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $categories = $categories->where('user_id', '=', auth()->user()->id)->collect();
        }
        return view('commissions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommissionRequest $request)
    {
        Commission::query()->create($request->all());
        toast('Commission Band Successfully Created', 'success');
        return to_route('commissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Commission $commission)
    {
        return view('commissions.show', compact('commission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commission $commission)
    {
        $categories = ProductCategory::all();
        if (auth()->user()->role != Role::ROLES[0]) {
            $categories = $categories->where('user_id', '=', auth()->user()->id)->collect();
        }
        return view('commissions.edit', compact('commission', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommissionRequest $request, Commission $commission)
    {
        $commission->update($request->all());
        toast('Commission Band Successfully Updated', 'success');
        return to_route('commissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commission $commission)
    {
        $commission->delete();
        toast('Commission Band Successfully Deleted', 'success');
        return to_route('commissions.index');
    }
}
