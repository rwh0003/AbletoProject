<?php

use App\Answer,
	App\Question;

use Illuminate\Database\Seeder;

class CreateQuestionsAnswers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// If questions and answers already exist, exit
    	if (Question::count() && Answer::count()) {
    		return;
    	}


    	// Create questions
    	$q1 = Question::create([ 'text' => 'How are you feeling?' ]);
    	$q2 = Question::create([ 'text' => 'What are your plans for the day?' ]);
    	$q3 = Question::create([ 'text' => "What's for breakfast?" ]);

    	// Populate answers for question 1
    	Answer::create([ 
    		'text' => "Great!", 
    		'question_id' => $q1->id 
    	]);

    	Answer::create([ 
    		'text' => "Fine", 
    		'question_id' => $q1->id 
    	]);

    	Answer::create([ 
    		'text' => "I've been better", 
    		'question_id' => $q1->id 
    	]);

    	Answer::create([ 
    		'text' => "Not good", 
    		'question_id' => $q1->id 
    	]);


    	// Populate answers for question 2
    	Answer::create([ 
    		'text' => "Going to work", 
    		'question_id' => $q2->id 
    	]);

    	Answer::create([ 
    		'text' => "Going to the park", 
    		'question_id' => $q2->id 
    	]);

    	Answer::create([ 
    		'text' => "Staying home", 
    		'question_id' => $q2->id 
    	]);

    	Answer::create([ 
    		'text' => "Going out of town", 
    		'question_id' => $q2->id 
    	]);


    	// Populate answers for question 3
    	Answer::create([ 
    		'text' => "Bacon and eggs", 
    		'question_id' => $q3->id 
    	]);

    	Answer::create([ 
    		'text' => "Stack of pancakes", 
    		'question_id' => $q3->id 
    	]);

    	Answer::create([ 
    		'text' => "Cereal", 
    		'question_id' => $q3->id 
    	]);

    	Answer::create([ 
    		'text' => "Nothing", 
    		'question_id' => $q3->id 
    	]);
    }
}
