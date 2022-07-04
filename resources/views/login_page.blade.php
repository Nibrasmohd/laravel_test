@extends('layout')
@section('content')
  <div class="container form-conatiner">
    <div class="row  justify-content-center">
        <div class="col-md-6">
           <form action="{{ route('admin.adminauth') }}" method="post" class="p-3 login_form">
             @csrf
             <h3 class="text-center mb-3 text-muted">LOGIN FORM</h3>
             <div class="mb-4">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}" name="email" required>
                @if (session()->has('mailerror'))
                 <div class="form-text text-danger">{{ session('mailerror') }}</div>
                @endif
             </div>
             <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="pass" value="{{ old('pass') }}" id="exampleInputPassword1" required>
                @if (session()->has('passerror'))
                <div class="form-text text-danger">{{ session('passerror') }}</div>
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

