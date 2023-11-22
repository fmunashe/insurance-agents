<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubscriptionPlanRequest;
use App\Http\Requests\UpdateSubscriptionPlanRequest;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $user = auth()->user();
//        dd($user->onTrial('Service-Subscription'));
//        dd($user->subscribed('Service-Subscription'));
        $plans = SubscriptionPlan::all();
        return view('subscriptions.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subscriptions.create-plan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubscriptionPlanRequest $request)
    {
        SubscriptionPlan::query()->create($request->all());
        toast('Plan Successfully Added', 'success');
        return to_route('subscriptionPlan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscriptionPlan $subscriptionPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscriptionPlan)
    {
        return view('subscriptions.edit-plan', compact('subscriptionPlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubscriptionPlanRequest $request, SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->update($request->all());
        toast('Plan Successfully Updated', 'success');
        return to_route('subscriptionPlan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscriptionPlan $subscriptionPlan)
    {
        $subscriptionPlan->delete();
        toast('Plan Successfully Removed', 'success');
        return to_route('subscriptionPlan.index');
    }
}
