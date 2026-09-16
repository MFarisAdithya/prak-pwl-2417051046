<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profileController extends Controller
{
    public function profile($nama = null, $npm = null, $kelas = null)
    {
        $data = [
            'nama' => $nama ?: 'M. Faris Adithya',
            'NPM' => $npm ?: '2417051046',
            'kelas' => $kelas ?: 'Ilmu Komputer A',
        ];
        return view('profile', $data);
    }
}
