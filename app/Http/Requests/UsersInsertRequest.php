<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersInsertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //给校验请求类授权(必须)
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    //设置规则
    public function rules()
    {
        return [
            //用户名规则 不能为空 多个规则用|隔开   /\w{4,8}/ 正则规则
            //unique 唯一规则  users 表名
            'username'=>'required|regex:/\w{4,8}/|unique:users',
            //密码规则
            'password'=>'required|regex:/\w{6,18}/',
            //重复密码规则
            'repassword'=>'required|regex:/\w{6,18}/|same:password',
            //邮箱
            'email'=>'required|email|unique:users',
            //电话
            'phone'=>'required|regex:/\d{11}/|unique:users',
        ];
    }

    //自定义错误消息
    public function messages(){
        return [
            //自定义用户名的规则错误消息
            'username.required'=>'用户名不能为空',
            'username.regex'=>'用户名必须是4-8的任意的数字字母或者下划线',
            'username.unique'=>'用户名不能重复',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码必须是6-18的任意的数字字母或者下划线',
            'repassword.required'=>'重复密码不能为空',
            'repassword.regex'=>'重复密码必须是6-18的任意的数字字母或者下划线',
            'repassword.same'=>'两次密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱不符合规则',
            'email.unique'=>'邮箱不能重复',
            'phone.required'=>'电话不能为空',
            'phone.regex'=>'电话不符合规则',
            'phone.unique'=>'电话不能重复',

            ];
    }
}
