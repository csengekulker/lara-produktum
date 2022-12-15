<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class AuthController extends Controller


{
    public function signUp( Request $request) {

        $validator = Validator::make( $request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "confirm_password" => "required|same:password"
        ]);

        if($validator->fails()) {

            // return sendError( "Error validation", $validator->errors());
            echo "Sikertelen regisztráció";
        }

        $input = $request->all();
        $input["password"] = bcrypt( $input[ "password"]);
        $user = User::create( $input );
        $success[ "name" ] = $user->name;

        // return $this->sendResponse( $success, "Sikeres regisztráció");
        echo "Sikeres regisztráció";
    }

    public function signIn(Request $request ) {
        if (Auth::attempt( [
            "email" => $request->email,
            "password" => $request->password
        ])) {
            $authUser = Auth::user();
            $success[ "token "] = $authUser->createToken( "MyAuthApp" )->plainTextToken;
            $success[ "name" ] = $authUser->name;

            // return $this->sendResponse( $success, "Sikeres bejelentkezés");
            echo "sikeres bejelentkezés";
        } else {
            // return $this->sendError( "Unauthorized", [ "error" => "Hibás adatok"]);
            echo "sikertelen bejelentkezés";
        }
    }
}
