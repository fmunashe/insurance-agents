<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }


    public function create()
    {
        $plans = Plan::all();
        return view('users.create',compact('plans'));
    }


    public function store(StoreUserRequest $request)
    {
        $plan = json_decode($request->plan);
        $plan = Plan::find($plan->id);

        $user = User::query()->create($request->all());

        $user->newSubscription(
            $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
            $plan, // Plan or PlanCombination instance your subscriber is subscribing to
            $plan->name, // Human-readable name for your subscription
            $plan->description, // Description
            null, // Start date for the subscription, defaults to now()
            'free'// Payment method service defined in config
        );
        Alert::toast('User Successfully Created', 'success');
        return to_route('users.index');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $plans = Plan::all();
        return view('users.edit', compact('user','plans'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        $inputData = $request->all();
        $password = $inputData['password'];
        if (isset($password)) {
            $inputData['password'] = Hash::make($password);
        } else {
            $inputData['password'] = $user->password;
        }
        $user->update($inputData);
        Alert::toast('User Successfully Updated', 'success');
        return to_route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        Alert::toast('User Successfully Removed', 'success');
        return to_route('users.index');
    }
}
