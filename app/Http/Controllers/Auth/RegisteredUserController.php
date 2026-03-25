<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Role;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:120',
            'email' => 'required|string|lowercase|email|max:191|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
            'sekolah_asal' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'no_telepon' => 'required|string|max:30',
            'alamat' => 'required|string',
        ]);

        // role siswa harus ada (sesuai ketentuan)
        $roleSiswa = Role::where('nama_role', 'siswa')->firstOrFail();
        $roleId = $roleSiswa->role_id ?? $roleSiswa->id; // aman untuk variasi PK roles

        DB::transaction(function () use ($validated, $roleId) {
            $user = User::create([
                'role_id' => $roleId,
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password_hash' => Hash::make($validated['password']),
                'is_active' => true,
                'must_change_password' => false,
            ]);

            $userPk = $user->user_id ?? $user->id; // aman untuk variasi PK users

            Siswa::create([
                'user_id' => $userPk,
                'sekolah_asal' => $validated['sekolah_asal'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'no_telepon' => $validated['no_telepon'],
                'alamat' => $validated['alamat'],
            ]);
        });

        // Breeze biasanya auto-login setelah register,
        // tapi kebutuhan Anda: boleh auto-login atau redirect login.
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }
}
