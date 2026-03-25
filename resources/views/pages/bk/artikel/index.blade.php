@extends('layouts.bk')
@section('title','Artikel Jurusan')
@section('page-title','Artikel Jurusan')
@section('page-sub','FR-BK-07 · Kelola artikel jurusan')

@section('content')

<div style="display:flex;justify-content:flex-end;margin-bottom:16px;">
    <a href="{{ route('bk.artikel.create') }}" class="btn btn-primary">➕ Tambah Artikel</a>
</div>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px;">
    
    @forelse($artikels as $a)
    <div class="card"
         onclick="window.location='{{ route('artikel.show', $a->id) }}'"
         style="overflow:hidden;cursor:pointer;transition:0.2s;">

        {{-- Gambar --}}
        @if($a->gambarUpload)
            <img src="{{ Storage::url($a->gambarUpload->storage_path) }}"
                 style="width:100%;height:130px;object-fit:cover;"/>
        @else
            <div style="height:130px;
                        background:linear-gradient(135deg,var(--primary-dark),var(--primary));
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:40px;">
                📄
            </div>
        @endif

        {{-- Content --}}
        <div style="padding:14px;">
            <div style="font-size:10px;
                        font-weight:700;
                        text-transform:uppercase;
                        color:var(--accent);
                        margin-bottom:5px;">
                {{ $a->jurusan->nama_jurusan ?? '-' }}
            </div>

            <div style="font-size:13px;
                        font-weight:700;
                        color:var(--primary-dark);
                        line-height:1.4;
                        margin-bottom:8px;">
                {{ $a->judul }}
            </div>

            <div style="font-size:11px;color:var(--text-dim);">
                📅 {{ $a->created_at->translatedFormat('d M Y') }}
            </div>

            @if($a->fileUpload)
                <div style="font-size:11px;color:var(--blue);margin-top:4px;">
                    📎 {{ $a->fileUpload->file_name }}
                </div>
            @endif
        </div>

        {{-- Action --}}
        <div style="padding:10px 14px;
                    border-top:1px solid var(--border);
                    display:flex;
                    gap:6px;">

            <a href="{{ route('bk.artikel.edit', $a->id) }}"
               onclick="event.stopPropagation()"
               class="btn btn-outline btn-sm">
               ✏️ Edit
            </a>

            <form method="POST"
                  action="{{ route('bk.artikel.destroy', $a->id) }}"
                  onclick="event.stopPropagation()"
                  onsubmit="return confirm('Hapus artikel ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    🗑️ Hapus
                </button>
            </form>

        </div>
    </div>

    @empty
    <div style="grid-column:1/-1;
                text-align:center;
                padding:48px;
                color:var(--text-dim);">
        Belum ada artikel.
        <a href="{{ route('bk.artikel.create') }}"
           style="color:var(--primary);">
           Tambah sekarang
        </a>
    </div>
    @endforelse

</div>

<div style="margin-top:16px;">
    {{ $artikels->links() }}
</div>

@endsection

