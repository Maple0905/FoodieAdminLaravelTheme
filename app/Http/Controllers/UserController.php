<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use function Ramsey\Uuid\Lazy\equals;
use function Symfony\Component\String\equalsTo;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view("settings.users.index");
    }

    public function edit($id) {
        return view('settings.users.edit')->with('id',$id);
    }

    public function profile() {
        $user = Auth::user();
        return view('settings.users.profile')->with(['user' => $user]);
    }

    public function update(Request $request,$id) {
        $name = $request->input('name');
        $password = $request->input('password');
        $old_password = $request->input('old_password');
        $email = $request->input('email');

        if ($password == '') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email'=>'required|email'
            ]);
        } else {
            $user = Auth::user();
            if (password_verify($old_password,$user->password)) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|same:password',
                    'email'=>'required|email'
                ]);
            } else {
                return Redirect()->back()->with(['message' => "Please enter correct old password"]);
            }
        }

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect()->back()->with(['message' => $error]);
        }

        $user = User::find($id);
        if ($user) {
            $user->name = $name;
            $user->email = $email;
            if ($password != '') {
                $user->password = Hash::make($password);
            }
            $user->save();
        }

        return redirect()->back();
    }

    public function create() {
        return view('settings.users.create');
    }

    public function area_admin_index() {
        $area_admins = User::where('role', trans('lang.role_area'))->get();
        return view("settings.users.area_admin_index")->with('area_admins', $area_admins);
    }

    public function area_admin_create() {
        return view('settings.users.area_admin_create');
    }

    public function area_admin_store(Request $request) {

        $area_name = $request->input('area_name');
        $area_admin_name = $request->input('area_admin_name');
        $area_admin_user_name = $request->input('area_admin_user_name');
        $area_admin_email = $request->input('area_admin_email');
        $area_admin_phone = $request->input('area_admin_phone');
        $area_admin_password = $request->input('area_admin_password');

        $validator = Validator::make($request->all(), [
            'area_name' => 'required|max:255',
            'area_admin_name' => 'required|max:255',
            'area_admin_user_name' => 'required|max:255',
            'area_admin_email' => 'required|email',
            'area_admin_phone' => 'required|max:255',
            'area_admin_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect()->back()->with(['message' => $error]);
        }

        $area_admins = User::where('role', trans('lang.role_area'))->get();
        foreach ($area_admins as $area_admin) {
            if ($area_admin->email == $area_admin_email) {
                $error = "Email is already used by other user.";
                return Redirect()->back()->with(['message' => $error]);
            }
        }

        User::create([
            'name' => $area_admin_user_name,
            'area_name' => $area_name,
            'area_admin_name' => $area_admin_name,
            'email' => $area_admin_email,
            'area_admin_phone' => $area_admin_phone,
            'password' => Hash::make($area_admin_password),
            'role' => trans('lang.role_area')
        ]);

        $area_admins = User::where('role', trans('lang.role_area'))->get();
        return view("settings.users.area_admin_index")->with('area_admins', $area_admins);
    }

    public function area_admin_edit($id) {
        $area_admin = User::findOrFail($id);
        return view("settings.users.area_admin_edit")->with('area_admin', $area_admin);
    }

    public function area_admin_update(Request $request, $id) {

        $area_name = $request->input('area_name');
        $area_admin_name = $request->input('area_admin_name');
        $area_admin_user_name = $request->input('area_admin_user_name');
        $area_admin_email = $request->input('area_admin_email');
        $area_admin_phone = $request->input('area_admin_phone');
        $area_admin_password = $request->input('area_admin_password');

        $validator = Validator::make($request->all(), [
            'area_name' => 'required|max:255',
            'area_admin_name' => 'required|max:255',
            'area_admin_user_name' => 'required|max:255',
            'area_admin_email' => 'required|email',
            'area_admin_phone' => 'required|max:255',
            'area_admin_password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect()->back()->with(['message' => $error]);
        }

        $area_admins = User::where('role', trans('lang.role_area'))->get();
        foreach ($area_admins as $area_admin) {
            if ($area_admin->email == $area_admin_email) {
                $error = "Email is already used by other user.";
                return Redirect()->back()->with(['message' => $error]);
            }
        }

        User::whereId($id)->update([
            'name' => $area_admin_user_name,
            'area_name' => $area_name,
            'area_admin_name' => $area_admin_name,
            'email' => $area_admin_email,
            'area_admin_phone' => $area_admin_phone,
            'password' => Hash::make($area_admin_password),
        ]);

        return redirect()->back();
    }

    public function area_admin_delete($id) {
        $area_admin = User::findOrFail($id);
        $area_admin->delete();
        return redirect()->back();
    }
}
