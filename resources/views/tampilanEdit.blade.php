<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <form action="/user/{{$user['id']}}/edit" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $user['id'] }}">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ $user['username'] }}"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user['email'] }}"><br><br>
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="{{ $user['role'] }}"><br><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>

</html>