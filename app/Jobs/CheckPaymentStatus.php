<?php

namespace App\Jobs;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Log;
use Paynow\Payments\Paynow;

class CheckPaymentStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info(" ========= running the command started =======".Carbon::now());
        $users = User::query()->where('paid', '=', '0')
            ->whereNotNull('pollUrl')
            ->get();
        $paynow = new Paynow(
            Env::get('INTEGRATION_ID'),
            Env::get('INTEGRATION_KEY'),
            Env::get('RETURN_URL'), // This is the result URL
            Env::get('RESULT_URL')
        );
        foreach ($users as $user) {
            $status = $paynow->pollTransaction($user->pollUrl);
            Log::info("status is ",[$status]);
            if ($status->paid()) {
                $user->update([
                    'pollUrl' => null,
                    'paid' => true
                ]);
            }
        }
        Log::info(" ========= running the command completed =======".Carbon::now());
    }
}
