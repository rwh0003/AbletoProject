<?php

namespace Tests\Feature;

use App\Entry,
	App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntryTest extends TestCase
{
    /**
     * Run before each test.
     */
    public function setUp()
    {
        parent::setUp();

        // User for testing purposes
        $this->testUser = User::where('name', 'Test User')->first();

        // Delete test entries for testing purposes
        $testEntries = Entry::where('user_id', $this->testUser->id)->get();

        foreach ($testEntries as $entry) { $entry->delete(); }
    }

    /**
     * Testing duplicate entry creation
     *
     * @return void
     */
    public function testEntrySave()
    {
        $data = [
            'answers' => [
                1 => 1, // Question 1 has answers 1 through 4
                2 => 5, // Question 1 has answers 5 through 8
                3 => 11 // Question 1 has answers 9 through 12
            ],
            'date'=> date('Y-m-d')
        ];

        // Entry creation should succeed
        $this->actingAs($this->testUser)
             ->json('POST', '/questionnaire/save', $data)
             ->assertStatus(200)
             ->assertJson(['msg' => 'Entry successfully saved.']);

        // Entry creation with same data should fail gracefully.
        // It will return a 200 with a different message
        $this->actingAs($this->testUser)
             ->json('POST', '/questionnaire/save', $data)
             ->assertStatus(200)
             ->assertJson(['msg' => 'Entry already exists.']);
    }
}
