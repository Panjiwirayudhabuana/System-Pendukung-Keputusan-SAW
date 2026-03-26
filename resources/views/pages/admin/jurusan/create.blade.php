@extends('layouts.admin')
@section('title', isset($jurusan) ? 'Edit Jurusan' : 'Tambah Jurusan')
@section('content')

<a href="{{ route('admin.jurusan.index') }}" class="back-link">← Kembali ke Daftar Jurusan</a>

<div class="page-title-row">
    <div>
        <div class="page-title">{{ isset($jurusan) ? '✏️ Edit Jurusan' : '➕ Tambah Jurusan' }}</div>
        <div class="page-subtitle">
            {{ isset($jurusan)
                ? 'Perbarui data jurusan beserta bobot setiap kriteria untuk perhitungan SPK metode SAW.'
                : 'Tambahkan jurusan baru beserta bobot setiap kriteria agar dapat langsung digunakan dalam perhitungan SPK metode SAW.' }}
        </div>
    </div>
</div>

<div class="form-card-custom">
    <form method="POST" action="{{ isset($jurusan) ? route('admin.jurusan.update', $jurusan->id) : route('admin.jurusan.store') }}">
        @csrf
        @if(isset($jurusan))
            @method('PUT')
        @endif

        {{-- Data Jurusan --}}
        <div style="margin-bottom:22px;">
            <p style="font-size:13px;font-weight:700;color:var(--text-dark);margin:0 0 14px 0;">Data Jurusan</p>

            <div style="margin-bottom:14px;">
                <label class="form-label-custom">Nama Jurusan *</label>
                <input
                    type="text"
                    name="nama_jurusan"
                    value="{{ old('nama_jurusan', $jurusan->nama_jurusan ?? '') }}"
                    placeholder="Contoh: Teknik Komputer dan Jaringan"
                    class="form-control-custom"
                >
                @error('nama_jurusan')
                    <div style="color:var(--red);font-size:11.5px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="form-label-custom">Status *</label>
                <div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:10px 16px;border:1.5px solid var(--border);border-radius:10px;flex:1;min-width:130px;font-size:13px;font-weight:600;color:var(--text-dark);">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $jurusan->is_active ?? 1) == 1 ? 'checked' : '' }}>
                        ✅ Aktif
                    </label>
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;padding:10px 16px;border:1.5px solid var(--border);border-radius:10px;flex:1;min-width:130px;font-size:13px;font-weight:600;color:var(--text-dark);">
                        <input type="radio" name="is_active" value="0" {{ old('is_active', $jurusan->is_active ?? 1) == 0 ? 'checked' : '' }}>
                        ❌ Nonaktif
                    </label>
                </div>
                @error('is_active')
                    <div style="color:var(--red);font-size:11.5px;margin-top:4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div style="border-top:1px solid var(--border);margin-bottom:22px;"></div>

        {{-- Bobot Kriteria --}}
        <div style="margin-bottom:6px;">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:12px;flex-wrap:wrap;margin-bottom:14px;">
                <div>
                    <p style="font-size:13px;font-weight:700;color:var(--text-dark);margin:0 0 4px 0;">Bobot Kriteria</p>
                    <p style="font-size:12px;color:var(--text-muted);margin:0;">Isi bobot setiap kriteria. Total bobot ideal adalah <strong>1.00</strong>.</p>
                </div>
                <div style="padding:10px 14px;border-radius:10px;background:#f8fafc;border:1px solid var(--border);">
                    <div style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--text-muted);margin-bottom:4px;">Total Bobot</div>
                    <div id="total-bobot" style="font-size:18px;font-weight:800;color:var(--text-dark);">0.00</div>
                </div>
            </div>

            @if ($errors->has('bobot') || $errors->has('bobot.*'))
                <div style="margin-bottom:12px;padding:10px 14px;border-radius:10px;background:var(--rbg);border:1px solid var(--rb);color:#b91c1c;font-size:12px;">
                    Terdapat kesalahan pada input bobot. Pastikan semua bobot telah diisi dengan benar.
                </div>
            @endif

            <div style="overflow-x:auto;border:1px solid var(--border);border-radius:12px;">
                <table class="table-custom" style="min-width:480px;">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Atribut</th>
                            <th style="width:160px;">Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kriterias as $kriteria)
                            @php
                                $defaultBobot = $bobotMap[$kriteria->id] ?? 0;
                                $nilaiBobot = old("bobot.{$kriteria->id}", $defaultBobot);
                            @endphp
                            <tr>
                                <td style="font-weight:700;font-size:12px;">{{ $kriteria->kode_kriteria }}</td>
                                <td>{{ $kriteria->nama_kriteria }}</td>
                                <td>
                                    @if($kriteria->atribut === 'benefit')
                                        <span class="badge-custom badge-green">benefit</span>
                                    @else
                                        <span class="badge-custom badge-red">cost</span>
                                    @endif
                                </td>
                                <td>
                                    <input
                                        type="number"
                                        name="bobot[{{ $kriteria->id }}]"
                                        value="{{ number_format((float)$nilaiBobot, 3) }}"
                                        step="0.001"
                                        min="0"
                                        max="1"
                                        class="bobot-input form-control-custom"
                                        placeholder="0.000"
                                        style="padding:8px 12px;"
                                    >
                                    @error("bobot.$kriteria->id")
                                        <div style="color:var(--red);font-size:11px;margin-top:4px;">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align:center;color:var(--text-muted);padding:24px;">
                                    Belum ada data kriteria aktif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div id="bobot-warning" style="display:none;margin-top:10px;" class="warn-box-custom">
                <div class="warn-title">⚠️ Total Belum 1.00</div>
                <div style="font-size:12px;color:#92400e;">Total bobot saat ini belum sama dengan <strong>1.00</strong>. Harap sesuaikan kembali.</div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions-custom">
            <a href="{{ route('admin.jurusan.index') }}" class="btn-custom btn-ghost-custom">Batal</a>
            <button type="submit" class="btn-custom btn-dark-custom">✓ Simpan</button>
        </div>
    </form>
</div>

<script>
    function hitungTotalBobot() {
        const inputs = document.querySelectorAll('.bobot-input');
        let total = 0;
        inputs.forEach(function(input) {
            const nilai = parseFloat(input.value);
            if (!isNaN(nilai)) total += nilai;
        });
        const totalEl = document.getElementById('total-bobot');
        const warningEl = document.getElementById('bobot-warning');
        totalEl.textContent = total.toFixed(3);
        if (Math.abs(total - 1) > 0.001) {
            totalEl.style.color = '#b45309';
            warningEl.style.display = 'block';
        } else {
            totalEl.style.color = 'var(--green)';
            warningEl.style.display = 'none';
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bobot-input').forEach(function(input) {
            input.addEventListener('input', hitungTotalBobot);
        });
        hitungTotalBobot();
    });
</script>

@endsection