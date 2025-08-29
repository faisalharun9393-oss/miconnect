<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect path setelah login sukses
     */
    protected $redirectTo = '/home'; // ganti sesuai kebutuhan ente

    /**
     * Buat instance controller baru
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
