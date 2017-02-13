<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function create( Request $request )
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|min:2',
            'email' => 'required|max:100|email',
            'text' => 'required|min:10'
        ]);

        if ( $validator->fails() )
            return Response::json($validator->getMessageBag()->toArray(), 422);

        Feedback::create( $request->all() );

        return Response::json([
            'success' => true
        ], 200);

    }


}