<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function noticia(Request $r){
        return view('frontend.noticia');
    }
}
