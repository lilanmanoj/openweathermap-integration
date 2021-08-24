<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Throwable;

class OpenWeatherMap
{
    protected $apiKey;

    /**
     * OpenWeatherMap integration helper class.
     */
    public function __construct()
    {
        $this->apiKey = config('weathermap.api_key');
    }

    /**
     * Get current weather of a city.
     *
     * @param int $cityId City id as defined in openweathermap db
     *
     * @return mixed
     */
    public function getCityWeather($cityId)
    {
        try {
            $response = Http::get('http://api.openweathermap.org/data/2.5/weather', [
                'id' => $cityId,
                'appid' => $this->apiKey,
            ]);

            if ($response->successful()) {
                return json_decode($response->getBody());
            } else {
                $response->throw();
            }
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * Get current temperature of a city.
     *
     * @param int $cityId City id as defined in openweathermap db
     *
     * @return mixed
     */
    public function getCityTemperature($cityId)
    {
        try {
            $weather = $this->getCityWeather($cityId);
            $temperature = $weather->main->temp;

            return $temperature;
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }

    /**
     * Get city name.
     *
     * @param int $cityId City id as defined in openweathermap db
     *
     * @return mixed
     */
    public function getCityName($cityId)
    {
        try {
            $weather = $this->getCityWeather($cityId);
            $name = $weather->name;

            return $name;
        } catch (Throwable $th) {
            throw new Exception($th->getMessage());
        }
    }
}
