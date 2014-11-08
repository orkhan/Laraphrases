<?php namespace Orkhan\Laraphrases\Helpers;

use Illuminate\Support\Facades\Config;

trait LaraphraseHTML {

    /**
     * Get editable or default phrase
     *
     * @param $record \Illuminate\Database\Eloquent\Model
     * @param $attribute string
     *
     * @return string
     */
    private static function getEditable($record, $attribute = 'value')
    {
        $class    = ['laraphrase'];
        $editable = "false";

        if ( self::canEditPhrase() )
        {
            $class[] = 'laraphrase_editable';

            if ( self::isEditableModeOn() )
            {
                $class[]  = 'laraphrase_editable_mode_on';
                $editable = "true";
            }

            return '<span class="' . implode(' ', $class) . '" contenteditable="' . $editable . '" data-url="' . self::getResourceUrl($record, $attribute) . '">'.$record->{$attribute}.'</span>';
        }
        return $record->{$attribute};
    }

    /**
     * Get resource url for remote update
     *
     * @param $record \Illuminate\Database\Eloquent\Model
     * @param $attribute string
     *
     * @return string
     */
    private static function getResourceUrl($record, $attribute)
    {
        $resource = 'laraphrases/remote-update';
        $record_class = explode('\\', get_class($record));
        $record_class = end($record_class);
        return Config::get('app.url') . '/' . $resource . '?class=' . $record_class . '&id=' . $record->id . '&attribute=' . $attribute;
    }

    /**
     * Laraphrase css
     *
     * @return string
     */
    public static function css()
    {
        $html = '<link href="packages/orkhan/laraphrases/laraphrases.css" rel="stylesheet" />';
        return $html;
    }

    /**
     * Laraphrase js
     *
     * @return string
     */
    public static function js()
    {
        $html = '<script src="packages/orkhan/laraphrases/editor.js"></script>'.
                '<script src="packages/orkhan/laraphrases/jquery.cookie.js"></script>'.
                '<script src="packages/orkhan/laraphrases/laraphrases.js"></script>';
        return $html;
    }

}