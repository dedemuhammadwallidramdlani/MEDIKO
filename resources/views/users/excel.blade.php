<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Roles</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $val)
        <tr>
            <td>{{ $val->name }}</td>
            <td>{{ $val->email }}</td>
            <td>{{ $val->roles }}</td>
        </tr>
    @endforeach
    </tbody>
</table>