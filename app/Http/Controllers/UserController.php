<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.form');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:tb_user,username',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,petugas,owner',
            'status_aktif' => 'required|boolean'
        ]);

        User::create([
            'nama_lengkap' => $r->nama_lengkap,
            'username' => $r->username,
            'password' => $r->password,
            'role' => $r->role,
            'status_aktif' => $r->status_aktif
        ]);

        return redirect('/user')->with('success','User berhasil ditambah');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.form', compact('user'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:tb_user,username,' . $id . ',id_user',
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,petugas,owner',
            'status_aktif' => 'required|boolean'
        ]);

        $user = User::find($id);

        $data = $r->only('nama_lengkap','username','role','status_aktif');

        if($r->password){
            $data['password'] = $r->password;
        }

        $user->update($data);

        return redirect('/user')->with('success','User berhasil diupdate');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user')->with('success','User berhasil dihapus');
    }
}
