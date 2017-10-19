<?php

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('questionnaire')->middleware('auth')->group(function() {

	Route::get('', 'QuestionnaireController@index')->name('questionnaire.index');
	Route::post('/save', 'EntryController@saveEntries')->name('questionnaire.store');

});
