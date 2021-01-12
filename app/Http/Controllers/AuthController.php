<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Mail;
use App\Mail\VerifyMail;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register','verifyUser']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        
        $user->save();
         
        $verifyUser = VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
          ]);
          
          Mail::to($user->email)->send(new VerifyMail($user));
        
        return response()->json(['user' => $user]);
    }

public function verifyUser($token)
{
  $verifyUser = VerifyUser::where('token', $token)->first();
  if(isset($verifyUser) ){
    $user = $verifyUser->user;
    if(!$user->verified) {
      $verifyUser->user->verified = 1;
      $verifyUser->user->save();
      $status = 1;
    } else {
      $status = 2;
    }
  } else {
    return redirect('/verify=0');
}
return redirect('/?verify='.$status);
}


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
       
      

        if (! $token = auth('api')->attempt($credentials)) {
            //return response()->json(['error' => 'Wrong Email/Password combination'], 422);
            return response()->json([
                'status' => 'error',
                'msg'    => 'Wrong Email/Password combination'
            ], 422);
        }
       
        $user = auth('api')->user();
        if (!$user->verified) {
            auth('api')->logout();
            return response()->json([
                'status' => 'error',
                'msg'    => 'You need to confirm your account. We have sent you an activation code, please check your email.'
            ], 422);
          }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'user' => $this->guard()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    public function guard(){
        return \Auth::Guard('api');
    }
}
