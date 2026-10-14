<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;

class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::with('kelas')->get();
        return view('list_user', [
            'title' => 'Daftar Mahasiswa',
            'users' => $users,
        ]);
    }

    public function create()
    {
        $kelas = Kelas::all();
        return view('create_user', [
            'title' => 'Tambah Mahasiswa',
            'kelas' => $kelas,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        UserModel::create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ]);

        return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        $kelas = Kelas::all();
        return view('edit_user', [
            'title' => 'Edit Mahasiswa',
            'user' => $user,
            'kelas' => $kelas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $user = UserModel::findOrFail($id);
        $user->update([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id'),
        ]);

        return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
