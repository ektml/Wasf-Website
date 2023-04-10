<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function __construct() {
        // $this->middleware('auth:api', ['except' => ['login', 'register']]);
        auth()->setDefaultDriver('api');
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $token = auth()->guard('api')->attempt();

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }




    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone'=> 'required|min:10|unique:users',
        ]);

        if($validator->fails()){
            // return response()->json($validator->errors()->toJson(), 400);
            return $this->returnError(400, $validator->errors());
        }

        $user = User::create(array_merge(
            $validator->validated(),
            [
                'password' => bcrypt($request->password),
                "profile_image"=> "default.png",
            ]
        ));

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
  
        return response()->json([
            'status' =>200,
            'message' =>'User Successfully Registered',
            'token' => $token,
            'user' => $user
        ], 201);
    }



    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User Successfully Signed Out']);
    }



    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }




    public function userProfile()
    {
        auth()->user()->profile_image = asset('Admin3/assets/images/users/'.Auth::user()->profile_image);
        return response()->json(auth()->user());
    }



    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
