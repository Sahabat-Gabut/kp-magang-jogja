import Confirm from '@/Components/Dialog/ConfirmDialog';
import AppLayout from '@/Layouts/AppLayout';
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import React, {useState} from 'react'
import route from 'ziggy-js';
import useTypedPage from "@/Hooks/useTypedPage";
import {ProgressProject} from "@/types/models";
import {BsArrowLeftShort} from "react-icons/bs";
import {SecondaryButton} from "@/Components/Button";

export default function ShowProgress() {

    const {title, progress, auth} = useTypedPage<{ progress: ProgressProject }>().props;
    const [valuationOpen, setValuationOpen] = useState(false);

    const valuationForm = useForm({
        score: progress?.valuation?.score ? progress.valuation.score : '',
        description: progress?.valuation?.description ? progress.valuation.description : '',
        progress_project_id: progress.id
    });
    const {setData, post, put, data} = valuationForm;
    const _onConfirm = () => {
        progress?.valuation?.score ?
            put(route('valuation.update', progress.valuation.id))
            :
            post(route('valuation.store'))
    }
    return (
        <>
            <div className="flex justify-between w-full pt-5 mb-5">
                <InertiaLink href={route('project.show', {id: progress.project_id})} as="button"
                             className="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition gap-2"><BsArrowLeftShort/>
                    kembali
                </InertiaLink>
                {progress.status === 'SELESAI' && auth.user?.admin && (
                    <SecondaryButton onClick={() => setValuationOpen(true)}>
                        {progress?.valuation?.score ? 'Ubah Nilai' : 'Beri Nilai'}
                    </SecondaryButton>
                )}
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
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{progress.link ?
                            <a className={'text-sky-500 hover:underline hover:text-sky-400'}
                               href={progress.link} target={'_blank'}>{progress.link}</a> : ''}</dd>
                    </div>
                </dl>
            </div>
            <Confirm
                title="Penilaian"
                open={valuationOpen}
                onClose={() => setValuationOpen(false)}
                onConfirm={_onConfirm}
                confirmText="Beri Nilai">
                <label htmlFor="score"
                       className="block pb-1 mt-2 text-sm font-semibold text-gray-600">nilai</label>
                <input type="number" max="100" min="0" placeholder="0-100" id="score" value={data.score}
                       onChange={(e) => {
                           setData('score', e.target.value)
                       }}
                       className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 focus:ring-0"/>

                <label htmlFor="description"
                       className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Catatan</label>
                <textarea id="description" onChange={(e) => setData('description', e.target.value)}
                          className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600 focus:ring-0"
                          defaultValue={data.description}/>

            </Confirm>
        </>
    );
}

ShowProgress.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
