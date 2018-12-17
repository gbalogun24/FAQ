<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
//use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Auth\RegistersUsers;
use Laravel\Socialite\Facades\Socialite;

class RegisterTest extends DuskTestCase
{
  //  use DatabaseMigrations;
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

    }
}
