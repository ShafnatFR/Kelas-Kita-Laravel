<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
</head>

<body>
    <h1>Dashboard Kelola User</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user['id']}}</td>
                <td>{{$user['username']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['role']}}</td>
                <td>
<a href="{{ route('user.editView', ['id' => $user->id]) }}"> 
    <button>Edit</button>
</a>

<a href="{{ route('user.deleteView', ['id' => $user->id]) }}">
    <button>Hapus</button>
</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>