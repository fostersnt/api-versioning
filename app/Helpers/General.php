<?php
class General {

    //This function returns success response for all requests
    public static function api_success_response($data) {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    //This function returns failure response for all requests
    public static function api_failure_response($data) {
        return response()->json([
            'success' => false,
            'data' => $data
        ]);
    }
}
