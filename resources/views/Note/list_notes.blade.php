<table class="table table-bordered" id="laravel_crud">
    <thead>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Created at</th>

    </tr>
    </thead>
    <tbody>
    @foreach($notes as $note)
        <tr>
            <td>{{ $note->id }}</td>
            <td>{{ $note->title }}</td>
            <td>{{ $note->content }}</td>
            <td>{{ date('d m Y', strtotime($note->created_at)) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>