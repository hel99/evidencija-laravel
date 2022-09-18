<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AuthKontroler extends Controller
{

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:zaposleni',
            'password' => 'required|string',
            'phone_number' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 404
            ]);
        } else {

            DB::table('zaposleni')->insert([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'kasnjenja' => 0
            ]);

            return response()->json([
                'status' => 200
            ]);
        }
    }



    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 404
            ]);
        }

        $zaposleni = DB::table('zaposleni')->where('email', $request->email)->first();

        if (Hash::check($request->password, $zaposleni->password))
            return response()->json([
                'status' => 200,
                'id' => $zaposleni->id
            ]);
        else
            return response()->json([
                'status' => 404
            ]);
    }
}
