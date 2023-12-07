@extends('layouts.master')

@push('styles')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endpush

@section('title', 'Sign Up')

@section('content')

<div class="wrapper" style="max-width: 500px; margin: 16px auto;">
    <div class="logo"> <img src="{{ asset('/img/Poké_Ball_icon.svg') }}" alt=""> </div>
    <div class="text-center mt-4 name"> Pokedex </div>
    <form method="POST" action="/register" class="p-3 mt-3">
        @csrf
        <div class="form-field d-flex align-items-center @error('firstname') has-error @enderror"> 
            <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required> 
            @error('firstname')
                 <p class="has-error">{{ $message }}</p>
            @enderror
       </div>
       <div class="form-field d-flex align-items-center @error('lastname') has-error @enderror">
         <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required>
         @error('lastname')
            <p class="has-error">{{ $message }}</p>
         @enderror 
       </div>
        <div class="form-field d-flex align-items-center @error('birthday') has-error @enderror">
            <input type="date" name="birthday" value="{{ old('birthday') }}" placeholder="Birthday" required> 
            <span style="align-self: baseline;margin-right: 15px;font-weight: bold;color: #a3a5a6;">Birthday</span>
            @error('birthday')
                 <p class="has-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="form-field d-flex align-items-center @error('email') has-error @enderror">
             <input type="email" name="email" value="{{ old('email') }}"  placeholder="Username" required> 
             @error('email')
                 <p class="has-error">{{ $message }}</p>
             @enderror
        </div>
        <div class="form-field d-flex align-items-center @error('password') has-error @enderror"> 
            <input type="password" name="password" value="{{ old('password') }}"  placeholder="Password" required> 
            @error('password')
                 <p class="has-error">{{ $message }}</p>
            @enderror
        </div> 
        <div class="form-field d-flex align-items-center @error('password_confirmation') has-error @enderror"> 
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"  placeholder="Confirm Password"> 
            @error('password_confirmation')
                 <p class="has-error">{{ $message }}</p>
            @enderror
        </div> 
        <button type="submit" class="btn mt-3">Register</button>
    </form>
    <div class="text-center fs-6"> <a href="/login">Login</a> </div>
</div>

@endsection


@section('script')

<script>
    setTimeout(() => {
        $('.alert, p.has-error').remove()
    }, 3000);
</script>

@endsection