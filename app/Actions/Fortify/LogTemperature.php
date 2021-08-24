<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Artisan;

class LogTemperature
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param callable                 $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        // Call console command to get the temperatures for all pre-defined cities
        // and record them to db against user, at the end of successful sign-in by user
        Artisan::call('log:temperature', [
            'user_id' => $request->user()->id,
        ]);

        return $next($request);
    }
}
