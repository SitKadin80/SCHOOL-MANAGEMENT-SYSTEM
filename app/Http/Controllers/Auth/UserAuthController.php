<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller

{
    public function index()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:12',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&#]/',
            ],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('student');
            } else {
                return back()->with('fail', 'Invalid password')->withInput();
            }
        } else {
            return redirect()->route('register')->with('fail', 'User not found');
        }
    }

    // register of user
    public function registration()
    {
        return view('auth.register');
    }

    public function customRegistration(UserAuthRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            $request->session()->put('loginId', $user->id);

            return redirect()->route('login')->with('success', 'Registration successful. You are now logged in.');
        } else {
            return back()->with('error', 'Failed to register user. Please try again.');
        }
    }
}
