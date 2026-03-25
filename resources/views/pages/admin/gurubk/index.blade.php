@extends('layouts.admin')
@section('title','Kelola Akun Guru BK')
@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;">👩‍🏫 Akun Guru BK</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-02 s/d FR-A-05 · Kelola akun, profil, dan jurusan Guru BK</p>
    </div>
    <a href="{{ route('admin.gurubk.create') }}" style="display:inline-flex;align-items:center;gap:6px;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;text-decoration:none;">
        ＋ Tambah Guru BK
    </a>
</div>

@if(session('success'))
<div style="background:#ecfdf5;border:1px solid #a7f3d0;border-left:3px solid #059669;color:#065f46;padding:12px 16px;border-radius:8px;font-size:13px;margin-bottom:16px;">✅ {{ session('success') }}</div>
@endif

<div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;box-shadow:0 1px 3px rgba(0,0,0,.06);overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:#f8fafc;">
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">Nama & Email</th>
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">NIP</th>
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">Jurusan</th>
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">Status</th>
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">Pass Wajib Ganti</th>
                <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b;border-bottom:1px solid #e2e8f0;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($guruBks as $guru)
            <tr style="border-bottom:1px solid #e2e8f0;" onmouseover="this.style.background='#fafbfc'" onmouseout="this.style.background=''">
                <td style="padding:12px 16px;">
                    <div style="font-weight:700;font-size:13px;">{{ $guru->user->nama ?? '-' }}</div>
                    <div style="font-size:11px;color:#64748b;">{{ $guru->user->email ?? '-' }}</div>
                </td>
                <td style="padding:12px 16px;font-size:12.5px;color:#374151;">{{ $guru->nip ?? '-' }}</td>
                <td style="padding:12px 16px;">
                    @if($guru->jurusan)
                        <span style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;">{{ $guru->jurusan->nama_jurusan }}</span>
                    @else
                        <span style="color:#94a3b8;font-size:12px;">Belum ditentukan</span>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    @if($guru->user->is_active)
                        <span style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;">✅ Aktif</span>
                    @else
                        <span style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;">❌ Nonaktif</span>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    @if($guru->user->must_change_password)
                        <span style="background:#fffbeb;color:#d97706;border:1px solid #fde68a;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;">⚠️ Wajib Ganti</span>
                    @else
                        <span style="background:#f0fdf4;color:#059669;padding:3px 9px;border-radius:100px;font-size:10.5px;font-weight:700;">✔ Sudah Ganti</span>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        <a href="{{ route('admin.gurubk.edit', $guru->id) }}" style="display:inline-flex;align-items:center;gap:4px;background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;padding:5px 11px;border-radius:7px;font-size:11.5px;font-weight:700;text-decoration:none;">✏️ Edit</a>
                        <form method="POST" action="{{ route('admin.gurubk.status', $guru->id) }}" style="display:inline;">
                            @csrf @method('PATCH')
                            <button type="submit" style="display:inline-flex;align-items:center;gap:4px;background:{{ $guru->user->is_active ? '#fef2f2' : '#ecfdf5' }};color:{{ $guru->user->is_active ? '#dc2626' : '#059669' }};border:1px solid {{ $guru->user->is_active ? '#fecaca' : '#a7f3d0' }};padding:5px 11px;border-radius:7px;font-size:11.5px;font-weight:700;cursor:pointer;">
                                {{ $guru->user->is_active ? '🔴 Nonaktifkan' : '🟢 Aktifkan' }}
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="padding:32px;text-align:center;color:#94a3b8;font-size:13px;">Belum ada data Guru BK.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:14px 16px;border-top:1px solid #e2e8f0;">{{ $guruBks->links() }}</div>
</div>
@endsection