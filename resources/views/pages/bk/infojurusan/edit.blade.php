@extends('layouts.bk')
@section('title',"Edit Info · {$jurusan->nama_jurusan}")
@section('page-title','Info Jurusan')
@section('page-sub','FR-BK-08/09 · Kelola fasilitas & prospek kerja jurusan kamu')

@section('content')

{{-- HEADER JURUSAN --}}
<div style="background:linear-gradient(135deg,var(--primary-dark),var(--primary));border-radius:14px;padding:20px 24px;margin-bottom:20px;display:flex;align-items:center;gap:16px;">
    <div style="width:52px;height:52px;border-radius:12px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0;">🏫</div>
    <div>
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.6);margin-bottom:4px;">Jurusan yang Kamu Kelola</div>
        <div style="font-family:'Syne',sans-serif;font-size:18px;font-weight:800;color:#fff;">{{ $jurusan->nama_jurusan }}</div>
    </div>
    <div style="margin-left:auto;">
        <span style="background:rgba(255,255,255,.15);color:#fff;font-size:11px;font-weight:700;padding:5px 12px;border-radius:100px;border:1px solid rgba(255,255,255,.2);">
            ✏️ Mode Edit
        </span>
    </div>
</div>

@if(session('success'))
<div style="background:#f0fdf4;border:1px solid #bbf7d0;border-left:3px solid #22c55e;border-radius:9px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#15803d;">
    ✅ {{ session('success') }}
</div>
@endif

<form method="POST" action="{{ route('bk.infojurusan.update', $jurusan->id) }}">
    @csrf @method('PUT')

    {{-- FASILITAS --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <span style="font-size:18px;">🏗️</span>
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Fasilitas Jurusan</div>
                <div style="font-size:11px;color:#94a3b8;">Deskripsikan fasilitas yang tersedia di jurusan ini</div>
            </div>
        </div>
        <textarea name="fasilitas" rows="4"
            placeholder="Contoh: Lab komputer 40 unit, peralatan praktik lengkap, ruang bengkel..."
            style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-family:'DM Sans',sans-serif;font-size:13px;padding:10px 14px;outline:none;resize:vertical;"
            onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
            onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">{{ old('fasilitas', $info->fasilitas ?? '') }}</textarea>
    </div>

    {{-- PROSPEK UMUM --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <span style="font-size:18px;">💼</span>
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Prospek Kerja Umum</div>
                <div style="font-size:11px;color:#94a3b8;">Peluang karir untuk lulusan jurusan ini</div>
            </div>
        </div>
        <div id="prospek-umum">
            @forelse($prospekUmum as $p)
            <div style="display:flex;gap:8px;margin-bottom:8px;">
                <input name="prospek_umum[]" value="{{ $p }}"
                    placeholder="Contoh: Network Engineer..."
                    style="flex:1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                <button type="button" onclick="this.closest('div').remove()"
                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:9px;padding:8px 12px;font-size:12px;cursor:pointer;">✕</button>
            </div>
            @empty
            <div style="display:flex;gap:8px;margin-bottom:8px;">
                <input name="prospek_umum[]"
                    placeholder="Contoh: Network Engineer..."
                    style="flex:1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                <button type="button" onclick="this.closest('div').remove()"
                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:9px;padding:8px 12px;font-size:12px;cursor:pointer;">✕</button>
            </div>
            @endforelse
        </div>
        <button type="button" onclick="addRow('prospek-umum','prospek_umum','Contoh: Network Engineer...')"
            style="background:#f8fafc;color:#374151;border:1.5px solid #e2e8f0;border-radius:9px;padding:7px 14px;font-size:12px;font-weight:700;cursor:pointer;margin-top:4px;">
            ＋ Tambah Prospek
        </button>
    </div>

    {{-- PROSPEK ALUMNI --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:24px;margin-bottom:20px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;padding-bottom:12px;border-bottom:1px solid #f1f5f9;">
            <span style="font-size:18px;">🎓</span>
            <div>
                <div style="font-family:'Syne',sans-serif;font-size:13.5px;font-weight:800;color:#0d1117;">Prospek Kerja Alumni</div>
                <div style="font-size:11px;color:#94a3b8;">Pencapaian dan karir alumni jurusan ini</div>
            </div>
        </div>
        <div id="prospek-alumni">
            @forelse($prospekAlumni as $p)
            <div style="display:flex;gap:8px;margin-bottom:8px;">
                <input name="prospek_alumni[]" value="{{ $p }}"
                    placeholder="Contoh: Bekerja di PT Telkom..."
                    style="flex:1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                <button type="button" onclick="this.closest('div').remove()"
                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:9px;padding:8px 12px;font-size:12px;cursor:pointer;">✕</button>
            </div>
            @empty
            <div style="display:flex;gap:8px;margin-bottom:8px;">
                <input name="prospek_alumni[]"
                    placeholder="Contoh: Bekerja di PT Telkom..."
                    style="flex:1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
                    onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
                    onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
                <button type="button" onclick="this.closest('div').remove()"
                    style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:9px;padding:8px 12px;font-size:12px;cursor:pointer;">✕</button>
            </div>
            @endforelse
        </div>
        <button type="button" onclick="addRow('prospek-alumni','prospek_alumni','Contoh: Bekerja di PT Telkom...')"
            style="background:#f8fafc;color:#374151;border:1.5px solid #e2e8f0;border-radius:9px;padding:7px 14px;font-size:12px;font-weight:700;cursor:pointer;margin-top:4px;">
            ＋ Tambah Alumni
        </button>
    </div>

    {{-- ACTIONS --}}
    <div style="display:flex;justify-content:flex-end;">
        <button type="submit"
            style="padding:11px 28px;border-radius:10px;font-size:13px;font-weight:700;background:linear-gradient(135deg,#0d1117,#1c2333);color:#fff;border:none;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.2);">
            💾 Simpan Perubahan
        </button>
    </div>

</form>

@endsection

@push('scripts')
<script>
function addRow(containerId, inputName, placeholder) {
    const wrap = document.getElementById(containerId);
    const div = document.createElement('div');
    div.style.cssText = 'display:flex;gap:8px;margin-bottom:8px;';
    div.innerHTML = `
        <input name="${inputName}[]" placeholder="${placeholder}"
            style="flex:1;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;padding:9px 13px;outline:none;"
            onfocus="this.style.borderColor='#2563eb';this.style.background='#fff'"
            onblur="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
        <button type="button" onclick="this.closest('div').remove()"
            style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:9px;padding:8px 12px;font-size:12px;cursor:pointer;">✕</button>
    `;
    wrap.appendChild(div);
}
</script>
@endpush