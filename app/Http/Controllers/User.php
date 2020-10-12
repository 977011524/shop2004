<?php

namespace App\Http\Controllers;

use App\Model\UserModel;
use Illuminate\Http\Request;
use Db;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Redis;


class User extends Controller
{
    //展现添加视图
    function add(){
        return view('user.create');
        
    }
    //注册
    function regist(){
        return view('user.regist');
        
    }
    //注册方法
    function registDo(Request $request){
        //接值
        $data = $request->except('_token');
        // dd($data);
        //判断两次密码是否一致
        if($data['password']!=$data['repwd']){
            return redirect('user/regist')->with('msg','两次密码不一致');
        }
        $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
        $data['last_login']=$_SERVER['REMOTE_ADDR'];
        $data['reg_time']=time();
        unset($data['repwd']);
        $res =UserModel::insert($data); 
        // dd($res);
        if($res){
            return redirect('user/login');
        }else{
            return redirect('regist');
        }

    }
    //登录页面
    function login(){
        //接值
        return view('user.login');
        
        
    }
    //登录方法
    function loginDo(){
        $data=request()->except('_token');
        // dd($data);
        $add = $_SERVER['REMOTE_ADDR'];
        $reg = '/^1[1356789]\d{9}$/';
        $reg_email = '/^\w{3,}@([a-z]{2,7}|[0-9]{3})\.(com|cn)$/';
        if(preg_match($reg,$data['user_name'])){
            $where = [
                ['tel',"=",$data['user_name']]
            ];
        }else if(preg_match($reg_email,$data['user_name'])){
            $where = [
                ['email',"=",$data['user_name']]
            ];  
        }else{
            $where=[
                ['user_name',"=",$data['user_name']]
            ];
        }
        $res =UserModel::where($where)->first();
        // dd($where);
        $count=Redis::get($res->id);
        //$login_time = ceil(Redis::TTL("login_time:".$res->id) / 60);
        $out_time=(ceil((Redis::TTL($res->id)/60)));
            //判断错误次数
            if($count>=5){
                    return redirect('/user/login')->with('msg','密码错误次数过多,请'.$out_time.'分钟后在来');
            }
        if(!$res){
            return redirect('/user/login')->with('msg','用户不存在');
        }
        if(!password_verify($data['password'], $res['password'])){
            //用redis自增记录错误次数
            Redis::incr($res->id);
            $count=Redis::get($res->id);
            //判断错误次数
            if($count>=5){
                Redis::SETEX($res->id,60*60,5);
                    return redirect('/user/login')->with('msg','密码错误次数过多,啥脑子，一个钟头再来');
            }
            return redirect('/user/login')->with('msg','密码错误'.$count.'次，五次后锁定一小时');
        }
        
        
        // dd($res);
        if(!$res){
            return redirect('/user/login')->with('msg','用户不存在');
        }
        if(!password_verify($data['password'],$res['password'])){
            return redirect('/user/login')->with('msg','密码错误');
        }
        $data=[
            'last_login'=>time(),
            'login_ip'=>$add
        ];
        $user = UserModel::where('id',$res['id'])->update($data);
        if($user){
            return redirect('user/index');
        }else{
            return redirect('stoe');
        }

    }
    //添加方法
    function stoe(Request $request){
        $data=request()->except('_token');
        $data['reg_time']=time();
        // dd($post);
        
        $res =UserModel::insert($data);
        // dd($res);
        if($res){
            return redirect('user/index');
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
        return redirect('user/index');
    }
    //展示修改视图
    function edit($id){
        $res =UserModel::find($id);
        // dump($res);w'd'n'm'd
        return view('user/edit',['res'=>$res]);
    }
    //修改方法
    function update(Request $request,$id){
        // dd(111);
        $data=request()->except('_token');
        // dd($post);
        $res =UserModel::where('id',$id)->update($data);
        // dump($res);
        return redirect('user/index');

    }
}
