<?php

namespace App\Http\Controllers;

use App\Entry,
    App\Question;
use Illuminate\Http\Request;
use Auth;

class EntryController extends Controller
{
	/**
     * Save entries upon submission
     *
     * @return View
     **/
    public function saveEntries(Request $request)
    {
        $data = $request->all();

        // Loop over each entry in the answers array, format data, and create/update
    	foreach ($data['answers'] as $questionId => $answerId) {

            // Skip over index 0, since there is no id 0 question
            if (!$questionId) {
                continue;
            }

            // Format entry data
            $entryData = [
                'date' => date('Y-m-d', strtotime($data['date'])),
                'answer_id' => $answerId,
                'question_id' => $questionId,
                'user_id' => Auth::user()->id
            ];

            // Check to see if entry already exists
            $entry = Entry::where([
                    'date' => $entryData['date'],
                    'question_id' => $entryData['question_id'],
                    'user_id' => $entryData['user_id']
                ]
            )->first();
            
            // If entry exists, update answer
            // Else create new entry
            if (count($entry)) {
                $entry->answer_id = $entryData['answer_id'];
                $entry->save();
            } else {
        		Entry::create($entryData);
            }
    	}
    }

    /**
     * Retrieve user entries for a specific date
     *
     * @return Collection
     **/
    public function getEntries(Request $request)
    {
        return Entry::where([
            'user_id' => $request->get('user_id'), 
            'date' => date('Y-m-d', strtotime($request->get('date')))
        ])->get();
    }

    /**
     * Retrieve user entries for a specific question
     *
     * @return Collection
     **/
    public function getEntriesByQuestion(Request $request, $questionId)
    {
        $entries = Entry::where([
            'user_id' => $request->get('user_id'), 
            'question_id' => $questionId
        ])->orderBy('date', 'ASC')->get();

        // Attach question/answer data to collection and format date for display
        foreach ($entries as $entry) {
            $entry->question;
            $entry->answer;
            $entry->formatted_date = date('l, F j, Y', strtotime($entry->date));
        }

        return $entries;
    }
}
