<?php

namespace App\Http\Controllers\Registrasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }
}
