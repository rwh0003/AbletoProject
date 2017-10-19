<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageViewTest extends TestCase
{

    /**
     * Run before each test.
     */
    public function setUp()
    {
        parent::setUp();

        // User for testing purposes
        $this->testUser = User::where('name', 'Test User')->first();
    }

    /**
     * Root URL should redirect to /home depending on auth
     *
     * @return void
     */
    public function testRootRedirect()
    {
        $this->get('/')
             ->assertStatus(302)
             ->assertRedirect('/home');
    }

    /**
     * View login page or be redirected if already logged in
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->get('/login')
             ->assertStatus(200);

        $this->actingAs($this->testUser)->get('/login')
             ->assertStatus(302)
             ->assertRedirect('/home');
    }

    /**
     * View registration page
     *
     * @return void
     */
    public function testRegisterPage()
    {
        $this->get('/register')
             ->assertStatus(200);

        $this->actingAs($this->testUser)
             ->get('/register')
             ->assertStatus(302)
             ->assertRedirect('/home');
    }

    /**
     * View questionnaire page, or redirect to /login if logged out
     *
     * @return void
     */
    public function testQuestionnairePage()
    {
        $this->get('/questionnaire')
             ->assertStatus(302)
             ->assertRedirect('/login');

        $this->actingAs($this->testUser)
             ->get('/questionnaire')
             ->assertStatus(200);
    }

    /**
     * View questionnaire page, or redirect to /login if logged out
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->get('/home')
             ->assertStatus(302)
             ->assertRedirect('/login');

        $this->actingAs($this->testUser)
             ->get('/home')
             ->assertStatus(200);
    }
}
