<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class WelcomeController extends Controller
{
    
    public function __construct() {
        
        $this->middleware('auth');
    }

        /**
     * Show user data
     * 
     * @return Illuminate\View\View
     */
    public function index(Authorizer $authorizer) {
        
        $client = User::getUserClient(Auth::user()->id);
        
        
        return view('welcome', [
            'user' => Auth::user(),
            'client' => $client
        ]);
    }
    
    
}
