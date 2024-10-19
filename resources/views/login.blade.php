@extends('templates.app', ['title' => 'Login'])

@section('content-dinamis')
<form action="{{Route('login.auth')}}" method="POST" class=" card w-75 d-block mx-auto my-5">
    @csrf
@if (Session::get('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
    @if (Session::get('failed'))
    <div class="alert alert-danger">{{ Session::get('failed')}}</div>
    @endif
    <div class="card-body">
        <h1 class="card-title text-center text-primary-emphasis">Login</h1>
        <div class="form-group">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email">
          @error('email')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="password" class="form-label" >Password</label>
          <input type="password" id="password" name="password" class="form-control mb-3">
          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">LOGIN</button>
    </div>
  </form>
  @endsection
