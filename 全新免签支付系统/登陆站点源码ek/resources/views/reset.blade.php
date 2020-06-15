@extends('layouts.app')
@section('ttype')
重置密码
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
            .code{
                padding: 0;
                margin-bottom: 28px;
                box-sizing: border-box;
                border: 0;
                height: 30px;
                width: 230px;
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
                border-color: #3ba5ff;
                box-shadow: 0 0 10px #3ba5ff;
            }
            .button{
                -webkit-appearance: none;
                background: #3ba5ff;
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
                background: #468fcd;
            }
            pre{
                width: 230px;
                margin: 0px auto;
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
        </style>
@endsection
@section('content')
    @if($s=='1')
    <form method="POST" action="/reset/2">
        <img width="230px" src="logo地址">
        @csrf
        <input type="email" name="email" id="email" maxlength="30" placeholder="Email" autocomplete="on" required/>
        {!! $msg ? '<pre>'.$msg.'</pre>' : '' !!}
        <input type="submit" class="button" name="one" title="下一步" value="下一步">
    @elseif($s=='2')
    <form method="POST" action="/reset/3">
        <img width="230px" src="logo地址">
        @csrf
        <div class="code">
            <input type="text" maxlength="5" name="code" id="code" style="text-transform:uppercase;width: 110px;" placeholder="Code" autocomplete="on" equired/><input type="submit" style="width: 80px;" name="two" class="button" title="确认" value="确认">
            {!! $msg ? '<pre>'.$msg.'</pre>' : '' !!}
        </div>
    @elseif($s=='3' and isset($h) and $h=='ok')
    <form method="POST" action="/reset/4">
        <img width="230px" src="logo地址">
        @csrf
        <input type="hidden" name="md5" value="{{ session('md5s') }}">
        <input type="password" name="npassword" maxlength="50" placeholder="新的密码" autocomplete="off" required/>
        <input type="password" name="cpassword" maxlength="50" placeholder="确认一次" autocomplete="off" required/>
        {!! $msg ? '<pre>'.$msg.'</pre>' : '' !!}
        <input type="submit" class="button" name="three" title="确认" value="确认">
    @elseif($s=='4')
        <pre>{!! $msg ? '<pre>'.$msg.'</pre>' : '<pre>未知错误:OUT</pre>' !!}</pre>
    @endif
    </form>
@endsection