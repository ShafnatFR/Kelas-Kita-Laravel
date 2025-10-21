<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelolaUser extends Controller
{
    public $users = [
        [
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
        ],
        [
            'id' => 2,
            'username' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
        ],
    ];

    public function showUser()
    {
        return view('dashboardKelolaUser', ['users' => $this->users]);
    }

    public function editUserView($id)
    {
        $user = collect($this->users)->firstWhere('id', $id);
        return view('tampilanEdit', compact('user'));
    }

public function editUser(Request $request, $id)
{
    // 1. Dapatkan data pengguna dari request
    // Karena Anda menggunakan array statis, kita perlu mencari indeksnya
    $index = collect($this->users)->search(function ($item) use ($id) {
        return $item['id'] == $id;
    });

    // 2. Cek apakah pengguna ditemukan
    if ($index !== false) {
        
        $this->users[$index]['username'] = $request->input('username');
        $this->users[$index]['email']    = $request->input('email');
        $this->users[$index]['role']     = $request->input('role');
        
        // 4. Redirect ke halaman lain (misalnya halaman daftar)
        return redirect('/')->with('success', 'Data pengguna berhasil diperbarui!');
    }
    
    // Jika tidak ditemukan
    return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
}

    public function deleteUserView($id)
    {
        
    }
}
