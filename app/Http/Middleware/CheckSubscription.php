<?php

namespace App\Http\Middleware;

use App\Enum\Role;
use Bpuig\Subby\Models\Plan;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $plan = Plan::query()->latest()->first();
        $user = auth()->user();
        if ($user AND $user->role != Role::ROLES[0]) {
            if(!$user->email == "agent@warmsure.co.zw" OR !$user->email == "shix@warmsure.co.zw") {
                if (!$user->subscription($plan->tag)->isOnTrial() and $user->paid == 0) {
                    return to_route('getSubscriptionForm');
                }
            }
        }

        return $next($request);
    }
}
