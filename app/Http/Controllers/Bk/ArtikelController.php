<?php

namespace App\Http\Controllers\Bk;

use App\Http\Controllers\Controller;
use App\Models\ArtikelJurusan;
use App\Models\Jurusan;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    public function index()
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        $artikels = ArtikelJurusan::with(['jurusan', 'gambarUpload', 'fileUpload'])
            ->where('created_by_user_id', Auth::id())
            ->latest()
            ->paginate(12);

        return view('pages.bk.artikel.index', compact('artikels'));
    }

    public function create()
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        $jurusans = $guruBk && $guruBk->jurusan_id
            ? \App\Models\Jurusan::where('id', $guruBk->jurusan_id)->get()
            : collect();

        return view('pages.bk.artikel.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        $request->validate([
            'jurusan_id' => [
                'required',
                'exists:jurusan,id',
                function ($attr, $value, $fail) use ($guruBk) {
                    if ($guruBk && $guruBk->jurusan_id && $value != $guruBk->jurusan_id) {
                        $fail('Anda hanya bisa membuat artikel untuk jurusan Anda sendiri.');
                    }
                }
            ],
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg|max:8192',
            'file'      => 'nullable|mimes:pdf,mp4|max:51200',
        ]);

        ArtikelJurusan::create([
            'jurusan_id'         => $guruBk->jurusan_id,
            'judul'              => $request->judul,
            'deskripsi'          => $request->deskripsi,
            'gambar_upload_id'   => $this->simpanUpload($request, 'gambar', 'artikel/gambar'),
            'file_upload_id'     => $this->simpanUpload($request, 'file', 'artikel/file'),
            'created_by_user_id' => Auth::id(),
        ]);

        return redirect()->route('bk.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = ArtikelJurusan::with(['jurusan', 'gambarUpload', 'fileUpload'])->findOrFail($id);

        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        $jurusans = $guruBk && $guruBk->jurusan_id
            ? Jurusan::where('id', $guruBk->jurusan_id)->get()
            : collect();

        return view('pages.bk.artikel.edit', compact('artikel', 'jurusans'));
    }

    public function update(Request $request, $id)
    {
        $artikel = ArtikelJurusan::findOrFail($id);

        $guruBk = \App\Models\GuruBk::where('user_id', Auth::id())->first();

        $request->validate([
            'jurusan_id' => [
                'required',
                'exists:jurusan,id',
                function ($attr, $value, $fail) use ($guruBk) {
                    if ($guruBk && $guruBk->jurusan_id && $value != $guruBk->jurusan_id) {
                        $fail('Anda hanya bisa mengubah artikel untuk jurusan Anda sendiri.');
                    }
                }
            ],
            'judul'     => 'required|string|max:200',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg|max:8192',
            'file'      => 'nullable|mimes:pdf,mp4|max:51200',
        ]);

        DB::transaction(function () use ($request, $artikel) {
            $oldGambarId = $artikel->gambar_upload_id;
            $oldFileId   = $artikel->file_upload_id;

            $data = [
                'jurusan_id' => $request->jurusan_id,
                'judul'      => $request->judul,
                'deskripsi'  => $request->deskripsi,
            ];

            if ($request->hasFile('gambar')) {
                $data['gambar_upload_id'] = $this->simpanUpload($request, 'gambar', 'artikel/gambar');
            }

            if ($request->hasFile('file')) {
                $data['file_upload_id'] = $this->simpanUpload($request, 'file', 'artikel/file');
            }

            $artikel->update($data);

            if ($request->hasFile('gambar') && $oldGambarId) {
                $this->hapusUpload($oldGambarId);
            }

            if ($request->hasFile('file') && $oldFileId) {
                $this->hapusUpload($oldFileId);
            }
        });

        return redirect()->route('bk.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = ArtikelJurusan::findOrFail($id);

        DB::transaction(function () use ($artikel) {
            $gambarId = $artikel->gambar_upload_id;
            $fileId   = $artikel->file_upload_id;

            $artikel->delete();

            if ($gambarId) {
                $this->hapusUpload($gambarId);
            }

            if ($fileId) {
                $this->hapusUpload($fileId);
            }
        });

        return redirect()->route('bk.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }

    private function simpanUpload(Request $request, string $input, string $folder): ?int
    {
        if (!$request->hasFile($input)) {
            return null;
        }

        $file = $request->file($input);
        $mime = $file->getMimeType();

        if (str_contains($mime, 'pdf')) {
            $ext = 'PDF';
        } elseif (str_contains($mime, 'mp4')) {
            $ext = 'MP4';
        } elseif (str_contains($mime, 'jpeg') || str_contains($mime, 'jpg')) {
            $ext = 'JPG';
        } else {
            $ext = strtoupper($file->getClientOriginalExtension() ?: 'FILE');
        }

        $upload = Upload::create([
            'uploader_user_id' => auth()->id(),
            'file_name'        => $file->getClientOriginalName(),
            'ext'              => $ext,
            'mime_type'        => $mime,
            'size_mb'          => round($file->getSize() / 1048576, 2),
            'storage_path'     => $file->store($folder, 'public'),
        ]);

        return $upload->id;
    }

    private function hapusUpload(?int $uploadId): void
    {
        if (!$uploadId) {
            return;
        }

        $u = Upload::find($uploadId);

        if (!$u) {
            return;
        }

        if ($u->storage_path && Storage::disk('public')->exists($u->storage_path)) {
            Storage::disk('public')->delete($u->storage_path);
        }

        $u->delete();
    }
}