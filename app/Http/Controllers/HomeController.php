<?php

namespace App\Http\Controllers;

use App\Enum\Role;
use App\Models\User;
use Illuminate\Http\Request;
use SaKanjo\EasyMetrics\Metrics\Doughnut;
use SaKanjo\EasyMetrics\Metrics\Trend;
use SaKanjo\EasyMetrics\Metrics\Value;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function dashboard(Request $request)
    {

        $roles = Doughnut::make(User::class)
            ->count('role');

        [$labels, $data] = Trend::make(User::class)
            ->countByMonths();
//        dd($roles);

        [$labels, $data] = Doughnut::make(User::class)
            ->options(Role::ROLES)
            ->count('role');
//
//        return [
//            'datasets' => [
//                [
//                    'label' => 'Users',
//                    'data' => $data,
//                ],
//            ],
//            'labels' => $labels,
//        ];
        return view('dashboard');
    }
}
