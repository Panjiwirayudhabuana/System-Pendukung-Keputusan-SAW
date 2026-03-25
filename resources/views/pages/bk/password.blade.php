@extends('layouts.bk')
@section('title','Ubah Password')
@section('page-title','Ubah Password')
@section('page-sub','FR-BK-02 · Keamanan akun')

@section('content')
@if(Auth::user()->must_change_password)
<div class="alert alert-warning">⚠️ Anda wajib mengganti password sebelum mengakses fitur lain. (FR-BK-02)</div>
@endif
<div class="card" style="padding:24px;max-width:460px;">
    <div style="font-family:'Playfair Display',serif;font-size:15px;font-weight:800;color:var(--primary-dark);margin-bottom:20px;">🔒 Ubah Password</div>
    <form method="POST" action="{{ route('bk.password.update') }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="form-label">Password Lama <span class="req">*</span></label>
            <input type="password" name="current_password" class="form-control" required/>
        </div>
        <div class="form-group">
            <label class="form-label">Password Baru <span class="req">*</span></label>
            <input type="password" name="password" id="pwd_baru" class="form-control" required oninput="chkPwd(this.value)"/>
            <div style="height:5px;background:var(--border);border-radius:100px;overflow:hidden;margin:8px 0 4px;">
                <div id="pwd-bar" style="height:100%;border-radius:100px;width:0;transition:all .4s;"></div>
            </div>
            <div id="pwd-hint" style="font-size:11px;color:var(--text-dim);">Masukkan password baru</div>
        </div>
        <div class="form-group">
            <label class="form-label">Konfirmasi Password <span class="req">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required oninput="chkMatch(this.value)"/>
            <div id="match-hint" style="font-size:11px;margin-top:5px;"></div>
        </div>
        <div class="form-actions">
            <button class="btn btn-primary">🔒 Ubah Password</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function chkPwd(v){
    let s=0;if(v.length>=8)s++;if(/[A-Z]/.test(v))s++;if(/[0-9]/.test(v))s++;if(/[^A-Za-z0-9]/.test(v))s++;
    const l=[{w:'0%',c:'#e2e8f0',t:''},{w:'25%',c:'#dc2626',t:'⚠ Lemah'},{w:'50%',c:'#d97706',t:'☑ Cukup'},{w:'75%',c:'#1a3c6e',t:'✅ Kuat'},{w:'100%',c:'#16a34a',t:'💪 Sangat Kuat'}];
    const i=v.length===0?0:s;
    document.getElementById('pwd-bar').style.cssText=`width:${l[i].w};background:${l[i].c};height:100%;border-radius:100px;transition:all .4s;`;
    document.getElementById('pwd-hint').textContent=l[i].t;
    document.getElementById('pwd-hint').style.color=l[i].c;
}
function chkMatch(v){
    const b=document.getElementById('pwd_baru').value;
    const h=document.getElementById('match-hint');
    if(!v)return;
    h.textContent=v===b?'✅ Password cocok':'❌ Tidak cocok';
    h.style.color=v===b?'#16a34a':'#dc2626';
}
</script>
@endpush
























