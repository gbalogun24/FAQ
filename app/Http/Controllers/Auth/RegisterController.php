<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function googleRegister()
    {
        return view('googleRegister');
    }

    public function redirect()
    {
        return Socialite::driver('google')
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();

    }


    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        //dd($googleUser);
        $name = explode(" ", $googleUser->name);
        //dd($name);
        $existUser = User::where('email', $googleUser->email)->first();
        if ($existUser) {
            Auth::loginUsingId($existUser->id);
            return redirect()->route('home');
        } else {
            $user = new User;
            $user->email = $googleUser->email;
            $user->google_id = $googleUser->id;
            $user->avatar = $googleUser->avatar;
            $user->password = md5(rand(1, 10000));
            $user->remember_token = str_random(10);
            $user->save();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->fname = $name[0];
            $profile->lname = $name[1];
            $profile->body = "";
            $profile->save();
            Auth::loginUsingId($user->id);
        }
        return redirect()->route('home');
        }
    }

