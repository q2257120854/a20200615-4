@extends('layouts.app')
@section('ttype')
注册
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
        border-color: #49ca53;
        box-shadow: 0 0 10px #1cde3d;
    }
    .button{
        -webkit-appearance: none;
        background: #1cde3d;
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
        background: #49ca53;
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
    .code{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        border: 0;
        height: 30px;
        width: 265px;
    }
    .div{
        width: 265px;
        height: 32px;
    }
</style>
@endsection
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <img width="230px" src="logo地址">
    <input type="number" maxlength="11" name="yqm" id="yqm" value="{{ !empty($_GET['yqm']) ? $_GET['yqm'] : '' }}" placeholder="邀请码:没有则填2018" autocomplete="on" required/>
    <input type="text" maxlength="30" name="name" id="name" placeholder="怎么称呼?" autocomplete="on" required/>
    <input type="password" maxlength="50" name="password" placeholder="设置密码" autocomplete="off" required/>
    <input type="password" name="password_confirmation" id="password-confirm" maxlength="50" placeholder="确认密码" autocomplete="off" required/>
    <input type="email" maxlength="88" name="email" id="email" placeholder="Email" autocomplete="on" required/>
    <br>
    @if ($errors->has('name'))
        <pre>提示:称呼格式有误</pre>
    @endif
    @if ($errors->has('email'))
        <pre>提示:Email格式有误或此邮箱已存在</pre>
    @endif
    @if ($errors->has('password'))
        <pre>提示:密码有误</pre>
    @endif
    @if ($errors->has('yqm'))
        <pre>提示:邀请码错误,没有邀请码请填2018</pre>
    @endif
    <input type="submit" class="button" title="注册" value="注册">
</form>         
@endsection