<?php

class LaraphraseController extends BaseController {

    /**
     * Remote phrase update
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postRemoteUpdate()
    {
        $class     = Input::get('class');
        $attribute = Input::get('attribute');

        if ( Laraphrase::isInWhiteList($class, $attribute) )
        {
            $id       = Input::get('id');
            $newValue = Input::get('newValue');

            $record = $class::find($id);

            if ( is_null($record) ) return Response::json(['status' => 'error', 'message' => 'Phrase is not exists!'], 403);

            $record->fillable([$attribute]);

            $record->{$attribute} = $newValue;
            $record->save();

            return Response::json($record->toJson());
        }
        return Response::json(['status' => 'error', 'message' => 'Attribute is not in white list!'], 403);
    }

}