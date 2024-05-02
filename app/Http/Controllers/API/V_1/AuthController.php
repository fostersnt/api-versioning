<?php

namespace App\Http\Controllers\API\V_1;

use App\Helpers\General;
use App\Http\Controllers\Controller;
use App\Models\ApiUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            $company_check = ApiUser::query()->where('company_name', $request->company_name)->count();
            $email_check = ApiUser::query()->where('email', $request->email)->count();

            if ($company_check > 0) {
                return General::api_failure_response(null, "Company '$request->company_name'ss already exists");
            }
            if ($email_check > 0) {
                return General::api_failure_response(null, "A user with '$request->email' already exists");
            }

            $api_user = ApiUser::query()->create([
                'company_name' => $request->company_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $response = General::api_success_response($api_user, 'Registration successful');

            return $response;
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return General::api_failure_response(null, $validator->errors()->first());
        } else {
            $token = Auth::guard('api_user')->attempt($request->all());
            if ($token) {
                $data = [
                    'token' => 'This is your token',
                    'expired_at' => 20,
                ];
                return General::api_success_response($data, 'Login successful');
            } else {
                return General::api_failure_response(null, 'Failed to authenticate');
            }
        }

    }
}
