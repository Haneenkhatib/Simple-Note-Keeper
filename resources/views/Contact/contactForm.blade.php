@extends('Layouts.base_layout')
@section('style')
    <style>
        .error{
            text-align: center;
            color: red;
        }
    </style>
@endsection
@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h4 class="page-header" style="margin-top: 10px ; text-align: center">Contact Form</h4>
                <form style="margin-bottom: 50px" method="post" action="{{route('contact.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                        <span class="error">{{$errors->first('name')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter E-mail">
                        <span class="error">{{$errors->first('email')}}</span>

                    </div>
                    <div class="form-group">
                        <label for="content">Message</label>
                        <textarea class="form-control" name="message">Enter Message</textarea>
                        <span class="error">{{$errors->first('message')}}</span>

                    </div>
                    <button type="submit" class="btn btn-primary">Send Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection