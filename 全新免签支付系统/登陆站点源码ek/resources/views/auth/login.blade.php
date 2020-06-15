@extends('layouts.app')
@section('ttype')
登陆
@endsection
@section('styles')
<style type="text/css">
    html,
    body {
        background-color: #FFF;
    }
    form{
        width: 230px;
        margin: 18px auto;
    }
    input{
        border: 1px solid #ccc;
        border-radius: 2px;
        color: #000;
        font-family: 'Open Sans', sans-serif;
        font-size: 0.9em;
        height: 38px;
        padding: 0 16px;
        transition: background 0.3s ease-in-out;
        width: 200px;
        margin:8px auto;
    }
    input:focus {
        outline: none;
        border-color: #000;
        box-shadow: 0 0 10px #000;
    }
    .button{
        -webkit-appearance: none;
        background: #000;
        border: none;
        border-radius: 2px;
        color: #fff;
        cursor: pointer;
        height: 38px;
        font-family: 'Open Sans', sans-serif;
        font-size: 0.9em;
        letter-spacing: 0.05em;
        text-align: center;
        text-transform: uppercase;
        transition: background 0.3s ease-in-out;
        width: 235px;
        margin: 8px auto;
    }
    .button:hover {
        background: #1f2223;
    }
    pre{
        width: 230px;
        display: block;
        line-height: 1.6;
        background-color: #f8f8f8;
        border: 1px solid #dedede;
        border-radius: 0;
        white-space: pre-wrap;
        word-wrap: break-word;
        font-size: 15px;
        text-shadow: 0 0 0.2em #000000, 0 0 0.2em #948a89;
        text-align:center;
    }
    .other{
        width: 230px;
        display: block;
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <img width="230px" src="logo地址">
    <input type="email" name="email" id="email" maxlength="30" placeholder="Email" autocomplete="on" required/>
    <input type="password" name="password" maxlength="50" placeholder="密码" autocomplete="off" required/>
    <div class="other"><a style="margin-left: 8px;" href="./register">注册</a><a style="margin-left: 145px;width: 130px;" href="./reset">忘记密码</a></div>
    @if($errors->has('email'))
        <pre>提示:邮箱或密码输入错误</pre>
    @endif
    @if($errors->has('password'))
        <pre>提示:密码错误</pre>
    @endif
    <input type="submit" class="button" title="登陆" value="登陆">
</form>  
@endsection