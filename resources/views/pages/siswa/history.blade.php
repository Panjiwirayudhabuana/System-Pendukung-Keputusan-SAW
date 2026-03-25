@extends('layouts.landing')

@section('title', 'History Tes - SMK Negeri 2 Jember')

@section('content')

{{-- Sembunyikan navbar seperti halaman tes --}}
<style>
    header, nav, .main-header, .top-bar, #mobile-menu, footer,
    .footer, [class*="navbar"], [class*="nav-bar"] {
        display: none !important;
    }
    main { padding-top: 0 !important; margin-top: 0 !important; }
    body  { padding-top: 0 !important; margin-top: 0 !important; }

    :root {
        --bg:       #0d0f14;
        --surface:  #161921;
        --surface2: #1e2330;
        --border:   #2a2f3e;
        --accent:   #f4b942;
        --text:     #e8eaf0;
        --text-dim: #8892aa;
        --green:    #5cb85c;
        --radius:   16px;
    }

    .history-wrapper {
        background: var(--bg);
        color: var(--text);
        font-family: 'DM Sans', sans-serif;
        min-height: 100vh;
        padding: 48px 20px 80px;
    }

    .history-container { max-width: 900px; margin: 0 auto; }

    .page-header { text-align: center; margin-bottom: 40px; }
    .header-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(244,185,66,.12); border: 1px solid rgba(244,185,66,.25);
        color: var(--accent); font-size: 11px; font-weight: 600; letter-spacing: .1em;
        text-transform: uppercase; padding: 6px 16px; border-radius: 100px; margin-bottom: 14px;
    }
    .page-title {
        font-size: 2rem; font-weight: 900;
        background: linear-gradient(135deg, #f4b942, #e8eaf0 60%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }

    .card {
        background: var(--surface); border: 1px solid var(--border);
        border-radius: var(--radius); overflow: hidden;
        box-shadow: 0 4px 40px rgba(0,0,0,.35); margin-bottom: 20px;
    }
    .card-header {
        background: linear-gradient(135deg, #0f1520, #1a2540);
        border-bottom: 1px solid var(--border); padding: 24px 30px;
    }
    .card-header h3 { font-size: 1.1rem; font-weight: 700; color: var(--text); }
    .card-header p  { font-size: 12px; color: var(--text-dim); margin-top: 4px; }

    table { width: 100%; border-collapse: collapse; }
    thead th {
        background: #1e2330; padding: 14px 20px;
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--text-dim); text-align: left;
    }
    tbody tr { border-bottom: 1px solid var(--border); transition: background .2s; }
    tbody tr:hover { background: rgba(244,185,66,.04); }
    tbody td { padding: 16px 20px; font-size: 13px; color: var(--text); vertical-align: middle; }

    .badge-jurusan {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(244,185,66,.15); color: var(--accent);
        font-size: 11px; font-weight: 700; padding: 5px 12px; border-radius: 100px;
        border: 1px solid rgba(244,185,66,.3);
    }

    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-state .icon { font-size: 4rem; margin-bottom: 16px; }
    .empty-state h3 { font-size: 1.2rem; font-weight: 700; color: var(--text); margin-bottom: 8px; }
    .empty-state p  { color: var(--text-dim); font-size: 13px; margin-bottom: 24px; }

    .btn-primary {
        display: inline-block; padding: 11px 26px; border-radius: 10px;
        background: linear-gradient(135deg, #f4b942, #e07b54);
        color: #111; font-weight: 700; font-size: 13px; text-decoration: none;
        transition: all .2s;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 26px rgba(244,185,66,.4); }

    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--text-dim); font-size: 13px; text-decoration: none;
        border: 1.5px solid var(--border); padding: 8px 16px; border-radius: 8px;
        margin-bottom: 24px; transition: all .2s;
    }
    .btn-back:hover { border-color: var(--accent); color: var(--accent); }

    /* ===== BUTTON AKSI ===== */
    .aksi-wrap {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-start;
    }
    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 12px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 12px;
        text-decoration: none;
        border: 1.5px solid var(--border);
        transition: all .2s ease;
        white-space: nowrap;
    }
    .btn-action:hover { transform: translateY(-1px); }

    .btn-view {
        background: rgba(92, 184, 92, .12);
        border-color: rgba(92, 184, 92, .35);
        color: #a8f0a8;
    }
    .btn-view:hover {
        border-color: rgba(92, 184, 92, .6);
        box-shadow: 0 10px 22px rgba(92,184,92,.15);
    }

    .btn-pdf {
        background: rgba(244,185,66,.12);
        border-color: rgba(244,185,66,.35);
        color: var(--accent);
    }
    .btn-pdf:hover {
        border-color: rgba(244,185,66,.6);
        box-shadow: 0 10px 22px rgba(244,185,66,.15);
    }

    .btn-disabled {
        opacity: .45;
        pointer-events: none;
        filter: grayscale(1);
    }
