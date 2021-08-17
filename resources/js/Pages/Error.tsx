import React from 'react'
//@ts-ignore
import {Head, InertiaLink} from '@inertiajs/inertia-react'

export default function ErrorPage({status}: { status: number }) {
    const description = {
        503: 'Layanan tidak tersedia',
        500: 'Server Error',
        404: 'Halaman tidak ditemukan',
        403: 'Terlarang',
    }[status];

    const message = {
        503: 'Maaf, kami sedang melakukan pemeliharaan. Silakan periksa kembali segera.',
        500: 'Ups, ada yang tidak beres di server kami.',
        404: 'Maaf, halaman yang anda cari tidak ditemukan.',
        403: 'Maaf, Anda dilarang mengakses halaman ini.',
    }[status];

    return (
        <div className="flex justify-center min-h-screen bg-white h-screen">
            <Head><title>{status.toString()}</title></Head>
            <div
                className="flex flex-col justify-between w-full min-h-screen bg-gradient-to-br from-green-700 via-green-900 to-green-800">
                <div className="flex p-5 lg:p-20">
                    <img className="h-11" src="/img/logo.webp" alt="magang dinas"/>
                    <div className="flex flex-col text-white">
                        <span className="ml-2 font-bold uppercase">magang dinas</span>
                        <span className="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
                    </div>
                </div>
                <div className="p-5 lg:p-20">
                    <div className="flex-1">
                        <div className="mb-4 leading-relaxed lg:leading-10">
                            <div className="text-2xl font-bold tracking-tighter text-white lg:text-4xl">
                                {description}
                            </div>
                            <div className="text-gray-200">
                                {message}
                            </div>
                        </div>
                        <button onClick={() => window.history.back()}
                                className="inline text-sm font-semibold text-white uppercase shadow-dark-down-strike">
                            Kembali
                        </button>
                    </div>
                </div>
                <div className="p-5 text-white lg:p-20">
                </div>
            </div>
        </div>
    )
}