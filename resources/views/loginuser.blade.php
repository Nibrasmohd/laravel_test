@extends('layout')
@section('content')
  <div class="container form-conatiner">
    <div class="row  justify-content-center">
        <div class="col-md-6">
           <form action="{{ route('reguser.adminauth') }}" method="post" class="p-3 login_form">
             @csrf
             <h3 class="text-center mb-3 text-muted">USER LOGIN FORM</h3>
             <div class="mb-4">
                <label for="formusername" class="form-label">Email</label>
                <input type="email" class="form-control" id="formusername" value="{{ old('usermail') }}" name="usermail" required>
                @if (session()->has('usermailerror'))
                 <div class="form-text text-danger">{{ session('usermailerror') }}</div>
                @endif
             </div>
             <div class="mb-3">
                <label for="formuserpass" class="form-label">Password</label>
                <input type="password" class="form-control" name="userpass" value="{{ old('userpass') }}" id="formuserpass" required>
                @if (session()->has('userpasserrror'))
                <div class="form-text text-danger">{{ session('userpasserrror') }}</div>
                @endif
             </div>
             <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn  btn-primary">LOGIN</button>
             </div>
            </form>
        </div>
    </div>
  </div>
@endsection