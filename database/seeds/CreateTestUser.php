<?php

use App\User;

use Illuminate\Database\Seeder;

class CreateTestUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Create Test User if it doesn't exist
    	if (!User::where('name', 'Test User')->count()) {
    		User::create([
				'name' => 'Test User',
				'email' => 'test@gmail.com',
				'password' => Hash::make('password')
			]);
    	}
    }
}
