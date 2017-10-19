<?php

Route::get('questions', 'QuestionController@index');
Route::get('question/{questionId}', 'QuestionController@show');

Route::get('entries', 'EntryController@getEntries');
Route::get('entries/{questionId}', 'EntryController@getEntriesByQuestion');