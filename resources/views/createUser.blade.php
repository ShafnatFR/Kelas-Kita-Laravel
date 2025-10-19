<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    
    <form action="createUser" method="POST">
        @csrf
        <h2>Create New User</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        {{-- <label for="role">Role:</label>
        <input type="role" id="role" name="role" required><br><br> --}}
        
        <button type="submit">Create User</button>
    </form>

</body>
</html>