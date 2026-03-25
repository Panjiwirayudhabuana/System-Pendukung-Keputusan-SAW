@extends('layouts.admin')
@section('title','Edit Siswa')
@section('content')
<div style="max-width:640px;">
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.siswa.index') }}" style="font-size:12px;color:#2563eb;text-decoration:none;">← Kembali</a>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;margin-top:8px;">Edit Profil Siswa</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-A-05, FR-A-06 · Edit profil dan reset password siswa</p>
    </div>

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <form method="POST" action="{{ route('admin.siswa.update', $siswa->id) }}">
            @csrf @method('PUT')

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Nama Lengkap *</label>
                    <input type="text" name="nama" value="{{ old('nama', $siswa->user->nama) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                    @error('nama')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Email *</label>
                    <input type="email" name="email" value="{{ old('email', $siswa->user->email) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                    @error('email')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" value="{{ old('sekolah_asal', $siswa->sekolah_asal) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
                <div>
                    <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">No. Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Alamat</label>
                <textarea name="alamat" rows="2" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;resize:vertical;" onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">{{ old('alamat', $siswa->alamat) }}</textarea>
            </div>

            {{-- <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:9px;padding:14px 16px;margin-bottom:16px;">
                <div style="font-size:11.5px;font-weight:700;color:#92400e;margin-bottom:8px;">🔒 Reset Password (FR-A-06)</div>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="width:100%;background:#fff;border:1.5px solid #fde68a;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;">
            </div> --}}

            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a href="{{ route('admin.siswa.index') }}" style="padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;border:1.5px solid #e2e8f0;color:#64748b;text-decoration:none;">Batal</a>
                <button type="submit" style="padding:9px 22px;border-radius:9px;font-size:12.5px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;">✓ Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection




























