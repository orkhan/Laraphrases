<?php namespace Orkhan\Laraphrases\Helpers;

use Illuminate\Database\Eloquent\Model;
use Orkhan\Laraphrases\Models\Phrase;

class Laraphrase {

    use \Orkhan\Laraphrases\Helpers\LaraphraseHTML,
        \Orkhan\Laraphrases\Helpers\LaraphraseSecurity;

    /**
     * Get phrase by key
     *
     * @param $args mixed
     *
     * @return string
     */
    public static function get($args)
    {
        $args = func_get_args();

        if ( is_string($args[0]) )
        {
            return self::getPhrase($args);
        }
        else if ( $args[0] instanceof Model )
        {
            return self::getModelPhrase($args);
        }
    }

    /**
     * Get default phrase
     *
     * @param $args mixed
     *
     * @return string
     */
    private static function getPhrase($args)
    {
        $key = $value = $args[0];
        if ( isset($args[1]) ) $value = $args[1];
        $term = Phrase::findOrCreateByKey($key, $value);

        return self::getEditable($term);
    }

    /**
     * Get model phrase
     *
     * @param $args mixed
     *
     * @return string
     */
    private static function getModelPhrase($args)
    {
        return self::getEditable($args[0], $args[1]);
    }

}