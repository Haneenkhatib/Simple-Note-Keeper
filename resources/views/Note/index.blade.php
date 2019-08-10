@extends('Layouts.base_layout')
@section('body')
    <div class="container">
{{--        @role('writer|admin')--}}
        <a class="btn btn-primary" href="{{route('notes.create')}}">Create Note</a>
{{--        @endrole--}}
        <a class="btn btn-primary" href="{{route('home')}}">Back</a>
        <li class="dropdown" style="list-style: none;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">
                <span class="glyphicon glyphicon-globe">Notifications<span class="badge">{{\Illuminate\Support\Facades\Auth::user()->unreadNotifications->count()}}</span></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                @forelse(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $notification)
                you create note {{$notification->data['note_id']}} , title {{$notification->data['title']}}
                @empty
                    There's no notifications
                @endforelse
                </li>
            </ul>
        </li>


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