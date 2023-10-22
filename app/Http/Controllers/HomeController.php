<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Google\Auth\Cache\get;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome() {
        return view('welcome');
    }

    public function dashboard() {
        return view('dashboard');
    }

    public function statistics() {
        $user = Auth::user();
        if ($user->role == trans('lang.role_super')) {
            $area_admins = User::where('role', trans('lang.role_area'))->get();
        } else if ($user->role == trans('lang.role_area')) {
            $area_admins = User::where('id', $user->id)->get();
        }
        return view('home.statistics')
            ->with('area_admins', $area_admins)
            ->with('role', $user->role);
    }

    public function users() {
        return view('users');
    }

}
