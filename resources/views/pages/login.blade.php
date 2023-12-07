@extends('layouts.master')

@push('styles')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endpush

@section('title', 'Login')

@section('content')

<div class="wrapper">
    <div class="logo"> <img src="{{ asset('/img/Poké_Ball_icon.svg') }}" alt=""> </div>
    <div class="text-center mt-4 name"> Pokedex </div>

    @if($errors->first('message'))
        <div class="alert alert-danger">
            {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="/login" class="p-3 mt-3">
        @csrf
        <div class="form-field d-flex align-items-center @error('email') has-error @enderror">
             <span class="fa fa-user"></span> 
             <input type="email" name="email" value="{{ old('email') }}" placeholder="Username"> 
             @error('email')
                 <p class="has-error">{{ $message }}</p>
             @enderror
        </div>
        <div class="form-field d-flex align-items-center @error('password') has-error @enderror"> 
            <span class="fa fa-key"></span> 
            <input type="password" name="password" placeholder="Password">
            @error('password')
                 <p class="has-error">{{ $message }}</p>
             @enderror 
        </div> 
        <button class="btn mt-3">Login</button>
    </form>
    <div class="text-center fs-6"> <a href="#">Forgot password?</a> or <a href="/signup">Sign up</a> </div>
</div>

@endsection


@section('script')

<script>
    setTimeout(() => {
        $('.alert, p.has-error').remove()
    }, 3000);
</script>

@endsection