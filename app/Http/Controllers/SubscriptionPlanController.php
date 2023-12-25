<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Models\Currency;
use Bpuig\Subby\Models\Plan;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return view('subscriptions.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('subscriptions.create-plan',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        Plan::query()->create($request->all());
        toast('Plan Successfully Added', 'success');
        return to_route('subscriptionPlan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $subscriptionPlan)
    {
        dd($subscriptionPlan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $subscriptionPlan)
    {
        $currencies = Currency::all();
        return view('subscriptions.edit-plan', compact('subscriptionPlan','currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionPlanRequest $request, Plan $subscriptionPlan)
    {
        $subscriptionPlan->update($request->all());
        toast('Plan Successfully Updated', 'success');
        return to_route('subscriptionPlan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $subscriptionPlan)
    {
        $subscriptionPlan->delete();
        toast('Plan Successfully Removed', 'success');
        return to_route('subscriptionPlan.index');
    }
}
