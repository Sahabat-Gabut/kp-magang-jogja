import React from 'react';
import {useRoute, useTypedPage} from "@/Hooks";
import {InertiaLink} from "@inertiajs/inertia-react";
import {SuccessButton} from "@/Components/Button";
import {MdKeyboardArrowLeft} from "react-icons/md";
import moment from "moment-timezone";
import {PaperClipIcon} from "@heroicons/react/solid";
import ReactToPrint from "react-to-print";

export default function generatePDF() {
    const route = useRoute();
    const {team} = useTypedPage().props;
    const componentRef = React.useRef<HTMLDivElement>(null);

    return (
        <div className={'bg-gray-100 min-h-screen'}>
            <div className="max-w-screen-lg mx-auto px-4 py-4">
                <div>
                    <div className="mb-4 text-right flex gap-2 justify-end">
                        <InertiaLink
                            href={route('project.show', {id: team.project.id})}
                            className={'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition'}>
                            <MdKeyboardArrowLeft/>
                            Kembali
                        </InertiaLink>
                        <ReactToPrint
                            documentTitle={team.project.name}
                            trigger={() => <SuccessButton className={'flex gap-2'}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     className="mr-2" viewBox="0 0 16 16">
                                    <path
                                        d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                    <path
                                        d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                </svg>

                                Print
                            </SuccessButton>}
                            content={() => componentRef.current}
                        />

                    </div>
                </div>
                <div ref={componentRef} className="shadow-lg print:shadow-none bg-white p-16 min-h-screen">
                    <div className="grid grid-cols-2 mb-10">
                        <div>
                            <InertiaLink className="flex items-center flex-shrink-0 mr-8 font-medium focus:outline-none"
                                         href="/">
                                <img className="h-11" src="/img/logo.webp" alt="magang dinas"/>
                                <div className="flex flex-col">
                                    <span className="ml-2 font-bold uppercase">magang dinas</span>
                                    <span className="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
                                </div>
                            </InertiaLink>
                        </div>
                    </div>
                    <div className={'mb-5'}>
                        <h1 className={'font-black text-xl mb-0'}>Rekap Projek</h1>
                        <span>{team.project.name}</span>
                    </div>

                    <div className={'mb-5'}>
                        <h1 className={'font-black text-lg mb-0'}>Informasi Tim</h1>
                        <div className="border-t border-gray-200">
                            <dl>
                                <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Tanggal Pengajuan</dt>
                                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{moment(team.date_start).format('dddd Do MMMM YYYY')}</dd>
                                </div>
                                <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Rencana Selesai</dt>
                                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{moment(team.date_finish).format('dddd Do MMMM YYYY')}</dd>
                                </div>
                                <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Dinas</dt>
                                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.agency.name}</dd>
                                </div>
                                <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Universitas</dt>
                                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.university}</dd>
                                </div>
                                {/*<div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">*/}
                                {/*    <dt className="text-sm font-medium text-gray-500">Jurusan</dt>*/}
                                {/*    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.department}</dd>*/}
                                {/*</div>*/}

                                <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Peserta</dt>
                                    <dd className="flex gap-5 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {team.apprentices.map((apprentice, idx) => (
                                            <div className="flex gap-2" key={idx}>
                                                <img className="w-10 h-10 transform border border-gray-200 rounded-md"
                                                     src={`/storage/${apprentice.photo}`}
                                                     alt={apprentice.jss.username}/>
                                                <div className="flex flex-col">
                                                    <span
                                                        className="font-semibold text-gray-700">{apprentice.jss.fullname}</span>
                                                    <span className="italic font-thin">{apprentice.jss.id}</span>
                                                </div>
                                            </div>
                                        ))}
                                    </dd>
                                </div>
                                <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt className="text-sm font-medium text-gray-500">Lampiran</dt>
                                    <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        <ul className="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                            <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm hover:bg-gray-50">
                                                <div className="flex items-center flex-1 w-0">
                                                    <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400"
                                                                   aria-hidden="true"/>
                                                    <a href={`/storage/${team.proposal}`} target="_blank"
                                                       className="flex-1 w-0 ml-2 truncate">Proposal.pdf</a>
                                                </div>
                                                <div className="flex-shrink-0 ml-4">
                                                    <a href={`/storage/${team.proposal}`} download
                                                       className="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Download
                                                    </a>
                                                </div>
                                            </li>
                                            <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm hover:bg-gray-50">
                                                <div className="flex items-center flex-1 w-0">
                                                    <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400"
                                                                   aria-hidden="true"/>
                                                    <a href={`/storage/${team.cover_letter}`} target="_blank"
                                                       className="flex-1 w-0 ml-2 truncate">Surat Pengantar.pdf</a>
                                                </div>
                                                <div className="flex-shrink-0 ml-4">
                                                    <a href={`/storage/${team.cover_letter}`} download
                                                       className="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Download
                                                    </a>
                                                </div>
                                            </li>
                                            <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm hover:bg-gray-50">
                                                <div className="flex items-center flex-1 w-0">
                                                    <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400"
                                                                   aria-hidden="true"/>
                                                    <a href={`/storage/${team.presentation}`} target="_blank"
                                                       className="flex-1 w-0 ml-2 truncate">Presentasi yang akan
                                                        diajukan.ppt</a>
                                                </div>
                                                <div className="flex-shrink-0 ml-4">
                                                    <a href={`/storage/${team.presentation}`} download
                                                       className="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Download
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <div className={'mb-5'}>
                        <h1 className={'font-black text-lg mb-0'}>Pembimbing Lapangan</h1>
                        <div className={'flex gap-2 mt-2'}>
                            {team.admin.photo && (
                                <img className="w-10 h-10 transform border border-gray-200 rounded-md"
                                     src={`/storage/${team.admin.photo}`}
                                     alt={'#'}/>
                            )}
                            <div className="flex flex-col">
                                <span className="font-semibold text-gray-700">{team.admin.jss.fullname}</span>
                                <span className="italic font-thin">{team.admin.jss.id}</span>
                            </div>
                        </div>
                    </div>

                    {/*<div className={'mb-5'}>*/}
                    {/*    <h1 className={'font-black text-lg mb-0'}>Peserta</h1>*/}
                    {/*    <div className={'flex gap-5 mt-2'}>*/}
                    {/*        {team.apprentices.map((apprentice, key) => (*/}
                    {/*            <div key={key} className={'flex gap-2'}>*/}
                    {/*                <img src={`/storage/${apprentice.photo}`} className="rounded-lg h-14 w-14"*/}
                    {/*                     alt={apprentice.jss.username}/>*/}
                    {/*                <div className="flex flex-col ml-2">*/}
                    {/*                    <span className="font-semibold">{apprentice.jss.fullname}</span>*/}
                    {/*                    <span className="text-sm italic">{apprentice.jss_id}</span>*/}
                    {/*                </div>*/}
                    {/*            </div>*/}
                    {/*        ))}*/}
                    {/*    </div>*/}
                    {/*</div>*/}

                    <div className="overflow-x-auto rounded-lg shadow-sm border dark:border-gray-800">
                        <table className="w-full">
                            <thead>
                            <tr className="text-left border-b dark:border-gray-800">
                                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Progress</th>
                                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Penangung
                                    Jawab
                                </th>
                                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            {team.project.progress.map((progress, key) => (
                                <tr key={key}
                                    className="border-b dark:border-gray-800 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-1000">
                                    <td className="undefined text-sm px-4 py-3"><strong
                                        className="capitalize font-semibold">{progress.name}</strong></td>
                                    <td className="undefined text-sm px-4 py-3"><span
                                        className="capitalize">{progress.jss.fullname}</span>
                                    </td>
                                    <td className="undefined text-sm px-4 py-3">{
                                        progress.status === 'SELESAI' ? <span
                                                className={'text-emerald-500 text-xs uppercase font-semibold'}>SELESAI</span>
                                            : <span>DALAM PENGEMBANGAN</span>
                                    }</td>
                                </tr>
                            ))}
                            </tbody>
                        </table>
                    </div>
                    {/*<div className={'my-5'}>*/}
                    {/*    <h1 className={'font-black text-lg mb-2'}>Presentase Kehadiran</h1>*/}
                    {/*    <div className="overflow-x-auto rounded-lg shadow-sm border dark:border-gray-800">*/}
                    {/*        <table className="w-full">*/}
                    {/*            <thead>*/}
                    {/*            <tr className="text-left border-b dark:border-gray-800">*/}
                    {/*                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Peserta</th>*/}
                    {/*                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">*/}
                    {/*                    Hadir*/}
                    {/*                </th>*/}
                    {/*                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Izin</th>*/}
                    {/*                <th className="undefined font-medium whitespace-nowrap text-sm px-4 py-3">Sakit</th>*/}
                    {/*            </tr>*/}
                    {/*            </thead>*/}
                    {/*            <tbody>*/}
                    {/*            {team.project.progress.map((progress, key) => (*/}
                    {/*                <tr key={key}*/}
                    {/*                    className="border-b dark:border-gray-800 last:border-b-0 hover:bg-gray-50 dark:hover:bg-gray-1000">*/}
                    {/*                    <td className="undefined text-sm px-4 py-3"><strong*/}
                    {/*                        className="capitalize font-semibold">{progress.name}</strong></td>*/}
                    {/*                    <td className="undefined text-sm px-4 py-3"><span*/}
                    {/*                        className="capitalize">{progress.jss.fullname}</span>*/}
                    {/*                    </td>*/}
                    {/*                    <td className="undefined text-sm px-4 py-3">{*/}
                    {/*                        progress.status === 'SELESAI' ? <span*/}
                    {/*                                className={'text-emerald-500 text-xs uppercase font-semibold'}>SELESAI</span>*/}
                    {/*                            : <span>DALAM PENGEMBANGAN</span>*/}
                    {/*                    }</td>*/}
                    {/*                </tr>*/}
                    {/*            ))}*/}
                    {/*            </tbody>*/}
                    {/*        </table>*/}
                    {/*    </div>*/}
                    {/*</div>*/}


                </div>

            </div>
        </div>
    )
};