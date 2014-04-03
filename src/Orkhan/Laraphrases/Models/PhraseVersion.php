<?php namespace Orkhan\Laraphrases\Models;

use Illuminate\Database\Eloquent\Model;

class PhraseVersion extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phrase_versions';

    /**
     * The attributes for mass-assignment.
     *
     * @var array
     */
    protected $fillable = ['value'];

    /**
     * Phrase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phrase()
    {
        return $this->belongsTo('Orkhan\Laraphrases\Models\Phrase', 'phrase_id');
    }

}