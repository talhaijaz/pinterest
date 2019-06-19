<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class PinterestController extends Controller
{
    public function redirectToPinterestProvider(){
        return Socialite::with('pinterest')->scopes([
            'read_public',
            'write_public',
            'read_relationships',
            'write_relationships'
        ])->redirect();
    }

    public function handlePinterestProviderCallback(){
        $user = Socialite::driver('pinterest')->user();
        $details = [
            "token" => $user->token
        ];

        if(Auth::user()->pinterest){
            Auth::user()->pinterest()->update($details);
        }else{
            Auth::user()->pinterest()->create($details);
        }
        return redirect('/');
    }
}
