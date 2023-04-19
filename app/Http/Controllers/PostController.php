<?php

namespace App\Http\Controllers;

use App\HttpResponse\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $input = $request->only(['title', 'description', 'website_id']);

        $validator = Validator::make($input, [
            "title" => 'required',
            "description" => 'required',
            "website_id" => 'required'
        ]);

        if ($validator->fails()) {
            $response = ApiResponse::BadRequest($validator->errors()->first());
            return response()->json($response['json'], $response['status']);
        }

        try {
            $post = Post::create($input);
            $response = ApiResponse::Created($post, 'Post is created');
            return response()->json($response['json'], $response['status']);
        } catch (QueryException $e) {
            $response = ApiResponse::Unknown('something was wrong');
            return response()->json($response['json'], $response['status']);
        }
    }
}
