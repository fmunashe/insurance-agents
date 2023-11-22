<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard(Request $request)
    {
        return view('dashboard');
    }


    public function getSubscriptionForm()
    {
        $intent = auth()->user()->createSetupIntent();
        $plans = SubscriptionPlan::all();

        return view('subscriptions.create', compact('intent', 'plans'));
    }

    public function subscribe(Request $request)
    {
        // Get the user
        $user = auth()->user();

        // Create a new subscription
        $user->newSubscription('Service-Subscription', $request->package)
            ->trialUntil(Carbon::now()->addDays(5))
            ->create($request->stripeToken);
        Alert::success("Subscription went through successfully")->autoClose(false);

        return to_route('dashboard');
    }
}
