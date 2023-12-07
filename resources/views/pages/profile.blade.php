@extends('layouts.master')

@push('styles')
    <link href="{{ asset('/css/form.css') }}" rel="stylesheet">
@endpush

@section('title', 'Profile')

@section('content')

<div class="wrapper" style="max-width: 500px; margin: 16px auto;">
    <div class="logo"> <img src="{{ asset('/img/default_user.png') }}" alt=""> </div>
    <div class="text-center mt-4 name"> Profile </div>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }} &nbsp;
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="/profile/update" class="p-3 mt-3">
        @csrf
        <div class="form-field d-flex align-items-center @error('firstname') has-error @enderror"> 
            <input type="text" name="firstname" value="{{ auth()->user()->firstname }}" placeholder="First Name" required> 
            @error('firstname')
                 <p class="has-error">{{ $message }}</p>
            @enderror
       </div>
       <div class="form-field d-flex align-items-center @error('lastname') has-error @enderror">
         <input type="text" name="lastname" value="{{ auth()->user()->lastname }}" placeholder="Last Name" required>
         @error('lastname')
            <p class="has-error">{{ $message }}</p>
         @enderror 
       </div>
        <div class="form-field d-flex align-items-center @error('birthday') has-error @enderror">
            <input type="date" name="birthday" value="{{ auth()->user()->birthday }}" placeholder="Birthday" required> 
            <span style="align-self: baseline;margin-right: 15px;font-weight: bold;color: #a3a5a6;">Birthday</span>
            @error('birthday')
                 <p class="has-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn mt-3">Update</button>
    </form>
</div>

@endsection


@section('script')

<script>
    setTimeout(() => {
        $('.alert, p.has-error').remove()
    }, 3000);
</script>

@endsection