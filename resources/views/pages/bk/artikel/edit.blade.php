@extends('layouts.bk')
@section('title','Edit Artikel')
@section('page-title','Edit Artikel')
@section('page-sub','FR-BK-07 · Edit artikel jurusan')

@section('content')
<div style="max-width:680px;">

    <div style="margin-bottom:20px;">
        <a href="{{ route('bk.artikel.index') }}" style="font-size:12px;color:#2563eb;text-decoration:none;">← Kembali</a>
        <h1 style="font-family:'Syne',sans-serif;font-size:20px;font-weight:800;color:#0d1117;margin-top:8px;">Edit Artikel</h1>
        <p style="font-size:12px;color:#64748b;margin-top:3px;">FR-BK-07 · Edit artikel jurusan</p>
    </div>

    @if($errors->any())
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:9px;padding:12px 16px;margin-bottom:16px;font-size:12.5px;color:#dc2626;">
        <ul style="margin:0;padding-left:16px;">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:28px;box-shadow:0 1px 3px rgba(0,0,0,.06);">
        <form method="POST" action="{{ route('bk.artikel.update', $artikel->id) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Jurusan --}}
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Jurusan *</label>
                <select name="jurusan_id" style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb'" onblur="this.style.borderColor='#e2e8f0'">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusans as $j)
                        <option value="{{ $j->id }}" {{ old('jurusan_id', $artikel->jurusan_id) == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
                @error('jurusan_id')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- Judul --}}
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Judul Artikel *</label>
                <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}"
                    placeholder="Masukkan judul artikel..."
                    style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                @error('judul')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- Deskripsi --}}
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Deskripsi *</label>
                <textarea name="deskripsi" rows="6"
                    placeholder="Tulis deskripsi artikel..."
                    style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:10px 14px;outline:none;resize:vertical;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                @error('deskripsi')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- Gambar --}}
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">Gambar (JPG/JPEG, maks 8MB)</label>
                @if($artikel->gambarUpload)
                <div style="font-size:11.5px;color:#64748b;margin-bottom:6px;">
                    📷 Gambar saat ini: <strong>{{ $artikel->gambarUpload->file_name }}</strong>
                </div>
                @endif
                <input type="file" name="gambar" accept="image/jpg,image/jpeg"
                    style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">Kosongkan jika tidak ingin mengubah gambar.</div>
                @error('gambar')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- File --}}
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:7px;">File Pendukung (PDF/MP4, maks 50MB)</label>
                @if($artikel->fileUpload)
                <div style="font-size:11.5px;color:#64748b;margin-bottom:6px;">
                    📎 File saat ini: <strong>{{ $artikel->fileUpload->file_name }}</strong>
                </div>
                @endif
                <input type="file" name="file" accept=".pdf,.mp4"
                    style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px;">Kosongkan jika tidak ingin mengubah file.</div>
                @error('file')<div style="color:#dc2626;font-size:11.5px;margin-top:4px;">{{ $message }}</div>@enderror
            </div>

            {{-- Actions --}}
            <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:16px;border-top:1px solid #e2e8f0;">
                <a href="{{ route('bk.artikel.index') }}"
                    style="padding:9px 18px;border-radius:9px;font-size:12.5px;font-weight:700;border:1.5px solid #e2e8f0;color:#64748b;text-decoration:none;">
                    Batal
                </a>
                <button type="submit"
                    style="padding:9px 22px;border-radius:9px;font-size:12.5px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;">
                    ✓ Simpan Perubahan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection