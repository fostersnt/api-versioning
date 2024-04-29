<?php

namespace App\Helpers;
class General {

    //This function returns success response for all requests
    public static function api_success_response($data, $message) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
    }

    //This function returns failure response for all requests
    public static function api_failure_response($data, $message) {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ]);
    }
}
