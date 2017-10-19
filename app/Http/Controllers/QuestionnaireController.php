<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Auth;

class QuestionnaireController extends Controller
{
    /**
     * View questionnaire
     *
     * @return View
     **/
    public function index(Request $request)
    {
    	return view('questionnaire');
    }
}
