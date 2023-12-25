<?php

namespace App\Http\Controllers;

use App\Models\User;
use Bpuig\Subby\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Env;
use Paynow\Payments\Paynow;
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
        $plans = Plan::all();

        return view('subscriptions.create', compact('plans'));
    }

    public function subscribe(Request $request)
    {
        if (!isset($request->package)) {
            Alert::error("Please select a subscription package to proceed")->autoClose(false);
            return back();
        }
        // Get the user
        $user = auth()->user();
        $plan = json_decode($request->package);
        $plan = Plan::find($plan->id);

        $paynow = new Paynow(
            Env::get('INTEGRATION_ID'),
            Env::get('INTEGRATION_KEY'),
            Env::get('RETURN_URL'),
            Env::get('RESULT_URL')
        );

        $payment = $paynow->createPayment('Service Subscription ', auth()->user()->email);

        $payment->add('Subscription Fee', $plan->price);

        $response = $paynow->send($payment);
        if ($response->success()) {
            // Get the link to redirect the user to, then use it as you see fit
            $link = $response->redirectUrl();

            $pollUrl = $response->pollUrl();

            User::query()->where('id', '=', $user->id)->update(['pollUrl' => $pollUrl]);
            return redirect()->away($link);
        } else {
            Alert::error("Something went wrong")->autoClose(false);

            return to_route('getSubscriptionForm');
        }

//        $user->newSubscription(
//            $plan->tag, // identifier tag of the subscription. If your application offers a single subscription, you might call this 'main' or 'primary'
//            $plan, // Plan or PlanCombination instance your subscriber is subscribing to
//            $plan->name, // Human-readable name for your subscription
//            $plan->description, // Description
//            null, // Start date for the subscription, defaults to now()
//            'free'// Payment method service defined in config
//        );
    }
}
