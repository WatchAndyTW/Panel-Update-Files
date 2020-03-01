<?php

namespace Pterodactyl\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Traits\Controllers\JavascriptInjection;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class RegisterController extends Controller
{
    public function index(Request $request): View
    {
        return view('auth.register');
    }

    public function register(Request $request): View
    {
        return view('auth.registeraccount');
    }
}