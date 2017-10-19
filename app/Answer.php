<?php

namespace App;

use App\Question;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = ['text', 'question_id'];

    /**
     * Answer belongs to Question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
    	// belongsTo(RelatedModel, foreignKey = question_id, keyOnRelatedModel = id)
    	return $this->belongsTo(Question::class);
    }
}
