<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\ProfileSiswa;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'siswa']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $a)
    {
        $fields = $a->validate([
            'nama' => 'required|string|unique:profile_siswas',
            'email' => 'required|string|unique:profile_siswas,email',
            'password' => 'required|string|confirmed',
            'divisi_id' => 'required|integer',
        ]);

        $user = ProfileSiswa::create([
            'nama' => $fields['nama'],
            'email' => $fields['email'],
            'divisi_id' => $fields['divisi_id'],
            'password' => bcrypt($fields['password']),
            'path_directory' => Str::random(10).'_'.$fields['nama'],
        ]);
        $user->assignRole('siswa');

        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
            'status' => "success"
        ];

        return response($response, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check email
        $user = ProfileSiswa::where('email', $fields['email'])->first(); 
        // check Password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'bad gateway'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
            'log' => 'true'
        ];

        return response($response, 201);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function destroy()
    {
        Auth()->user()->tokens()->delete();
        return[
            'message' => 'logged out'
        ];
    }
}
