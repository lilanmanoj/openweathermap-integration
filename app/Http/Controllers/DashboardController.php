<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function index(Request $request)
    {
        $data = $request->user()->temperatures();

        if ($request->filled('hottest') && $request->hottest) {
            $data = $data->orderBy('temperature', 'DESC');
        } else {
            $data = $data->orderBy('created_at', 'DESC');
        }

        $data = $data->get()->groupBy('city_name');

        return Inertia::render('Dashboard', ['data' => $data]);
    }
}
