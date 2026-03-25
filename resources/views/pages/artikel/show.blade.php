{{-- resources/views/pages/artikel/show.blade.php --}}
@extends('layouts.landing')

@section('title', $artikel->judul . ' — SPK SAW')

@section('content')

<div style="max-width:900px;margin:0 auto;padding:36px 20px 60px;">

    {{-- Breadcrumb --}}
    <div style="font-size:12px;color:#94a3b8;margin-bottom:20px;">
        <a href="{{ route('landing.home') }}" style="color:#64748b;text-decoration:none;">Beranda</a>
        <span style="margin:0 6px;">›</span>
        <a href="{{ route('artikel.index') }}" style="color:#64748b;text-decoration:none;">Artikel</a>
        <span style="margin:0 6px;">›</span>
        <span style="color:#0f172a;">{{ Str::limit($artikel->judul, 40) }}</span>
    </div>

    <div style="display:grid;grid-template-columns:1fr 300px;gap:28px;align-items:start;">

        {{-- ═══ ARTIKEL UTAMA ═══ --}}
        <div>
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05);">

                {{-- Gambar --}}
                @if($artikel->gambarUpload)
                    <img src="{{ Storage::url($artikel->gambarUpload->storage_path) }}"
                         alt="{{ $artikel->judul }}"
                         style="width:100%;max-height:380px;object-fit:cover;">
                @else
                    <div style="height:200px;background:linear-gradient(135deg,#0f172a,#1e3a5f);display:flex;align-items:center;justify-content:center;font-size:48px;">
                        📄
                    </div>
                @endif

                <div style="padding:28px;">
                    {{-- Badge --}}
                    <div style="margin-bottom:12px;">
                        <span style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;font-size:10.5px;font-weight:700;padding:3px 10px;border-radius:100px;">
                            {{ $artikel->jurusan->nama_jurusan ?? '-' }}
                        </span>
                    </div>

                    {{-- Judul --}}
                    <h1 style="font-family:'Syne',sans-serif;font-size:clamp(18px,3vw,24px);font-weight:800;color:#0f172a;line-height:1.3;margin-bottom:14px;">
                        {{ $artikel->judul }}
                    </h1>

                    {{-- Meta --}}
                    <div style="display:flex;align-items:center;gap:16px;padding-bottom:18px;border-bottom:1px solid #f1f5f9;margin-bottom:20px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:7px;">
                            <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(135deg,#f0a500,#f97316);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:11px;color:#fff;">
                                {{ strtoupper(substr($artikel->creator->nama ?? 'G', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-size:12.5px;font-weight:700;color:#0f172a;">{{ $artikel->creator->nama ?? 'Guru BK' }}</div>
                                <div style="font-size:11px;color:#94a3b8;">Guru BK</div>
                            </div>
                        </div>
                        <div style="font-size:12px;color:#94a3b8;">📅 {{ $artikel->created_at?->translatedFormat('d F Y') }}</div>
                    </div>

                    {{-- Konten --}}
                    <div style="font-size:14px;line-height:1.8;color:#374151;white-space:pre-line;">
                        {{ $artikel->deskripsi }}
                    </div>

                    {{-- File pendukung --}}
                    @if($artikel->fileUpload)
                        <div style="margin-top:24px;padding:14px 16px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:10px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <span style="font-size:22px;">
                                    {{ $artikel->fileUpload->ext === 'PDF' ? '📄' : '🎬' }}
                                </span>
                                <div>
                                    <div style="font-size:13px;font-weight:700;color:#0f172a;">File Pendukung</div>
                                    <div style="font-size:11px;color:#94a3b8;">{{ $artikel->fileUpload->file_name }}</div>
                                </div>
                            </div>
                            <a href="{{ Storage::url($artikel->fileUpload->storage_path) }}"
                               target="_blank"
                               style="background:#0f172a;color:#fff;padding:7px 16px;border-radius:8px;font-size:12.5px;font-weight:700;text-decoration:none;">
                                ⬇ Unduh
                            </a>
                        </div>
                    @endif

                    {{-- Tombol kembali --}}
                    <div style="margin-top:28px;padding-top:20px;border-top:1px solid #f1f5f9;">
                        <a href="{{ route('artikel.index') }}"
                           style="display:inline-flex;align-items:center;gap:6px;background:#f8fafc;color:#374151;border:1.5px solid #e2e8f0;padding:8px 18px;border-radius:9px;font-size:13px;font-weight:700;text-decoration:none;">
                            ← Kembali ke Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ SIDEBAR ═══ --}}
        <div style="position:sticky;top:80px;">

            {{-- Info jurusan --}}
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px;margin-bottom:16px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
                <div style="font-family:'Syne',sans-serif;font-size:13px;font-weight:800;color:#0f172a;margin-bottom:12px;">🏫 Tentang Jurusan</div>
                <div style="font-size:14px;font-weight:700;color:#0f172a;margin-bottom:4px;">
                    {{ $artikel->jurusan->nama_jurusan ?? '-' }}
                </div>
                @if($artikel->jurusan->informasiJurusan)
                    <div style="font-size:12px;color:#64748b;line-height:1.6;">
                        {{ Str::limit($artikel->jurusan->informasiJurusan->fasilitas, 120) }}
                    </div>
                @endif
            </div>

            {{-- Artikel terkait --}}
            @if($terkait->isNotEmpty())
            <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px;box-shadow:0 1px 3px rgba(0,0,0,.05);">
                <div style="font-family:'Syne',sans-serif;font-size:13px;font-weight:800;color:#0f172a;margin-bottom:14px;">📚 Artikel Terkait</div>
                @foreach($terkait as $item)
                <a href="{{ route('artikel.show', $item->id) }}"
                   style="display:flex;gap:10px;padding:10px 0;border-bottom:1px solid #f1f5f9;text-decoration:none;color:inherit;">
                    @if($item->gambarUpload)
                        <img src="{{ Storage::url($item->gambarUpload->storage_path) }}"
                             style="width:56px;height:56px;border-radius:8px;object-fit:cover;flex-shrink:0;">
                    @else
                        <div style="width:56px;height:56px;border-radius:8px;background:linear-gradient(135deg,#0f172a,#1e3a5f);display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0;">📄</div>
                    @endif
                    <div>
                        <div style="font-size:12.5px;font-weight:700;color:#0f172a;line-height:1.4;">
                            {{ Str::limit($item->judul, 55) }}
                        </div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:3px;">
                            {{ $item->created_at?->diffForHumans() }}
                        </div>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('artikel.index', ['jurusan' => $artikel->jurusan_id]) }}"
                   style="display:block;text-align:center;margin-top:12px;font-size:12px;font-weight:700;color:#2563eb;text-decoration:none;">
                    Lihat semua artikel {{ $artikel->jurusan->nama_jurusan ?? '' }} →
                </a>
            </div>
            @endif
        </div>

    </div>
</div>

@endsection