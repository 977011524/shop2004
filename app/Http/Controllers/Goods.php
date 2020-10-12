<?php

namespace App\Http\Controllers;

use App\Model\GoodsModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Goods extends Controller
{
    public function create(){
        return view('goods/create');
    }
    public function insert(){

    }
    public function index(){
        $res = GoodsModel::limit(10)->get();

        return view('goods/index',['res'=>$res]);
    }
}
?>
