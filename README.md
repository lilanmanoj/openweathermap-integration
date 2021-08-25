# overview

The task is to implement a small webapp that will store the current temperature of two cities when a user logs in, and display a historical list of the users login temperatures.

Current temperature fetch using OpenWeatherMap API.

## Requirements

- PHP >= 7.3

- MySQL or SQLite

- All other requirements need to be satisfied can be found [here]: https://laravel.com/docs/8.x/deployment#server-requirements 


## Used Libraries/Tech

- Laravel 8
- Jetstream [Inertia + Vue]  - This was used as a starter kit for scaffold the application
- Fortify - Headless authentication  backend for laravel defaultly comes with Jetstream
- Tailwind CSS - CSS styling library comes with Jetstream

## Approach

1. Pre-defined cities and OpenWeatherMap (OWM) API key was configured in config/weathermap.php (Also API key can be able to update via .env file)
2. Helper class created to fetch and process weather data and to get temperature etc from OWM. (can be found in app/Helpers/OpenWeatherMap.php)
3. Using the helper class, created a console command to fetch and store current temperature of pre-defined cities against user.
4. Reason to create a console command was, not only for test the functionality easily but also in future (if data fetching consumes much time) console command can be easily scheduled to run in background when sign-in the user (`php artisan log:temperature {user_id} {city_id?*}`)
5. Fortify authentication pipeline was extended to run above console command programmatically, when everytime a user sign-in, and just after a successful sign-in to get and store current temperature logs.
6. When user logged-in he/she redirected to dashboard, thus dashboard view was modified with tables, in order to display logged-in user's historical temperature logs within dashboard

## Instructions

1. Clone, fetch or download the code from repository
2. cd into directory
3. run `composer install`
4. run `npm install && npm run dev`
5. `cp .env.example .env`
6. `php artisan key:generate`
7. Update .env with appropriate database configurations (SQLite or MySQL)
8. Update `OPENWEATHERMAP_API_KEY` parameter at the bottom of .env
9. `php artisan migrate`
10. `php artisan serve`

That's it. Have fun!
