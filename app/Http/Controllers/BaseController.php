<?php

namespace App\Http\Controllers;

use App\Models\Response;

class BaseController extends Controller
{
    public function ok($data, $message = null, $errors = null, ?string $charset = null, $statusCode = 200)
    {

        return response()->json(new Response($data, $message, $errors), $statusCode, []);
    }

    public function badRequest($message)
    {
        return response()->json(new Response(null, $message), 400);
    }

    public function forbidden($message = 'You are forbidden from performing this action.')
    {
        return response()->json(new Response(null, $message), 403);
    }

    public function deleted($message = "Deleted successfully.")
    {
        return $this->ok(null, $message);
    }

    public function created($id, $message = "Created successfully")
    {
        return $this->ok($id, $message, null, null, 201);
    }


    public function not_found($message = "The requested resource is not found")
    {
        return response()->json(new Response(null, $message), 404);
    }

    public function internal_error($message = "Sorry, Something wrong happened at out side, please try again in a few moments")
    {
        return response()->json(new Response(null, $message), 500);
    }

  
}
