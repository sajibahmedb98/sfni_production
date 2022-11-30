<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Token;
use Illuminate\Http\Request;
use Datetime;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function login(Request $req){

        $token = $req->session()->get('token');
        $userToken = Token::where('value',md5($token))->first();
        if ($userToken) {
            $req->session()->put('user', $userToken->appUser->username);
            switch ($userToken->appUser->role) {
                case 'Admin':
                    return redirect()->route('admin.editLandingPage');
                    break;

                default:
                    return redirect()->route('auth.login');
                    break;
                // case 'SuperAdmin':
                //     return redirect()->route('');
    
                //     break; 
            }
        }
        $req->session()->put('token', null);
        $req->session()->put('user', null);
        return view('main.login');
    }

    public function loginPost(Request $req){
        $user = AppUser::where('username', $req->username)->where('password', md5($req->password))->first();
        if ($user) {
            $tokenGen = bin2hex(random_bytes(37));
            $token = new Token();
            $token->value = md5($tokenGen);
            $token->user_id = $user->id;
            $token->token = $tokenGen;
            $token->created_at = new Datetime();
            $token->save();

            $req->session()->put('token', $tokenGen);
            $req->session()->put('user', $user->username);
        } else {
            $req->session()->put('user', null);
            throw ValidationException::withMessages(['password' => 'Username or password is incorrect']);
        }
        return redirect()->route('auth.login');
    }

    public function logoutPost(Request $req)
    {
        $token = $req->session()->get('token');
        Token::where('value', md5($token))->delete();
        $req->session()->put('token', null);
        $req->session()->put('user', null);
        return redirect()->route('auth.login');
    }
    
}