</style>

<div class="history-wrapper">
    <div class="history-container">

        {{-- Tombol kembali --}}
        <a href="{{ route('landingpage') }}" class="btn-back">← Kembali ke Dashboard</a>

        {{-- Header --}}
        <div class="page-header">
            <div class="header-badge">📋 Riwayat Tes</div>
            <h1 class="page-title">History Tes Minat Bakat</h1>
        </div>

        <div class="card">
            @if($histories->isEmpty())
                <div class="empty-state">
                    <div class="icon">📭</div>
                    <h3>Belum Ada Riwayat Tes</h3>
                    <p>Kamu belum pernah mengikuti tes minat bakat.<br>Yuk mulai sekarang!</p>
                    <a href="{{ route('siswa.tes.index') }}" class="btn-primary">🎯 Mulai Tes Sekarang</a>
                </div>
            @else
                <div class="card-header">
                    <h3>Riwayat Tes Kamu</h3>
                    <p>Total {{ $histories->total() }} kali tes</p>
                </div>

                <div style="overflow-x:auto">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Tes</th>
                                <th>Rekomendasi Jurusan</th>
                                <th>Nilai Tertinggi</th>
                                <th>Peringkat 1</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histories as $index => $tes)
                                @php
                                    $top = $tes->hasilSaw->sortBy('peringkat')->first();
                                    $pdfReady = $tes->tesPDF && $tes->tesPDF->upload;
                                @endphp
                                <tr>
                                    <td style="color:var(--text-dim)">
                                        {{ $histories->firstItem() + $index }}
                                    </td>

                                    <td>
                                        {{ $tes->created_at->format('d M Y') }}
                                        <span style="display:block;font-size:11px;color:var(--text-dim)">
                                            {{ $tes->created_at->format('H:i') }} WIB
                                        </span>
                                    </td>

                                    <td>
                                        @if($top && $top->jurusan)
                                            <span class="badge-jurusan">
                                                🏆 {{ $top->jurusan->nama_jurusan }}
                                            </span>
                                        @else
                                            <span style="color:var(--text-dim)">-</span>
                                        @endif
                                    </td>

                                    <td>{{ $top ? number_format($top->nilai_preferensi, 4) : '-' }}</td>
                                    <td>{{ $top ? '#'.$top->peringkat : '-' }}</td>

                                    <td>
                                        <div class="aksi-wrap">
                                            <a href="{{ route('siswa.tes.hasil.show', $tes->id) }}"
                                               class="btn-action btn-view">
                                                👁️ Lihat Hasil
                                            </a>

                                            <a href="{{ route('siswa.tes.pdf.download', $tes->id) }}"
                                               class="btn-action btn-pdf {{ $pdfReady ? '' : 'btn-disabled' }}"
                                               title="{{ $pdfReady ? 'Download PDF' : 'PDF belum tersedia' }}">
                                                📄 Download PDF
                                            </a>
                                        </div>

                                        @if(!$pdfReady)
                                            <div style="margin-top:6px;font-size:11px;color:var(--text-dim)">
                                                PDF belum tersedia untuk tes ini.
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($histories->hasPages())
                    <div style="padding: 20px 20px; border-top: 1px solid var(--border)">
                        {{ $histories->links() }}
                    </div>
                @endif
            @endif
        </div>

    </div>
</div>

@endsection