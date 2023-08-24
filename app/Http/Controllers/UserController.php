<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user)
    {
        // TO-DO list
        $userData = $request->only(['name','email','password']);
        $userData['password'] = bcrypt($userData['password']);

        if(!$user = $user->create($userData))
            abort(500,'Error to create a user...');

            return response()->json(
                [
                    'data'=>[
                        'user'=>$user
                    ]
                ]
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request){
        $credentials =$request->only(['email','password']);

        if(!auth()->attempt($credentials))
            abort(401,'Invalid Credentials');

            $token = auth()->user()->createToken('auth_token');

        return response()->json([
            'data'=>[
                'token'=>$token->plainTextToken
            ]
        ],200);
    }
}
