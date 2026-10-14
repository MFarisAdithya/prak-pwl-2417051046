@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 650px; padding: 30px; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); margin-top: 30px;">
    
    <div style="margin-bottom: 24px; border-bottom: 2px solid #f1f5f9; padding-bottom: 14px;">
        <h1 style="margin: 0; font-size: 1.5rem; color: #1e293b; font-weight: 700;">Edit Data Mahasiswa</h1>
        <p style="margin: 4px 0 0 0; color: #64748b; font-size: 0.88rem;">Perbarui data mahasiswa yang telah tersimpan (UUID: <code style="font-size: 0.8rem; background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $user->id }}</code>)</p>
    </div>

    @if ($errors->any())
        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 12px 16px; border-radius: 6px; margin-bottom: 18px; color: #b91c1c; font-size: 0.88rem;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 18px;">
            <label for="nama" style="display: block; font-weight: 600; color: #334155; margin-bottom: 6px; font-size: 0.9rem;">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required placeholder="Contoh: M. Faris Adithya" style="width: 100%; max-width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 18px;">
            <label for="npm" style="display: block; font-weight: 600; color: #334155; margin-bottom: 6px; font-size: 0.9rem;">NPM:</label>
            <input type="text" id="npm" name="npm" value="{{ old('npm', $user->npm) }}" required placeholder="Contoh: 2417051046" style="width: 100%; max-width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 24px;">
            <label for="kelas_id" style="display: block; font-weight: 600; color: #334155; margin-bottom: 6px; font-size: 0.9rem;">Kelas:</label>
            <select id="kelas_id" name="kelas_id" required style="width: 100%; max-width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; background: #fff; box-sizing: border-box;">
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelas as $k)
                    <option value="{{ $k->id }}" {{ old('kelas_id', $user->kelas_id) == $k->id ? 'selected' : '' }}>
                        Kelas {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display: flex; gap: 12px; align-items: center;">
            <button type="submit" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff; padding: 10px 22px; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; box-shadow: 0 4px 10px rgba(217,119,6,0.2);">
                Simpan Perubahan
            </button>
            <a href="{{ route('user.index') }}" style="color: #64748b; text-decoration: none; font-size: 0.9rem; padding: 10px 16px;">
                Batal
            </a>
        </div>
    </form>

</div>
@endsection
