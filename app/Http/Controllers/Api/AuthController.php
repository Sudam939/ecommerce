<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // return $request->all();

        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();

        return response()->json([
            "success" => true,
            "message" => "Customer registered successfully",
        ]);
    }

    public function login(Request $request)
    {

        $validator =  Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "errors" => $validator->errors()
            ]);
        }

        $customer = Customer::where('email', $request->email)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json([
                "success" => false,
                "message" => "user email or password is wrong",
            ]);
        }
        $token = $customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            'token' => $token,
            "message" => "Customer logged successfully",
        ]);
    }


    public function logout()
    {
        $customer = Auth::user();
        $customer->tokens()->delete();
        return response()->json([
            "success" => true,
            "message" => "Customer loggedout successfully",
        ]);
    }
}
