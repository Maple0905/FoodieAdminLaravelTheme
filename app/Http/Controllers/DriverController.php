<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::user();
        return view("drivers.index")
            ->with('role', $user->role)
            ->with('id', $user->id);
    }

    public function edit($id) {
        $user = Auth::user();
        $area_admins = User::where('role', trans('lang.role_area'))->get();
        return view('drivers.edit')
            ->with('area_admins', $area_admins)
            ->with('role', $user->role)
            ->with('id', $id);
    }

    public function create() {
        $user = Auth::user();
        $area_admins = User::where('role', trans('lang.role_area'))->get();
        return view('drivers.create')
            ->with('area_admins', $area_admins)
            ->with('role', $user->role)
            ->with('id', $user->id);
    }
}
