<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns|unique:users,email',
            'level' => 'required',
            'telp' => 'required|min:11',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'email.required' => 'Alamat email wajib diisi',
            'email.dns' => 'Email harus memiliki format valid~',
            'email.unique' => 'Alamat email sudah tersedia',
            'level.required' => 'Status wajib dipilih',
            'telp.required' => 'Nomor Telepon wajib diisi',
        ]);

        User::create([
            'name' => $request->name ?? '-',
            'email' => $request->email ?? '-',
            'password' => bcrypt('12345678'),
            'level' => $request->level ?? '-',
            'telp' => $request->telp ?? '-',
        ]);

        return redirect('user-registrasi')->with('success', 'Selamat ! Anda berhasil menambahkan data user registrasi');
    }

    public function edit($id)
    {
        return view('admin.user.edit', [
            'users' => User::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'telp' => 'required|min:11',
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'level.required' => 'Status wajib dipilih',
            'telp.required' => 'Nomor Telepon wajib diisi',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name ?? '-',
            'password' => bcrypt('12345678'),
            'level' => $request->level ?? '-',
            'telp' => $request->telp ?? '-',
        ]);

        return redirect('user-registrasi')->with('success', 'Selamat ! Anda berhasil memperbaharui data user registrasi');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();

        return redirect('user-registrasi')->with('success', 'Selamat ! Anda berhasil menghapus data user registrasi');
    }
}
