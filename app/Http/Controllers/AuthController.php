<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Console\Migrations\RefreshCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Psy\Readline\Hoa\Console;

class AuthController extends Controller
{
    public function getSignup(){
        return Inertia::render('Auth');
    }

    public function postSignUp(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','min:8'],
            'confirmPassword' => ['required','min:8'],
        ]);
        
        // dd('validated');
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        Auth::login($user);
        return redirect('/');
    }

    //Login
    public function getLogin(){
        return Inertia::render('Auth');
    }

    public function postLogin(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
 
        return redirect("/login")->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/');
    }

    public function updateProfile(Request $request){
        // dd($request);

        $request->validate([
            'name' => ['required'],
            'bio' => ['max:50'],
            'profile_picture' => ['nullable','mimes:png,jpg,jpeg','max:2048'],
        ]);

        // dd($request->profile_picture_name);

        $user = User::find(Auth::id()); // Use find() instead of where() to get the user instance

        $user->name = $request->name;
        $user->bio = $request->bio;

        if ($request->hasFile('profile_picture')) {
            // Handle profile picture upload
            $profilePicture = $request->file('profile_picture');
            $profilePicturePath = $profilePicture->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        $user->save(); 
        return redirect()->back();
        
        }
}
