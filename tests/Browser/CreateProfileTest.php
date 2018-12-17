<?php

namespace Tests\Browser;

use App\Profile;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Builder;

class CreateProfileTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser)  {
            $browser->visit('/googleRegister')
                ->assertSee('Enter Your Google Email and Password')
                ->type('email', "laraveltestuser@gmail.com")
                ->type('password', "laravel123!")
                ->type('password_confirmation', 'laravel123!')
                ->press('Register')
                ->type('identifier','laraveltestuser@gmail.com')
                ->keys('#identifierId', '{enter}')
                ->waitForText('Forgot password?')
                ->type('password','laravel123!')
                ->click('#passwordNext')
                ->waitForText('All Questions')
                ->assertPathIs('/home');
        });
        $user = User::where('email', 'laraveltestuser@gmail.com')->first();
        $profile = DB::table('profiles')->where('user_id',$user->id)->first();
        $this->assertEquals($user->id,$profile->user_id);
    }
}
