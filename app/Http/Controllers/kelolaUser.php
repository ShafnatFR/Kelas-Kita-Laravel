<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class kelolaUser extends Controller
{
    // Data default. Akan digunakan jika tidak ada data di session.
    protected static array $defaultUsers = [
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

    // Fungsi untuk mendapatkan status array terbaru (dari session atau default)
    private function getCurrentUsers(Request $request): Collection
    {
        // Menggunakan 'get' untuk data persisten di session
        $users = $request->session()->get('persisted_users') ?? self::$defaultUsers;
        return collect($users);
    }
    
    // Fungsi untuk menyimpan status array terbaru ke session
    private function updateUsersInSession(Request $request, Collection $users): void
    {
        // Menggunakan 'put' untuk menyimpan data, bukan 'flash'
        $request->session()->put('persisted_users', $users->toArray());
    }

    public function showUser(Request $request)
    {
        $users = $this->getCurrentUsers($request);
        
        return view('dashboardKelolaUser', ['users' => $users]);
    }

    public function createUserView()
    {
        return view('tampilanCreate');
    }

    // --- CREATE ACTION (Menyimpan Data Baru) ---
    public function storeUser(Request $request)
    {
        $users = $this->getCurrentUsers($request);
        
        // Buat ID baru: ID maksimal + 1
        $newId = $users->isNotEmpty() ? $users->max('id') + 1 : 1;

        $newUser = [
            'id' => $newId,
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'role' => $request->input('role', 'user'),
        ];
        
        $users->push($newUser);

        $this->updateUsersInSession($request, $users);
        return redirect('/')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }
    
    // --- EDIT VIEW (Menampilkan Form Edit) ---
    public function editUserView(Request $request, $id)
    {
        $users = $this->getCurrentUsers($request);
        $user = $users->firstWhere('id', (int) $id);
        
        if (!$user) {
            return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
        }

        return view('tampilanEdit', ['user' => $user]);
    }

    // --- EDIT ACTION (Memperbarui Data) ---
    public function editUser(Request $request, $id)
    {
        $id = (int) $id;
        $users = $this->getCurrentUsers($request);
        $found = false;

        // Menggunakan Collection::map untuk mengubah elemen di dalam Collection secara aman
        $users = $users->map(function (array $user) use ($id, $request, &$found) {
            if ($user['id'] === $id) {
                // Modifikasi data user
                $user['username'] = $request->input('username');
                $user['email']    = $request->input('email');
                $user['role']     = $request->input('role');
                $found = true;
            }
            return $user;
        });

        if ($found) {
            $this->updateUsersInSession($request, $users);
            return redirect('/')->with('success', 'Data pengguna berhasil diperbarui! (Perubahan disimpan di session.)');
        }
        
        return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
    }

    // --- DELETE VIEW (Menampilkan Konfirmasi Hapus) ---
    public function deleteUserView(Request $request, $id)
    {
        $users = $this->getCurrentUsers($request);
        $user = $users->firstWhere('id', (int) $id);
        
        if (!$user) {
            return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
        }
        
        return view('tampilanDeleteConfirm', ['user' => $user]);
    }
    
    // --- DELETE ACTION (Menghapus Data) ---
    public function deleteUser(Request $request, $id)
    {
        $id = (int) $id;
        $users = $this->getCurrentUsers($request);

        $usersBefore = $users->count();
        // Menggunakan Collection::reject untuk membuat Collection baru tanpa elemen yang dihapus
        $newUsers = $users->reject(fn ($item) => $item['id'] === $id)->values(); 
        
        if ($newUsers->count() < $usersBefore) {
            $this->updateUsersInSession($request, $newUsers);
            return redirect('/')->with('success', 'Pengguna berhasil dihapus!');
        }
        
        return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
    }
}