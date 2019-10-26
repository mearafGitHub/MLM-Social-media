@extends('layouts.master')

@section('title')
    Welcome!
@endsection

@section('content')
    @include('includes.message-block')
    <div class="row">

    <div class="col-md-6">
        <h2 style="color:#397e01">Log In</h2>
         <div class="col-sm-6">
            
            <form action="{{ route('login') }}" method="post">
                
              <div class="row">
              <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" style="color:#397e01">E-Mail or phone number</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label for="password" style="color:#397e01"> Password</label>
                    <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                </div>
                
                <div class="row-md-offset-3">
                   <div class="col">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <button type="submit" class="btn btn-success">Log In</button>
                    </div>
                   <div class="column">
                   <a class="btn btn-link" href="{{ route('password.request') }}">
                        <h4>Forgot Your Password?</h4>
                    </a>
                  
                   </div>   
                </div>
                
                
              </div>
            </form>
         </div>   
        
        </div>
      
        <div class="col-md-6">
            <h1 style="color:#397e01">Sign Up</h1>
            <h3 style="color:#397e01">Create an account. </h3><span> <h5> If you do not have an account yet, you can create here.</h5></span>
            <form action="{{ route('signup') }}" method="post">
                
                <div class="form-group {{ $errors->has('full_name') ? 'has-error' : '' }}">
                    <label for="full_name" style="color:#397e01">Your Full Name</label>
                    <input class="form-control" type="text" name="full_name" id="full_name" value="{{ Request::old('full_name') }}">
                </div>

                <div class="col-sm-6">

                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label for="email" style="color:#397e01">Your E-Mail</label>
                    <input class="form-control" type="text" name="email" id="email" value="{{ Request::old('email') }}">
                </div>

                <div class="input-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <input type="tel" class="form-control" name="phone_number"  id="phone_number" value="{{ Request::old('phone_number') }}"> 
                    <span class="input-group-addon"> Tel <span>

                </div>

                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                        <label for="gender" style="color:#397e01">Gender</label>
                        <input class="form-control" type="text" name="gender" id="gender" value="{{ Request::old('gender') }}">
                    </div>
                    <div class="form-group {{ $errors->has('birthdate') ? 'has-error' : '' }}">
                        <label for="birthdate" style="color:#397e01">Date of birth</label>
                        <input class="form-control" type="date" name="birthdate" id="birthdate" value="{{ Request::old('birthdate') }}">
                    </div>

                </div>
                
                <div class="row">

                    <div class="col-sm-6">

                    <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                        <label for="country" style="color:#397e01">Country</label>
                        <input class="form-control" type="text" name="country" id="country" value="{{ Request::old('country') }}">
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password" style="color:#397e01"> Password</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{ Request::old('password') }}">
                    </div>
                   
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <label for="confpassword" style="color:#397e01">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="{{ Request::old('password_confirmation') }}">
                        </div>
                    </div>

                </div>
            
                <button type="submit" class="btn btn-success">Sign Up</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </form>
        </div>
        
    </div>
    <script src="js/intlTelInput.js"></script>
    <script>
        var input =document.querySelector('#phone')
    </script>
@endsection