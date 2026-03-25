{{-- resources/views/pages/artikel/index.blade.php --}}
@extends('layouts.landing')

@section('title', 'Artikel Jurusan — SPK SAW')

@section('content')

{{-- ═══ HERO ═══ --}}
<section style="background:linear-gradient(135deg,#0f172a,#1e3a5f);padding:52px 0 44px;text-align:center;">
    <div style="max-width:700px;margin:0 auto;padding:0 20px;">
        <div style="display:inline-flex;align-items:center;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:#93c5fd;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;padding:4px 14px;border-radius:100px;margin-bottom:14px;">
            📝 Artikel Jurusan
        </div>
        <h1 style="font-family:'Syne',sans-serif;font-size:clamp(24px,4vw,36px);font-weight:800;color:#fff;margin-bottom:10px;line-height:1.2;">
            Kenali Jurusanmu Lebih Dalam
        </h1>
        <p style="color:rgba(255,255,255,.6);font-size:14px;line-height:1.6;">
            Artikel informatif dari Guru BK untuk membantu kamu memilih jurusan yang tepat.
        </p>
    </div>
</section>

{{-- ═══ FILTER BAR ═══ --}}
<section style="background:#fff;border-bottom:1px solid #e2e8f0;padding:14px 0;position:sticky;top:0;z-index:50;box-shadow:0 2px 8px rgba(0,0,0,.06);">
    <div style="max-width:1100px;margin:0 auto;padding:0 20px;">
        <form method="GET" action="{{ route('artikel.index') }}"
              style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
            {{-- Search --}}
            <div style="flex:1;min-width:200px;position:relative;">
                <span style="position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:14px;">🔍</span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari artikel..."
                       style="width:100%;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;padding:8px 13px 8px 35px;font-size:13px;outline:none;font-family:'DM Sans',sans-serif;">
            </div>
            {{-- Filter jurusan --}}
            <select name="jurusan"
                    style="background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:9px;padding:8px 13px;font-size:13px;outline:none;font-family:'DM Sans',sans-serif;min-width:180px;"
                    onchange="this.form.submit()">
                <option value="">Semua Jurusan</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id }}" {{ request('jurusan') == $j->id ? 'selected' : '' }}>
                        {{ $j->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                    style="background:linear-gradient(135deg,#0f172a,#1e3a5f);color:#fff;border:none;border-radius:9px;padding:8px 18px;font-size:13px;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;">
                Cari
            </button>
            @if(request('search') || request('jurusan'))
                <a href="{{ route('artikel.index') }}"
                   style="color:#64748b;font-size:12.5px;font-weight:600;text-decoration:none;">
                    Reset
                </a>
            @endif
        </form>
    </div>
</section>

{{-- ═══ ARTIKEL GRID ═══ --}}
<section style="background:#f0f4fa;padding:36px 0 60px;">
    <div style="max-width:1100px;margin:0 auto;padding:0 20px;">

        {{-- Info hasil --}}
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:8px;">
            <div style="font-size:13px;color:#64748b;">
                Menampilkan <strong>{{ $artikels->total() }}</strong> artikel
                @if(request('search'))
                    untuk "<strong>{{ request('search') }}</strong>"
                @endif
                @if(request('jurusan'))
                    @php $selectedJurusan = $jurusans->firstWhere('id', request('jurusan')); @endphp
                    @if($selectedJurusan)
                        — jurusan <strong>{{ $selectedJurusan->nama_jurusan }}</strong>
                    @endif
                @endif
            </div>
        </div>

        @if($artikels->isEmpty())
            <div style="text-align:center;padding:60px 20px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                <div style="font-size:40px;margin-bottom:12px;">📭</div>
                <div style="font-size:15px;font-weight:700;color:#0f172a;margin-bottom:6px;">Artikel tidak ditemukan</div>
                <div style="font-size:13px;color:#64748b;">Coba ubah kata kunci atau filter jurusan.</div>
                <a href="{{ route('artikel.index') }}"
                   style="display:inline-block;margin-top:16px;background:#0f172a;color:#fff;padding:8px 20px;border-radius:9px;font-size:13px;font-weight:700;text-decoration:none;">
                    Lihat Semua Artikel
                </a>
            </div>
        @else
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:20px;">
                @foreach($artikels as $artikel)
                <a href="{{ route('artikel.show', $artikel->id) }}"
                   style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.05);text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:transform .2s,box-shadow .2s;"
                   onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,.1)'"
                   onmouseout="this.style.transform='';this.style.boxShadow='0 1px 3px rgba(0,0,0,.05)'">

                    {{-- Thumbnail --}}
                    @if($artikel->gambarUpload)
                        <img src="{{ Storage::url($artikel->gambarUpload->storage_path) }}"
                             alt="{{ $artikel->judul }}"
                             style="width:100%;height:180px;object-fit:cover;">
                    @else
                        <div style="height:140px;background:linear-gradient(135deg,#0f172a,#1e3a5f);display:flex;align-items:center;justify-content:center;font-size:36px;">
                            📄
                        </div>
                    @endif

                    {{-- Body --}}
                    <div style="padding:16px;flex:1;display:flex;flex-direction:column;">
                        {{-- Badge jurusan --}}
                        <div style="margin-bottom:8px;">
                            <span style="background:#eff6ff;color:#2563eb;border:1px solid #bfdbfe;font-size:10px;font-weight:700;padding:2px 9px;border-radius:100px;">
                                {{ $artikel->jurusan->nama_jurusan ?? '-' }}
                            </span>
                        </div>

                        {{-- Judul --}}
                        <div style="font-family:'Syne',sans-serif;font-size:14.5px;font-weight:800;color:#0f172a;line-height:1.4;margin-bottom:8px;flex:1;">
                            {{ Str::limit($artikel->judul, 65) }}
                        </div>

                        {{-- Deskripsi --}}
                        <div style="font-size:12.5px;color:#64748b;line-height:1.6;margin-bottom:12px;">
                            {{ Str::limit($artikel->deskripsi, 100) }}
                        </div>

                        {{-- Meta --}}
                        <div style="display:flex;align-items:center;justify-content:space-between;padding-top:10px;border-top:1px solid #f1f5f9;">
                            <div style="font-size:11px;color:#94a3b8;">
                                {{ $artikel->created_at?->diffForHumans() }}
                            </div>
                            <div style="font-size:11px;color:#64748b;font-weight:600;">
                                {{ $artikel->creator->nama ?? '-' }}
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div style="margin-top:32px;display:flex;justify-content:center;">
                {{ $artikels->links() }}
            </div>
        @endif
    </div>
</section>

@endsection