<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
   /*  public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user             = Auth::user();
            $success['name']  = $user->name;
            $success['token'] = $user->createToken('MyApp')->accessToken;

            return sendResponse($success, 'You are successfully logged in.');
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    } */

     /**
     * User registration API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /* public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:60',
            'surname' => 'required|string|max:60',
            'phone' => 'required|string|min:8|max:12',
            'country'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'surname'  => $request->surname,
                'country'     => $request->country,
                'phone'    => $request->phone,
                'password' => bcrypt($request->password)
            ]);

            $success['name']  = $user->name;
            $message          = 'Yay! A user has been successfully created.';
            $success['token'] = $user->createToken('MyApp')->accessToken;
        } catch (Exception $e) {
            $success['token'] = [];
            $message          = 'Oops! Unable to create a new user.';
        }

        return sendResponse($success, $message);
    } */ 
    
    /*  public function logout (Request $request)
     {
       \Auth::logout();

        return response()->json([
            'is_success' => true,
            'message'    => 'Успешно вышли!',
        ]); 
        $access_token = auth()->user()->token();

        // logout from only current device
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
        // $refreshTokenRepository = app(RefreshTokenRepository::class);
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($$access_token->id);

        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 200);

        }   */


        public function login(Request $request) {
            /* $response = [];
            $user = User::where('email', $request->email)->first();
        
            if (! $user || ! Hash::check($request->password, $user->password)) {
                $response['message'] = 'Invalid credentials';
                return response(json_encode($response), 422);
            }
            $user->tokens()->delete();
            $response['token'] = $user->createToken('reader')->plainTextToken;
            return response(json_encode($response), 200); */

            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'message' => 'Invalid login details'
                ], 401);
            }
            $user = User::where('email', $request['email'])->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'user' => Auth::user()->id,
            ]);
        }
    

        
        public function logout(Request $request) {
            $user = User::where('email', $request->email)->first();
        
            if (! $user || ! Hash::check($request->password, $user->password)) {
                $response['message'] = 'Invalid credentials';
                return response(json_encode($response, JSON_UNESCAPED_UNICODE), 422);
            }
            $user->tokens()->delete();
            return response(json_encode(['message' => 'Success'], JSON_UNESCAPED_UNICODE), 200);
        }
    
        public function get_token(Request $request) {
            $response = [];
            $user = User::where('email', $request->email)->first();
        
            if (! $user || ! Hash::check($request->password, $user->password)) {
                $response['message'] = 'Invalid credentials';
                return response(json_encode($response, JSON_UNESCAPED_UNICODE), 422);
            }
            
            $response['token'] = $user->tokens()->where('id', 7)->get();
            $response['is_verified'] = $user->hasVerifiedEmail();
            return response(json_encode($response, JSON_UNESCAPED_UNICODE), 200);
        }
    
        
        public function register(Request $request) {
            $request->validate([
                'name' => 'required|string|max:60',
                'surname' => 'required|string|max:60',
                'phone' => 'required|string|min:8|max:12',
                'country'     => 'required',
                'email'    => 'required|email|unique:users',
                'password' => 'required|min:8'
            ]);
            if (User::where([['email', '=', $request->email]])->first() != null) {
                $response = ['message' => 'User already exist'];
            } else {
                $user = User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'surname'  => $request->surname,
                    'country'     => $request->country,
                    'phone'    => $request->phone,
                    'password' =>  Hash::make($request -> password)
                ]);

                $message          = 'Yay! A user has been successfully created.';
                $success['token'] =  $user->createToken('reader')->plainTextToken;
    
                $response['token'] = $user->createToken('reader')->plainTextToken;
            }
            return sendResponse($response, $message);   

        }
    
}   