import AppLayout from '@/Components/templates/AppLayout';
import React, {useState} from 'react'
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import moment from 'moment-timezone';
import Confirm from '@/Components/molecules/ConfirmDialog';
import route from 'ziggy-js';
import {PaperClipIcon} from '@heroicons/react/solid';
import {BsArrowLeftShort} from "react-icons/bs"
import useTypedPage from "@/Hooks/useTypedPage";
import {Admin, Team} from "@/types/models";

export default function ShowSubmission() {
    const {team, admins} = useTypedPage<{ team: Team, admins: Admin[] }>().props;
    const [confirmOpen, setConfirmOpen] = useState(false);
    const [confProjectOpen, setConfProjectOpen] = useState(false);

    const rejectForm = useForm({});
    const projectForm = useForm({
        name: '',
        description: '',
        admin_id: '',
        team_id: team.id
    });

    const reject = () => {
        rejectForm.put(`/submission/${team.id}/DITOLAK`);
    }

    const {setData} = projectForm;

    const insertProject = () => {
        projectForm.post(route('project.store'));
    }

    return (
        <>
            <div className="flex items-center justify-between w-full my-5">
                <div>
                    <InertiaLink href={route('submission.index')} as="button"
                                 className="flex items-center gap-2"><BsArrowLeftShort/> kembali</InertiaLink>
                </div>
                <div className="flex">
                    {team.status === 'DITERIMA' ? (
                        <>
                            <button onClick={() => setConfirmOpen(true)} type="button"
                                    className="px-5 py-1 mr-2 font-medium text-red-700 transform rounded-md cursor-pointer hover:red-800 focus:ring-1 focus:ring-red-600">
                                Batalkan Persetujuan
                            </button>
                            <div>
                                <Confirm
                                    title="Apakah anda yakin?"
                                    open={confirmOpen}
                                    onClose={() => setConfirmOpen(false)}
                                    onConfirm={reject}
                                    confirmText="Ya, saya yakin"
                                    confirmClass="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                                    apakah anda yakin ingin membatalkan persetujuan tim ini?
                                </Confirm>
                            </div>
                            {!team.project && (
                                <>
                                    <button onClick={() => setConfProjectOpen(true)} type="button"
                                            className="px-5 py-1 mr-2 font-medium text-gray-600 transform bg-white border border-gray-300 rounded-md cursor-pointer hover:bg-gray-100 hover:text-gray-600 focus:ring-1 focus:ring-gray-300">
                                        Atur Projek
                                    </button>
                                    <div>
                                        <Confirm
                                            title="Atur Projek"
                                            open={confProjectOpen}
                                            onClose={() => setConfProjectOpen(false)}
                                            onConfirm={() => {
                                                insertProject()
                                            }}
                                            confirmText="Simpan">

                                            <label htmlFor="projectName"
                                                   className="block pb-1 mt-2 text-sm font-semibold text-gray-600">nama
                                                projek</label>
                                            <input id="projectName" onChange={(e) => {
                                                setData('name', e.target.value)
                                            }}
                                                   className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>

                                            <label htmlFor="projectDesc"
                                                   className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Deskripsi
                                                projek</label>
                                            <textarea id="projectDesc"
                                                      onChange={(e) => setData('description', e.target.value)}
                                                      className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"></textarea>

                                            <label htmlFor="projectDesc"
                                                   className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Pembimbing
                                                lapangan</label>
                                            <select onChange={(e) => setData('admin_id', e.target.value)}
                                                    className="block w-full h-full px-4 py-2 pr-8 leading-tight text-gray-700 bg-white border border-gray-300 rounded appearance-none cursor-pointer focus:ring-0 focus:border-gray-300 focus:outline-none focus:bg-white">
                                                <option value=""></option>
                                                {admins.map((admin, idx) => (
                                                    <option key={idx} value={admin.id}>{admin.jss.fullname}</option>
                                                ))}
                                            </select>

                                        </Confirm>
                                    </div>
                                </>
                            )}
                        </>
                    ) : (
                        team.status === 'DITOLAK' ? (
                            <InertiaLink href={`/submission/${team.id}/DITERIMA`} method="put" as="button" type="button"
                                         className="px-5 py-1 mr-2 font-medium text-green-900 transform bg-green-300 rounded-md cursor-pointer hover:bg-green-400 focus:ring-1 focus:ring-green-600">
                                Terima
                            </InertiaLink>
                        ) : (
                            <>
                                <InertiaLink href={`/submission/${team.id}/DITOLAK`} method="put" as="button"
                                             type="button"
                                             className="px-5 py-1 mr-2 font-medium text-red-700 transform bg-red-300 rounded-md cursor-pointer hover:bg-red-400 focus:ring-1 focus:ring-red-600">
                                    Tolak
                                </InertiaLink>
                                <InertiaLink href={`/submission/${team.id}/DITERIMA`} method="put" as="button"
                                             type="button"
                                             className="px-5 py-1 mr-2 font-medium text-green-900 transform bg-green-300 rounded-md cursor-pointer hover:bg-green-400 focus:ring-1 focus:ring-green-600">
                                    Terima
                                </InertiaLink>
                            </>

                        )
                    )}
                </div>
            </div>

            <div className="border-t border-gray-200">
                <dl>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Status</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {team.status === "SEDANG DIPROSES" || team.status === "DITERIMA" ? (
                                <span
                                    className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full">
                                    {team.status}
                                </span>
                            ) : (
                                <span
                                    className="inline-block px-2 py-1 text-xs font-semibold text-red-600 uppercase bg-red-200 rounded-full">
                                    {team.status}
                                </span>
                            )}
                        </dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Dinas yang dituju</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.agency.name}</dd>
                    </div>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Universitas</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.university}</dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Jurusan</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{team.department}</dd>
                    </div>
                    <div className="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Tanggal Pengajuan</dt>
                        <dd className="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{moment(team.date_of_created).format('dddd Do MMMM YYYY')}</dd>
                    </div>
                    <div className="px-4 py-5 bg-white sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt className="text-sm font-medium text-gray-500">Peserta</dt>
                        <dd className="flex gap-5 mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {team.apprentices.map((apprentice, idx) => (
                                <div className="flex gap-2" key={idx}>
                                    <img className="w-10 h-10 transform border border-gray-200 rounded-md"
                                         src={`/storage/${apprentice.photo}`}/>
                                    <div className="flex flex-col">
                                        <span className="font-semibold text-gray-700">{apprentice.jss.fullname}</span>
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
                                <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
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
                                <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
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
                                <li className="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <div className="flex items-center flex-1 w-0">
                                        <PaperClipIcon className="flex-shrink-0 w-5 h-5 text-gray-400"
                                                       aria-hidden="true"/>
                                        <a href={`/storage/${team.presentation}`} target="_blank"
                                           className="flex-1 w-0 ml-2 truncate">Presentasi yang akan diajukan.ppt</a>
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
        </ >
    );

}

ShowSubmission.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
