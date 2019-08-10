@extends('Layouts.base_layout')
@section('style')
    <style>
        .error{
            color: red;
        }

    </style>
@endsection
@section('body')
    <div class="container">
        <a class="btn btn-primary" href="{{route('notes.index')}}">Back</a>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h4 class="page-header" style="margin-top: 10px ; text-align: center">Create Note</h4>
                <form style="margin-bottom: 50px" method="post" action="{{route('notes.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label> Note Image
                            <input type="file" name="image">
                        </label>
                        <span class="error">{{$errors->first('image')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{old('title')}}">
                        <span class="error">{{$errors->first('title')}}</span>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" name="content">{{old('content')}}</textarea>
                        <span class="error">{{$errors->first('content')}}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection