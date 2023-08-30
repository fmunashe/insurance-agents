<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
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
        return view('users.create');
    }


    public function store(StoreUserRequest $request)
    {
        User::query()->create($request->all());
        Alert::toast('User Successfully Created', 'success');
        return to_route('users.index');
    }


    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
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
