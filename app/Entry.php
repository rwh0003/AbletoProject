<?php

namespace App;

use App\Answer,
    App\Question,
    App\User;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    /**
     * Fields that can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
    	'date',
		'answer_id',
		'question_id',
		'user_id'
    ];

    /**
     * Entry belongs to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	// belongsTo(RelatedModel, foreignKey = user_id, keyOnRelatedModel = id)
    	return $this->belongsTo(User::class);
    }

    /**
     * Entry belongs to Question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        // belongsTo(RelatedModel, foreignKey = question_id, keyOnRelatedModel = id)
        return $this->belongsTo(Question::class);
    }

    /**
     * Entry belongs to Answer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answer()
    {
        // belongsTo(RelatedModel, foreignKey = answer_id, keyOnRelatedModel = id)
        return $this->belongsTo(Answer::class);
    }
}
