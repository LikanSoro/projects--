<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $data = array();
        $data = User::where('id', '=', Session::get('loginId'))->first();
        return view('dashboard', compact('data'));
    }

    public function validateLogin(Request $request)
    {
        $user = User::where(['email' => $request->email, 'status' => 1])->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('fail', 'password does not match');
            }
        } else {
            return back()->with('fail', 'this email is not registered');
        }
    }
    // 
    public function editUser()
    {
        $data = array();
        $data = User::where('id', '=', Session::get('loginId'))->first();
        return view('editUser', compact('data'));
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
            return redirect('/');
        }
    }

    public function update(Request $request)
    {
        $user = User::where('username', '=', $request->username)->first();
        if ($request->input('email') != $user->email) {
            // verify email
            Mail::to($user->email)->send(new SendEmail($user));
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            if ($request->input('password')) {
                $user->password = $request->input('password');
            }
            $user->update();
            // logout user
            if (Session::has('loginId')) {
                Session::pull('loginId');
            }
            return redirect('/')->with('status', 'A verification link has been sent to your updated email ID. Please verify to login.');
        } else {
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->email = $request->input('email');
            if ($request->input('password')) {
                $user->password = $request->input('password');
            }
            $user->update();
            return response()->json();
        }
    }
}
