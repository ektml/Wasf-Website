<?php
namespace App\Http\Controllers\Api;
use Validator;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'phone'=> 'required|unique:users',
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
  
        Wallet::create([
            'user_id'=> $user->id,
            'total'=>0,
            ]);

            
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




    public function userProfile($userid)
    {
        $user=User::find($userid);
        $user->profile_image = asset('Admin3/assets/images/users/'. $user->profile_image);
        return response()->json( $user);
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
