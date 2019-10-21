@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
    <section class="row new-post">
    <header><h1 style="color: green"> {{ $user->full_name }} </h1></header>

        <div class="row-md-6">
            
            <div class="col-sm-5 ">
                <img src="{{ route('account.image', ['filename' => $user->full_name . '-' . $user->id . '.jpg']) }}" alt="" class="img-responsive">
            </div>
           
            <div class="col-sm-6 row-sm-offset-2">
                <h2>Change your profile name?</h2>
            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" name="full_name" class="form-control" value="{{ $user->full_name }}" id="full_name">
                </div>
                <div class="form-group">
                <h2>Change your profile picture?</h2>
                    <label for="image">Image (only .jpg)</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" class="btn btn-success">Save Account</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
         
            </div>
            
        </div>
    </section>
    @if (Storage::disk('local')->has($user->full_name . '-' . $user->id . '.jpg'))
        <section class="row new-post">
            <div class="col-md-6 col-offset-1">
            <header> <h2>Change your password?</h2></header>
            <h4>Enter your new password below.</h4>
        <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="new-password">New Password</label>
                    <input type="password" name="new-password" class="form-control" value="{{ $user->full_name }}" id="full_name">
                </div>
                <div class="form-group">
                    <label for="image">Confirm New Password</label>
                    <input type="password" name="new-password" class="form-control" id="new-password">
                </div>
                <button type="submit" class="btn btn-success">Save Password</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
            </div>
        </section>
    @endif
@endsection