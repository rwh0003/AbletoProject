<?php

namespace App;

use App\Answer;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['text'];

    /**
     * Question has many Answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
    	// hasMany(RelatedModel, foreignKeyOnRelatedModel = question_id, localKey = id)
    	return $this->hasMany(Answer::class);
    }
}
