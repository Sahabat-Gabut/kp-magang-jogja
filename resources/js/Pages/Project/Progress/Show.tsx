import Confirm from '@/Components/molecules/ConfirmDialog';
import AppLayout from '@/Components/templates/AppLayout';
import { usePage } from '@/hooks/usePage';
import { PaperClipIcon } from '@heroicons/react/solid';
import { useForm } from '@inertiajs/inertia-react';
import React, { useState } from 'react'
import route from 'ziggy-js';

export default function ShowProgress() {
    // @ts-ignore
    const { title, progress, auth } = usePage().props;
    const [valuationOpen, setValuationOpen] = useState(false);

    const valuationForm = useForm({
        score: progress?.valuation?.score ? progress.valuation.score : '',
        description: progress?.valuation?.description ? progress.valuation.description : '',
        progress_project_id: progress.id
    });
    const { setData, post, put, data } = valuationForm;
    const _onConfirm = () => {
        progress?.valuation?.score ?
            put(route('valuation.update', progress.valuation.id))
            :
            post(route('valuation.store'))
    }

    return (
        <>
            <div className="flex justify-end w-full px-5 pt-5 mb-5">
                {progress.status === 'SELESAI' && auth.user?.admin && (
                    <button onClick={() => setValuationOpen(true)} type="button" className="px-5 py-1 mr-2 font-medium text-green-700 transform rounded-md cursor-pointer hover:red-800 focus:ring-1 focus:ring-green-600">
                        {progress?.valuation?.score ? 'Ubah Nilai' : 'Beri Nilai'}
                    </button>
                )}
                <div>
                    <Confirm
                        title="Penilaian"
                        open={valuationOpen}
                        onClose={() => setValuationOpen(false)}
                        onConfirm={_onConfirm}
                        confirmText="Beri Nilai">
                        <label htmlFor="score" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">nilai</label>
                        <input type="number" max="100" min="0" placeholder="0-100" id="score" value={data.score} onChange={(e) => { setData('score', e.target.value) }} className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 focus:ring-0" />

                        <label htmlFor="description" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Catatan</label>
                        <textarea id="description" onChange={(e) => setData('description', e.target.value)} className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 focus:ring-0" defaultValue={data.description}></textarea>

                    </Confirm>
                </div>
            </div>
            <div className="border-t border-gray-200">
                <dl>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Penanggung Jawab</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.jss.fullname}</dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Progress</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.name}</dd>
                    </div>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Deskripsi</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.description}</dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Status</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.status}</dd>
                    </div>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Nilai</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.valuation ? progress.valuation.score : 'BELUM DINILAI'}</dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Lampiran</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <ul className="border border-gray-200 divide-y divide-gray-200 rounded-md">
                                <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div className="flex items-center flex-1 w-0">
                                        <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400" aria-hidden="true" />
                                        <span className="flex-1 w-0 ml-2 truncate">resume_back_end_developer.pdf</span>
                                    </div>
                                    <div className="flex-shrink-0 ml-4">
                                        <a href="#" className="font-medium text-indigo-600 hover:text-indigo-500">
                                            Download
                                        </a>
                                    </div>
                                </li>
                                <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div className="flex items-center flex-1 w-0">
                                        <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400" aria-hidden="true" />
                                        <span className="flex-1 w-0 ml-2 truncate">coverletter_back_end_developer.pdf</span>
                                    </div>
                                    <div className="flex-shrink-0 ml-4">
                                        <a href="#" className="font-medium text-indigo-600 hover:text-indigo-500">
                                            Download
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </dd>
                    </div>
                </dl>
            </div>
            {/* <div className="grid grid-cols-1 gap-5 px-5 py-10 md:grid-cols-2">
                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Penanggung Jawab</h4>
                    <p className="font-thin">{progress.jss.fullname}</p>
                </div>
                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Nilai</h4>
                    <p className="font-thin">{progress.valuation ? progress.valuation.score : 'BELUM DINILAI'}</p>
                </div>
                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Deskripsi</h4>
                    <p className="font-thin">{progress.description}</p>
                </div>
                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Status</h4>
                    <p className="font-thin">{progress.status}</p>
                </div> */}

            {/* <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Tanggal Pengajuan</h4>
                    <p className="font-thin">
                        {moment(team.date_of_created).format('dddd Do MMMM YYYY')}
                    </p>
                </div>

                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Jurusan</h4>
                    <p className="font-thin">{team.departement}</p>
                </div>

                <div className="flex flex-col">
                    <h4 className="mb-2 font-semibold text-gray-800 uppercase">Status</h4>
                    <p className="font-thin">
                        {team.status === "SEDANG DIPROSES" || team.status === "DITERIMA" ? (
                            <span className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full">
                                {team.status}
                            </span>
                        ) : (
                            <span className="inline-block px-2 py-1 text-xs font-semibold text-red-600 uppercase bg-red-200 rounded-full">
                                {team.status}
                            </span>
                        )}
                    </p>
                </div> */}

            {/* </div> */}
        </>
    );
}

ShowProgress.layout = (page: React.ReactChild) => <AppLayout children={page} />;