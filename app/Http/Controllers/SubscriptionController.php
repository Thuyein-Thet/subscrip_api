<?php

namespace App\Http\Controllers;

use App\HttpResponse\ApiResponse;
use App\Models\Subscribtion;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request){
        
        $input = $request->only(['website_id','user_id']);

        $validator = Validator::make($input, [
            "website_id" => 'required',
            "user_id" => 'required',
        ]);

        if ($validator->fails()) {
            $response = ApiResponse::BadRequest($validator->errors()->first());
            return response()->json($response['json'], $response['status']);
        }

        try {
            $subscribe = Subscribtion::create($input);
            $response = ApiResponse::Created($subscribe, 'Successfully Subscribe');
            return response()->json($response['json'], $response['status']);
        } catch (QueryException $e) {
            $response = ApiResponse::Unknown('something was wrong');
            return response()->json($response['json'], $response['status']);
        }

    }
}
