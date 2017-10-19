<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
     /**
     * Returns formatted collection of questions with answer data
     *
     * @return Collection
     **/
    public function index()
    {
        $questions = Question::get();

        // Attach answers to each question object
        foreach ($questions as $question) {
            $question->answers;
        }

        return $questions;
    }

     /**
     * Returns single Question object with answer data
     *
     * @return Question
     **/
    public function show($questionId)
    {
        $question = Question::findOrFail($questionId);

        // Attach answers to question object
        $question->answers;

        return $question;
    }
}
