<?php
/**
 * Created by PhpStorm.
 * User: YPC
 * Date: 2018/8/17
 * Time: 14:22
 */
namespace App\Api\V1\Controllers;
use App\Api\BaseController;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class AuthController extends BaseController{

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}