<?php

namespace App\Console\Commands;

use App\Helpers\OpenWeatherMap;
use App\Models\User;
use Illuminate\Console\Command;

class LogTemperature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:temperature {user_id} {city_id?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and store current temperature of all pre-defined cities or selected cities against user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('user_id');
        $cityIds = $this->argument('city_id');

        $user = User::findOrFail($userId);

        $weatherProvider = new OpenWeatherMap();

        if (count($cityIds) > 0) {
            // Get and store temperature for selected cities

            foreach ($cityIds as $cityId) {
                $cityName = $weatherProvider->getCityName($cityId);
                $temp = $weatherProvider->getCityTemperature($cityId);

                $user->temperatures()->create([
                    'city_id' => $cityId,
                    'city_name' => $cityName,
                    'temperature' => $temp,
                ]);
            }
        } else {
            // Get and store temperature for all pre-defined cities in config

            $cities = config('weathermap.cities');

            foreach ($cities as $city) {
                $temp = $weatherProvider->getCityTemperature($city['id']);

                $user->temperatures()->create([
                    'city_id' => $city['id'],
                    'city_name' => $city['name'],
                    'temperature' => $temp,
                ]);
            }
        }
    }
}
