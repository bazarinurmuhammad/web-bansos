<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;

class DeleteFavouritePlaceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Place $place)
    {
        if ($request->user()->places()->wherePivot('place_id', $place->id)->exists()) {
            $request->user()->places()->detach($place);

            return response()->json([
                'message' => 'Success deleted favourite place.'
            ]);
        }

        return response()->json([
            'message' => 'This place is not in your favourite lists.'
        ]);
    }
}
