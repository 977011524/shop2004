<?php

namespace App\Http\Controllers;

use App\UserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Goods extends Controller
{
    public function create(){
        return view('goods/create');
    }
    public function stop(){

    }
}
?>
