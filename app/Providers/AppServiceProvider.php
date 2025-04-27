<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Temple;
use App\Models\Festival;
// use Illuminate\View\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $temples = Temple::take(4)->get();
        $today = Carbon::today();
        $festivals = Festival::where('start_date', '>=', $today)
            ->orderBy('start_date', 'asc')
            ->take(6)
            ->get();
            View::share([
                'ftemples' => $temples,
                'ffestivals' => $festivals
            ]);
    }
}
