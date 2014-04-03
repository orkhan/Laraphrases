<?php namespace Orkhan\Laraphrases\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;

class Phrase extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'phrases';

    /**
     * The attributes for mass-assignment.
     *
     * @var array
     */
    protected $fillable = ['locale', 'key', 'value'];

    /**
     * Find or create new model
     *
     * @param $key string
     * @param $value string | null
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function findOrCreateByKey($key, $value)
    {
        $locale = Config::get('app.locale');

        $term = static::where('locale', $locale)->where('key', $key)->first();

        if ( is_null($term) )
        {
            return static::create(['locale' => $locale, 'key' => $key, 'value' => $value]);
        }
        return $term;
    }

    /**
     * Versioning phrase
     *
     * @return void
     */
    public function versionIt()
    {
        $this->versions()->save(
            new PhraseVersion(
                ['value' => $this->getOriginal('value')]
            )
        );
    }

    /**
     * Phrase versions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function versions()
    {
        return $this->hasMany('Orkhan\Laraphrases\Models\PhraseVersion', 'phrase_id', 'id')->orderBy('created_at', 'DESC');
    }

}