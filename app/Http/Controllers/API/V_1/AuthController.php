<?php

namespace App\Http\Controllers\API\V_1;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('api')->except(['register']);
    }

    public function register(Request $request)
    {
        $rules = [
            'company_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];

        $messages = [
            'company_name.required' => 'Company name is empty',
            'email.required' => 'Email is empty',
            'email.email' => 'Invalid email',
            'password.required' => 'Password is empty',
            'password.min' => 'Password is less than 8 characters'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return General::api_failure_response(null, $validator->errors()->first());
        } else {
            $api_user = ApiUser::query()->create([
                'company_name' => $request->company_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return General::api_success_response($api_user, 'Registration successful');
        }

    }
}
