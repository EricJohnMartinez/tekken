<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $dept = [];
        $empStat = [];
        foreach ($users as $departments) {
            $dept[] = [
                'label' => $departments->department,
                'value' => $departments->groupBy('department')->count()
            ];
        }
        foreach ($users as $employmentStatus) {
            $empStat[] = [
                'label' => $employmentStatus->employment_status,
                'value' => $employmentStatus->groupBy('employment_status')->count()
            ];
        }
        return view('home', compact('dept','empStat'));
    }
}
