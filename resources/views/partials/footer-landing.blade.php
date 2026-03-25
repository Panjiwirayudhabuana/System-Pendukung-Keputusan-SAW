<footer id="kontak" class="footer text-white pt-12 pb-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">

            {{-- KOLOM 1 --}}
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center font-bold text-sm">S2J</div>
                    <div>
                        <div class="font-bold text-sm">SMK Negeri 2 Jember</div>
                        <div class="text-blue-300 text-xs">Est. 1970</div>
                    </div>
                </div>
                <p class="text-blue-200 text-xs leading-relaxed mb-4">
                    Mencetak generasi kompeten, berkarakter, dan siap bersaing di era industri 4.0.
                </p>
                {{-- Sosial Media --}}
                <div class="flex gap-3">
                    <a href="https://facebook.com/smkn2jember" target="_blank"
                       class="w-8 h-8 rounded-lg bg-white/10 hover:bg-blue-600 flex items-center justify-center text-xs font-bold transition-colors" title="Facebook">
                        F
                    </a>
                    <a href="https://twitter.com/smkn2jember" target="_blank"
                       class="w-8 h-8 rounded-lg bg-white/10 hover:bg-sky-500 flex items-center justify-center text-xs font-bold transition-colors" title="Twitter">
                        T
                    </a>
                    <a href="https://instagram.com/smkn2jember" target="_blank"
                       class="w-8 h-8 rounded-lg bg-white/10 hover:bg-pink-500 flex items-center justify-center text-xs font-bold transition-colors" title="Instagram">
                        IG
                    </a>
                    <a href="https://youtube.com/@smkn2jember" target="_blank"
                       class="w-8 h-8 rounded-lg bg-white/10 hover:bg-red-600 flex items-center justify-center text-xs font-bold transition-colors" title="YouTube">
                        YT
                    </a>
                </div>
            </div>

            {{-- KOLOM 2 --}}
            <div>
                <h4 class="font-bold text-sm mb-4 text-amber-300">Tentang SMKN 2</h4>
                <ul class="space-y-2 text-xs text-blue-200">
                    <li><a href="{{ route('landing.home') }}#profil" class="hover:text-white transition-colors">Profil Sekolah</a></li>
                    <li><a href="{{ route('landing.home') }}#visi-misi" class="hover:text-white transition-colors">Visi & Misi</a></li>
                    <li><a href="{{ route('landing.home') }}#struktur" class="hover:text-white transition-colors">Struktur Organisasi</a></li>
                    <li><a href="{{ route('landing.home') }}#tenaga-pendidik" class="hover:text-white transition-colors">Tenaga Pendidik</a></li>
                    <li><a href="{{ route('landing.home') }}#fasilitas" class="hover:text-white transition-colors">Fasilitas Sekolah</a></li>
                    <li><a href="{{ route('landing.home') }}#prestasi" class="hover:text-white transition-colors">Prestasi</a></li>
                </ul>
            </div>

            {{-- KOLOM 3 --}}
            <div>
                <h4 class="font-bold text-sm mb-4 text-amber-300">Link Tautkan Kami</h4>
                <ul class="space-y-2 text-xs text-blue-200">
                    <li><a href="https://dindik.jatimprov.go.id" target="_blank" class="hover:text-white transition-colors">Dinas Pendidikan Jatim</a></li>
                    <li><a href="https://kemdikbud.go.id" target="_blank" class="hover:text-white transition-colors">Kemendikbud RI</a></li>
                    <li><a href="https://ppdb.jatimprov.go.id" target="_blank" class="hover:text-white transition-colors">PPDB Online Jatim</a></li>
                    <li><a href="https://snpmb.bppp.kemdikbud.go.id" target="_blank" class="hover:text-white transition-colors">LTMPT / SNBT</a></li>
                    <li><a href="{{ route('landing.home') }}#bursa-kerja" class="hover:text-white transition-colors">Bursa Kerja Khusus</a></li>
                </ul>
            </div>

            {{-- KOLOM 4 --}}
            <div>
                <h4 class="font-bold text-sm mb-4 text-amber-300">Informasi Kontak</h4>
                <ul class="space-y-3 text-xs text-blue-200">
                    <li class="flex gap-2">
                        <span>📍</span>
                        <a href="https://maps.google.com/?q=SMK+Negeri+2+Jember" target="_blank" class="hover:text-white transition-colors">
                            Jl. Tawangmangu No. 52, Jember, Jawa Timur 68121
                        </a>
                    </li>
                    <li class="flex gap-2">
                        <span>📞</span>
                        <a href="tel:+62331487550" class="hover:text-white transition-colors">(0331) 487550</a>
                    </li>
                    <li class="flex gap-2">
                        <span>✉️</span>
                        <a href="mailto:smkn2jember@gmail.com" class="hover:text-white transition-colors">smkn2jember@gmail.com</a>
                    </li>
                    <li class="flex gap-2">
                        <span>🌐</span>
                        <a href="https://www.smkn2jember.sch.id" target="_blank" class="hover:text-white transition-colors">www.smkn2jember.sch.id</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-white/10 pt-5 flex flex-col sm:flex-row justify-between items-center gap-2 text-xs text-blue-300">
            <span>© {{ date('Y') }} SMK Negeri 2 Jember. All Rights Reserved.</span>
            <span>Powered by <a href="{{ route('landing.home') }}" class="text-amber-300 hover:underline">Sistem SPK Pemilihan Jurusan</a></span>
        </div>
    </div>
</footer>