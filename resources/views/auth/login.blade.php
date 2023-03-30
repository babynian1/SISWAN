@extends('layout.auth')

@section('title', 'LOGIN')

@section('css')
<style>
    .input-group input {
        border: none;
        width: 100%;
    }

    .box-login {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 10px 20px #00000029;
        border-radius: 20px;
        width: 450px;
        z-index: 100;
        position: relative;
    }

    .btn-login {
        background: #1F4372 0% 0% no-repeat padding-box !important;
        box-shadow: 0px 6px 12px #00000029;
        border-radius: 10px;
        padding: 10px 70px;
        color: #FFFFFF;
    }
</style>
@endsection


@section('content')
<div class="box-login p-10">
    <form method="POST" action="{{route('do_login')}}">
        @csrf
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-4">
            <label class="block mb-2 text-cyan-600">Username</label>
            <div class="input-group flex items-center border rounded-2xl px-5 py-1">
                <img src="{{asset('/assets/svg/user.svg')}}" alt="">
                <input type="text" placeholder="Masukkan username anda" class="p-2" name="username"  required autofocus/>
                @if ($errors->has('username'))
                    <span class="text-red">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>
        <div>
            <label class="block mb-2 text-cyan-600	">Password</label>
            <div class="input-group flex items-center border rounded-2xl px-5 py-1">
                <img src="{{asset('/assets/svg/lock.svg')}}" alt="">
                <input type="password" placeholder="Masukkan password anda" class="p-2" name="password" required />
                @if ($errors->has('password'))
                    <span class="text-red">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <div class="flex justify-center items-center pt-4">
            <button type="submit" class="btn-login flex items-center">LOGIN</button>
        </div>
    </form>
</div>

@endsection



