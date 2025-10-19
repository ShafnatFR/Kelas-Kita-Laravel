<?php

namespace App\Http\Controllers;

class kelolaUser extends Controller
{
    public $user = [
        [
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
        ],
        [
            'id' => 2,
            'name' => 'Murid',
            'email' => 'murid@gmail.com',
        ],
        [
            'id' => 3,
            'name' => 'Guru',
            'email' => 'guru@gmail.com',
        ],
    ];

    public function createUser() {
        $data = request()->all();
        $countData = count($this->user) + 1;
        $newUser = [
            'id' => $countData,
            'name' => $data['name'],
            'email' => $data['email'],
            // 'role' => $data['role'],
        ];
        
        $this->user[] = $newUser;

        return view ('dashboardAdmin', ['users' => $this->user]);
    }
    
    public function editUser() {}

    public function deleteUser() {}

    public function showUser() {
        $dataUser = $this->user;
        return view('dashboardAdmin', ['users' => $dataUser]);
    }
}
