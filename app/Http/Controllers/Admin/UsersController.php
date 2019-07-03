<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入Hash加密类
use Hash;
//导入校验请求类
use App\Http\Requests\UsersInsertRequest;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取列表数据
        //加载模板
        return view("Admin.Users.index",['data'=>$data,'request'=>$request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载添加模板
        return view("Admin.Users.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersInsertRequest $request)
    {
        // dd($request->all());
        $data=$request->except(['repassword','_token']);
        //加密密码
        $data['password']=Hash::make($data['password']);
        $data['status']=1;
        $data['token']=str_random(50);
        // dd($data);
        //执行数据库插入操作
        if(DB::table("users")->insert($data)){
            //设置session  success sesion名字
            return redirect("/adminusers")->with("success","添加成功");
        }else{
            return back()->with("error","添加失败");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo $id;
        //获取需要修改的数据
        $data=DB::table("users")->where("id","=",$id)->first();
        //加载模板
        return view("Admin.Users.edit",['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // echo "修改";
        //获取修改的数据
        // dd($request->all());
        $data=$request->except(['_token','_method']);
        //执行修改
        if(DB::table("users")->where("id","=",$id)->update($data)){
            return redirect("/adminusers")->with("success","修改成功");
        }else{
            return back()->with("error","修改失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        //直接删除
        if(DB::table("users")->where("id","=",$id)->delete()){
            return redirect("/adminusers")->with("success","删除成功");
        }else{
            return redirect("/adminusers")->with("success","删除失败");
        }
    }
}
