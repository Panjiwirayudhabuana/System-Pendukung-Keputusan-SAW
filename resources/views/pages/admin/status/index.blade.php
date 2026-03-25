@extends('layouts.admin')
@section('title','Status Akun')
@section('content')

<div class="page-title-row">
    <div>
        <div class="page-title">🔘 Status Siswa & Guru BK</div>
        <div class="page-subtitle">FR-A-07 · Aktifkan atau nonaktifkan akun untuk kontrol akses</div>
    </div>
</div>

@if(session('success'))
<div class="flash-success">
    <span>✅ {{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#065f46;font-size:16px;">✕</button>
</div>
@endif

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">

    {{-- GURU BK --}}
    <div class="card-soft">
        <div class="card-header-custom">
            <div class="card-title-custom">👩‍🏫 Guru BK</div>
            <span class="badge-custom badge-green">{{ $guruBks->total() }} data</span>
        </div>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($guruBks as $guru)
                <tr>
                    <td>
                        <div style="font-weight:600;font-size:12.5px;color:var(--ink);">{{ $guru->user->nama ?? '-' }}</div>
                        <div style="font-size:11px;color:var(--dim);">{{ $guru->jurusan->nama_jurusan ?? 'Belum ditentukan' }}</div>
                    </td>
                    <td>
                        @if($guru->user->is_active)
                            <span class="badge-custom badge-green">✅ Aktif</span>
                        @else
                            <span class="badge-custom badge-red">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.status.guru', $guru->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-custom {{ $guru->user->is_active ? 'btn-outline-red' : 'btn-outline-green' }}">
                                {{ $guru->user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:20px;text-align:center;color:var(--dim2);font-size:12px;">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 16px;border-top:1px solid var(--border);">
            {{ $guruBks->links() }}
        </div>
    </div>

    {{-- SISWA --}}
    <div class="card-soft">
        <div class="card-header-custom">
            <div class="card-title-custom">👨‍🎓 Siswa</div>
            <span class="badge-custom badge-blue">{{ $siswas->total() }} data</span>
        </div>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $siswa)
                <tr>
                    <td>
                        <div style="font-weight:600;font-size:12.5px;color:var(--ink);">{{ $siswa->user->nama ?? '-' }}</div>
                        <div style="font-size:11px;color:var(--dim);">{{ $siswa->sekolah_asal ?? '-' }}</div>
                    </td>
                    <td>
                        @if($siswa->user->is_active)
                            <span class="badge-custom badge-green">✅ Aktif</span>
                        @else
                            <span class="badge-custom badge-red">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.status.siswa', $siswa->id) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-custom {{ $siswa->user->is_active ? 'btn-outline-red' : 'btn-outline-green' }}">
                                {{ $siswa->user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding:20px;text-align:center;color:var(--dim2);font-size:12px;">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding:12px 16px;border-top:1px solid var(--border);">
            {{ $siswas->links() }}
        </div>
    </div>

</div>

@endsection