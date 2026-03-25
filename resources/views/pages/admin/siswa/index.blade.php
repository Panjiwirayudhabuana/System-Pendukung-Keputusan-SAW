@extends('layouts.admin')
@section('title','Kelola Akun Siswa')
@section('content')

<div class="page-title-row">
    <div>
        <div class="page-title">👨‍🎓 Akun Siswa</div>
        <div class="page-subtitle">FR-A-05, FR-A-06 · Edit profil dan kredensial siswa</div>
    </div>
    <form method="GET" style="display:flex;gap:8px;">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari nama / email..."
            class="form-control-custom"
            style="width:240px;">
        <button type="submit" class="btn-custom btn-dark-custom">Cari</button>
    </form>
</div>

@if(session('success'))
<div class="flash-success">
    <span>✅ {{ session('success') }}</span>
    <button onclick="this.parentElement.remove()" style="background:none;border:none;cursor:pointer;color:#065f46;font-size:16px;">✕</button>
</div>
@endif

<div class="card-soft">
    <div style="overflow:hidden;">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Nama & Email</th>
                    <th>Sekolah Asal</th>
                    <th>Status</th>
                    <th>Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswas as $siswa)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:9px;">
                            <div class="tb-av" style="width:30px;height:30px;font-size:11px;flex-shrink:0;">
                                {{ strtoupper(substr($siswa->user->nama ?? 'S', 0, 1)) }}
                            </div>
                            <div>
                                <div style="font-weight:700;font-size:13px;color:var(--ink);">{{ $siswa->user->nama ?? '-' }}</div>
                                <div style="font-size:11px;color:var(--dim);">{{ $siswa->user->email ?? '-' }}</div>
                            </div>
                        </div>
                    </td>
                    <td style="font-size:12.5px;">{{ $siswa->sekolah_asal ?? '-' }}</td>
                    <td>
                        @if($siswa->user->is_active)
                            <span class="badge-custom badge-green">✅ Aktif</span>
                        @else
                            <span class="badge-custom badge-red">❌ Nonaktif</span>
                        @endif
                    </td>
                    <td style="font-size:11.5px;color:var(--dim);">{{ $siswa->created_at?->format('d M Y') ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="btn-custom btn-outline-blue">✏️ Edit</a>
                            <form method="POST" action="{{ route('admin.siswa.status', $siswa->id) }}" style="display:inline;">
                                @csrf @method('PATCH')
                                <button type="submit" class="btn-custom {{ $siswa->user->is_active ? 'btn-outline-red' : 'btn-outline-green' }}">
                                    {{ $siswa->user->is_active ? '🔴 Nonaktifkan' : '🟢 Aktifkan' }}
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:32px;text-align:center;color:var(--dim2);font-size:13px;">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:14px 16px;border-top:1px solid var(--border);">
        {{ $siswas->appends(request()->query())->links() }}
    </div>
</div>

@endsection