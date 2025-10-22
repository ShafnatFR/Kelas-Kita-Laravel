<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>

<body>
    <h1>Edit Pengguna #{{ $user['id'] }}</h1>
    
    <form action="{{ route('user.edit', ['id' => $user['id']]) }}" method="post">
        @csrf

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user['username']) }}" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user['email']) }}" required><br><br>
        
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="{{ old('role', $user['role']) }}" required><br><br>
        
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('user.index') }}"><button type="button">Batal</button></a>
    </form>
</body>

</html>