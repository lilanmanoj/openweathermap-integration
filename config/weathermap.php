<?php

return [
    /*
     * API key provided by OpenWeatherMap
     */
    'api_key' => env('OPENWEATHERMAP_API_KEY', ''),

    /*
     * Define cities those need to get and store
     * the current temperature when user sign-in.
     *
     * Note: Here id need to be the id of city which provided by OpenWeatherMap db
     * which can be find here:
     * http://bulk.openweathermap.org/sample/city.list.json.gz
     */
    'cities' => [
        0 => [
            'id' => 1248991,
            'name' => 'Colombo',
        ],
        1 => [
            'id' => 2158177,
            'name' => 'Melbourne',
        ],
    ],
];
