<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser)  {
            $browser->visit('/googleLogin')
                ->assertSee('Enter Your Google Email and Password')
                ->type('email', "laraveltestuser@gmail.com")
                ->type('password', "laravel123!")
                ->press('Login')
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
