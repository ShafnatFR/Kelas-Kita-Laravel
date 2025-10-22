<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class kelolaUser extends Controller
{

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

    private function getCurrentUsers(Request $request): Collection
    {
        $users = $request->session()->get('dataSession') ?? self::$defaultUsers;
        return collect($users);
    }
    
    private function updateUsersInSession(Request $request, Collection $users): void
    {
        $request->session()->put('dataSession', $users->toArray());
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

    public function storeUser(Request $request)
    {
        $users = $this->getCurrentUsers($request);
        
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
    
    public function editUserView(Request $request, $id)
    {
        $users = $this->getCurrentUsers($request);
        $user = $users->firstWhere('id', (int) $id);
        
        if (!$user) {
            return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
        }

        return view('tampilanEdit', ['user' => $user]);
    }

    public function editUser(Request $request, $id)
    {
        $id = (int) $id;
        $users = $this->getCurrentUsers($request);
        $found = false;

        $users = $users->map(function (array $user) use ($id, $request, &$found) {
            if ($user['id'] === $id) {
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

    public function deleteUserView(Request $request, $id)
    {
        $users = $this->getCurrentUsers($request);
        $user = $users->firstWhere('id', (int) $id);
        
        if (!$user) {
            return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
        }
        
        return view('tampilanDeleteConfirm', ['user' => $user]);
    }
    
    public function deleteUser(Request $request, $id)
    {
        $id = (int) $id;
        $users = $this->getCurrentUsers($request);

        $usersBefore = $users->count();
        $newUsers = $users->reject(fn ($item) => $item['id'] === $id)->values(); 
        
        if ($newUsers->count() < $usersBefore) {
            $this->updateUsersInSession($request, $newUsers);
            return redirect('/')->with('success', 'Pengguna berhasil dihapus!');
        }
        
        return redirect('/')->with('error', 'Pengguna tidak ditemukan!');
    }
}