<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MercatinoController extends Controller
{
    
   // TODO creare il mercatino

   
    public function index(){

        return view('mercatino.mercatino-welcome');
    }
}
