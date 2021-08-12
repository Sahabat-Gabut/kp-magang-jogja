import React from 'react'
import MainCard from '@/Components/organisms/MainCard';
import { MainLayout } from '@/Components/templates';
import { InertiaLink } from '@inertiajs/inertia-react';
import route from 'ziggy-js';

export default function HomePage(){
    return(
    <>
        <div id="banner" className="pt-16 -mt-16" style={{background: 'url("/img/noisy_grid.png")'}}>
            <div className="container flex flex-col items-center justify-between max-w-screen-md py-6 mx-auto text-center lg:flex-row lg:text-left lg:max-w-screen-xl">
                <div data-aos="fade-up" className="order-last mx-4 mt-4 lg:order-first lg:m-0 aos-init aos-animate">
                    <h1 className="text-gray-700">Pendaftaran Magang</h1>
                    <h2 className="text-gray-500">Dinas Komunikasi, Informatika dan Persandian Kota Yogyakarta</h2>
                    <InertiaLink href={route('submission.create')} className="inline-block py-3 text-sm font-semibold text-gray-100 uppercase bg-green-600 rounded-md px-7 hover:bg-green-600">
                        Daftar Sekarang
                    </InertiaLink>
                </div>
                <div data-aos="fade-left" className="order-first lg:order-last aos-init aos-animate">
                    <img className="h-96" src="/img/logo.webp"/>
                </div>
            </div>
        </div>
        <div className="container flex flex-wrap items-center justify-between max-w-screen-xl px-0 py-6 mx-4 md:mx-auto md:grid md:grid-cols-2 md:gap-6 md:px-2 lg:grid-cols-3 lg:gap-6">
            <MainCard
                img="/img/logo/register.png"
                title="Daftar Magang"
                desc="Halaman pendaftaran magang mahasiswa pada instansi di seluruh Kota Yogyakarta."
                buttonLink={route('submission.create')}
                buttonText="Daftar" />

            <MainCard
                img="/img/logo/attention.png"
                title="Pengumuman"
                desc="Melihat hasil Pengumuman pendaftaran magang Dinas Koya Yogyakarta."
                buttonLink="/dashboard"
                buttonText="Lihat Pengumuman" />

            <MainCard
                img="/img/logo/attendance.png"
                title="Absensi"
                desc="Melakukan penginputan dan pemantauan absen Magang Kota Yogyakarta."
                buttonLink={route('attendance.index')}
                buttonText="Lihat Absensi" />

            <MainCard
                img="/img/logo/progress.png"
                title="Progres Projek"
                desc="Melakukan Input dan melihat progres yang telah dilakukan dalam Magang Kota Yogyakarta."
                buttonLink={route('project.index')}
                buttonText="Lihat Progres" />

            <MainCard
                img="/img/logo/download.png"
                title="Kuota Magang"
                desc="Daftar Kuota Magang di Setiap Dinas"
                buttonLink="/quota-agency"
                buttonText="Lihat Kuota" />

        </div>
    </>
    )
}
HomePage.layout = (page: React.ReactChild) => <MainLayout children={page} showFooter={false}/>;
