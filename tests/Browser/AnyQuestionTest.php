<?php

namespace Tests\Browser;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Support\Facades\DB;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AnyQuestionTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $question = new Question();
        $question->user_id = 5;
        $question->body = "What day is it?";
        $this->browse(function (Browser $browser) {
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
                ->assertPathIs('/home')
                ->visit('/questions/51/answers/create')
                ->type('body', 'Thursday')
                ->press('Save');
        });
        $user = User::where('email', 'laraveltestuser@gmail.com')->first();
        $answer = DB::table('answers')->where('user_id',$user->id)->first();
        $this->assertEquals('Thursday',$answer->body);
    }
}
