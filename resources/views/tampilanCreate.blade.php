<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
</head>

<body>
    <h1>Tambah Pengguna Baru</h1>
    
    <form action="{{ route('user.store') }}" method="post">
        @csrf
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ old('username') }}" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required><br><br>
        
        <label for="role">Role (default 'user'):</label>
        <input type="text" id="role" name="role" value="{{ old('role', 'user') }}" required><br><br>
        
        {{-- Karena data tidak persisten, kita tidak perlu field password yang di-hash --}}
        <p style="font-style: italic; color: gray;">Catatan: Karena menggunakan array, password tidak disimpan/diproses.</p><br>

        <button type="submit">Tambah Pengguna</button>
        <a href="{{ route('user.index') }}"><button type="button">Batal</button></a>
    </form>
</body>

</html>