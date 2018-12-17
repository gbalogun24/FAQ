<?php

namespace Tests\Unit;

use App\User;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Illuminate\Session\Middleware\StartSession;
use \Illuminate\View\Middleware\ShareErrorsFromSession;

class GoogleLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGoogleLogin()
    {
        try {
            $email = "laraveltestuser@gmail.com";
            $pass = "laravel123!";
            $this->withSession(['email' => $email]);
            $kernel = app('Illuminate\Contracts\Http\Kernel');
            $kernel->pushMiddleware('Illuminate\Session\Middleware\StartSession');
            $googleUser = Socialite::driver('google')->stateless()->user();
            dd($googleUser);
            $user = new User();
            $user->email = $googleUser->email;
            $user->google_id = $googleUser->id;
            $user->password = md5(rand(1, 10000));
            $user->save();
        }
        catch (\Exception $exception){
            return 'error';
    }
    }
}
