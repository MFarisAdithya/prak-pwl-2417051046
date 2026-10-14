@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 1000px; padding: 30px; background: #ffffff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.06); margin-top: 30px;">
    
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 2px solid #f1f5f9; padding-bottom: 16px;">
        <div>
            <h1 style="margin: 0; font-size: 1.75rem; color: #1e293b; font-weight: 700;">Daftar Mahasiswa</h1>
            <p style="margin: 4px 0 0 0; color: #64748b; font-size: 0.9rem;">Kelola data mahasiswa dan kelas (CRUD Update & Delete)</p>
        </div>
        <a href="{{ route('user.create') }}" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: #ffffff; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); transition: all 0.2s ease;">
            <span>+</span> Tambah Mahasiswa
        </a>
    </div>

    <!-- Alert Notifikasi Sukses / Error (Kreatif & Eye-catching) -->
    @if (session('success'))
        <div style="display: flex; align-items: center; gap: 12px; background: #ecfdf5; border-left: 5px solid #10b981; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(16, 185, 129, 0.1);">
            <svg style="width: 22px; height: 22px; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <strong style="color: #065f46; font-size: 0.95rem;">Berhasil!</strong>
                <span style="color: #047857; font-size: 0.9rem; margin-left: 4px;">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div style="display: flex; align-items: center; gap: 12px; background: #fef2f2; border-left: 5px solid #ef4444; padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 6px rgba(239, 68, 68, 0.1);">
            <svg style="width: 22px; height: 22px; color: #ef4444; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <strong style="color: #991b1b; font-size: 0.95rem;">Terjadi Kesalahan!</strong>
                <span style="color: #b91c1c; font-size: 0.9rem; margin-left: 4px;">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Tabel Data Mahasiswa -->
    <div style="overflow-x: auto; border-radius: 8px; border: 1px solid #e2e8f0;">
        <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.92rem;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0; color: #475569; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.05em;">
                    <th style="padding: 14px 18px;">UUID (ID)</th>
                    <th style="padding: 14px 18px;">Nama Mahasiswa</th>
                    <th style="padding: 14px 18px;">NPM</th>
                    <th style="padding: 14px 18px;">Kelas</th>
                    <th style="padding: 14px 18px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                        <td style="padding: 14px 18px; font-family: monospace; color: #64748b; font-size: 0.85rem;" title="{{ $user->id }}">
                            {{ Str::limit($user->id, 13, '...') }}
                        </td>
                        <td style="padding: 14px 18px; font-weight: 600; color: #1e293b;">
                            {{ $user->nama }}
                        </td>
                        <td style="padding: 14px 18px; color: #334155; font-family: monospace; font-size: 0.9rem;">
                            {{ $user->npm }}
                        </td>
                        <td style="padding: 14px 18px;">
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 12px; border-radius: 9999px; font-size: 0.8rem; font-weight: 600; border: 1px solid #bae6fd;">
                                {{ $user->kelas ? $user->kelas->nama_kelas : 'Belum Ada' }}
                            </span>
                        </td>
                        <!-- Creative Styled Action Buttons (Edit & Delete) -->
                        <td style="padding: 14px 18px; text-align: center; white-space: nowrap;">
                            <div style="display: inline-flex; gap: 8px; align-items: center;">
                                <!-- Tombol Edit Kreatif -->
                                <a href="{{ route('user.edit', $user->id) }}" 
                                   style="background: #fef3c7; color: #92400e; border: 1px solid #fcd34d; padding: 6px 14px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: all 0.2s;" 
                                   onmouseover="this.style.background='#fde68a'; this.style.color='#78350f';" 
                                   onmouseout="this.style.background='#fef3c7'; this.style.color='#92400e';">
                                    <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>

                                <!-- Tombol Hapus Kreatif -->
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa {{ $user->nama }}?')"
                                            style="background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; padding: 6px 14px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 5px; transition: all 0.2s;"
                                            onmouseover="this.style.background='#fecaca'; this.style.color='#991b1b';"
                                            onmouseout="this.style.background='#fee2e2'; this.style.color='#b91c1c';">
                                        <svg style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 32px; text-align: center; color: #94a3b8; font-style: italic;">
                            Belum ada data mahasiswa. Silakan klik tombol "Tambah Mahasiswa" untuk menambahkan data baru.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
