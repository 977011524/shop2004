<?php

namespace App\Http\Controllers;

use App\UserModel;
use Illuminate\Http\Request;
use Db;


class User extends Controller
{
    //展现添加视图
    function add(){
        return view('user.create');
        
    }
    //添加方法
    function stoe(Request $request){
        $data=request()->except('_token');
        // dd($post);
        $res =UserModel::insert($data);
        // dd($res);
        if($res){
            return redirect('index');
        }else{
            return redirect('stoe');
        }
    }
    //列表展示
    function index(){
        $res =UserModel::all();
        // dd($res);
        return view('user.index',['res'=>$res]);
        
    }
    //删除方法
    function delete($id){
        $res =UserModel::destroy($id);
        // dump($res);
        return redirect('index');
    }
    //展示修改视图
    function edit($id){
        $res =UserModel::find($id);
        // dump($res);
        return view('user/edit',['res'=>$res]);
    }
    //修改方法
    function update(Request $request,$id){
        // dd(111);
        $data=request()->except('_token');
        // dd($post);
        $res =UserModel::where('id',$id)->update($data);
        // dump($res);
        return redirect('index');

    }
}
