<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Session;

class UserController extends Controller
{
    /**
     * Create a new user
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:5|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8'
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json('User register successfully');
        } catch (\Illuminate\Database\QueryException $ex) {
            throw ValidationException::withMessages([$ex->getMessage()]);
        }
    }

    /**
     * Login
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'deleted_at' => null,
        ];

        if (Auth::attempt($credentials)) {
            return response()->json([
                'success' => true,
                'message' => 'User login successfully'
            ]);
        } else {
            throw ValidationException::withMessages(['Unauthorised'])->status(401);
        }
    }

    /**
     * Login using token
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function loginToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
            'device_name' => 'required|string|min:2|max:255',
        ]);

        $user = User::where([
            'email' => $request->email,
            'deleted_at' => null
        ])->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['Unauthorised'])->status(401);
        }

        $user->tokens()
            ->where('name', $request->device_name)
            ->delete();

        return response()->json(
            $user->createToken($request->device_name)->plainTextToken
        );
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            Session::flush();
            return response()->json('Successfully logged out');
        } catch (\Illuminate\Database\QueryException $ex) {
            throw ValidationException::withMessages([$ex->getMessage()]);
        }
    }
}
