<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Pengguna</title>
</head>

<body>
    <h1>Konfirmasi Hapus Pengguna</h1>
    
    <p>Apakah Anda yakin ingin menghapus pengguna:</p>
    <p><strong>ID:</strong> {{ $user['id'] }}</p>
    <p><strong>Username:</strong> {{ $user['username'] }}</p>
    <p><strong>Email:</strong> {{ $user['email'] }}</p>

    <form action="{{ route('user.delete', ['id' => $user['id']]) }}" method="post" style="display: inline-block;">
        @csrf
        <button type="submit" style="color: red;">Ya, Hapus</button>
    </form>
    
    <a href="{{ route('user.index') }}">
        <button type="button">Tidak, Kembali</button>
    </a>
</body>

</html>