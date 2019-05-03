@extends('Layouts.base_layout')
@section('body')
    <div class="container">
        <a class="btn btn-primary" href="{{route('notes.create')}}">Create Note</a>
        <h2 class="page-header" style="margin-top: 10px ; text-align: center">Notes Information</h2>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created_At</th>

            </tr>
            </thead>
            <tbody>
            @forelse($notes as $note)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$note->title}}</td>
                    <td>{{str_limit($note->content,20)}}</td>
                    <td>{{Carbon\Carbon::parse($note
                ->created_at)->format("y-m-d D")}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Notes not found</td>
                </tr>
            @endforelse

            </tbody>
        </table>
    </div>
@endsection