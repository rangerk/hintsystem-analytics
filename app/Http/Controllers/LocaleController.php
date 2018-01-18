<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LocaleController extends Controller
{
    public function now(){
      return time();
    }
}
