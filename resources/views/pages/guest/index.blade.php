<x-guest-layout title="Pendaftaran Magang">
    <div id="banner" style="background: url('/assets/img/hero-bg.png');">
        <div class="banner-body">
            <div data-aos="fade-up" class="order-last lg:order-first mx-4 mt-4 lg:m-0">
                <h1 style="color: #364146">Pendaftaran Magang</h1>
                <h2 style="color: #576971">Dinas Komunikasi, Informatika dan Persandian Kota Yogyakarta</h2>
                <a href="{{ route("pendaftaran-magang") }}" class="getting-starter">Daftar Sekarang</a>
            </div>
            <div data-aos="fade-left" class="order-first lg:order-last">
                <img class="logo" src="/assets/img/logo.webp"/>
            </div>
        </div>
    </div>

    <main>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/register.png"/>
            <div class="p-4">
                <h3 class="uppercase">Daftar Magang</h3>
                <p>Halaman pendaftaran magang mahasiswa pada instansi di seluruh Kota Yogyakarta.</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="{{ route("pendaftaran-magang") }}" class="btn-card">daftar</a>
            </div>
        </div>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/attention.png"/>
            <div class="p-4">
                <h3 class="uppercase">Pengumuman</h3>
                <p>Melihat hasil Pengumuman pendaftaran magang Dinas Koya Yogyakarta.</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="#" class="btn-card">Lihat Pengumuman</a>
            </div>
        </div>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/attendance.png"/>
            <div class="p-4">
                <h3 class="uppercase">Absensi</h3>
                <p>Melakukan penginputan dan pemantauan absen Magang Kota Yogyakarta.</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="{{ route("attendance") }}" class="btn-card">Lihat Absensi</a>
            </div>
        </div>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/progress.png"/>
            <div class="p-4">
                <h3 class="uppercase">Progres Projek</h3>
                <p>Melakukan Input dan melihat progres yang telah dilakukan dalam Magang Kota Yogyakarta.</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="{{ route("project") }}" class="btn-card">Lihat Progres</a>
            </div>
        </div>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/download.png"/>
            <div class="p-4">
                <h3 class="uppercase">Unduh Surat</h3>
                <p>Melakukan Pengunduhan Surat yang diperlukan pada Magang Kota Yogyakarta.</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="#" class="btn-card">Unduh Surat</a>
            </div>
        </div>
        <div class="border border-gray-300 rounded-md" style="max-width: 395px;">
            <img class="w-full" src="/assets/img/logo/download.png"/>
            <div class="p-4">
                <h3 class="uppercase">Kuota Magang</h3>
                <p>Daftar Kuota Magang di Setiap Dinas</p>
            </div>
            <div class="bg-gray-300 p-3 w-full flex">
                <a href="{{ route("quotaAgency") }}" class="btn-card">Lihat Kuota</a>
            </div>
        </div>
    </main>
</x-guest-layout>