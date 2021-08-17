import Pagination from '@/Components/molecules/Pagination';
import AppLayout from '@/Components/templates/AppLayout'
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import React, {useState} from 'react'
import useRoute from "@/Hooks/useRoute";
import Confirm from '@/Components/molecules/ConfirmDialog';
import SearchFilter from '@/Components/molecules/SearchFilter';
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Project} from "@/types/models";

export default function ProjectIndex() {
    const route = useRoute();
    const {data_paginate: projects, project, percentage, auth} = useTypedPage<{
        data_paginate: PaginatedData<Project>;
        percentage: number;
        project: Project;
    }>().props;
    const [editOpen, setEditOpen] = useState(false);
    const [edit, setEdit] = useState({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project?.id,
        fullname: ''
    });

    const progressForm = useForm({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project?.id
    });

    const {setData, put, data} = progressForm;

    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;

        setData(data => ({...data, [key]: value}));
        setEdit(values => ({...values, [key]: value}));
    };

    const _onClick = (apprentice_id: number, name: string, id: number, status: string, fullname: string) => {
        setEditOpen(true);
        setData({id: id, name: name, apprentice_id: apprentice_id, status: status, project_id: project.id});
        setEdit({
            id: id,
            name: name,
            apprentice_id: apprentice_id,
            status: status,
            project_id: project.id,
            fullname: fullname
        });
    };

    return (
        <>
            {!project ? (
                <>
                    <div className="mt-10 mb-5 rounded-lg ">
                        <SearchFilter/>
                    </div>
                    <div className="flex flex-col">
                        <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <div className="overflow-hidden border border-gray-200 rounded-lg">
                                    <table className="min-w-full divide-y divide-gray-200">
                                        <thead className="bg-gray-50">
                                        <tr>
                                            <th
                                                scope="col"
                                                className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Nama Projek
                                            </th>
                                            <th
                                                scope="col"
                                                className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                                Peserta
                                            </th>
                                            <th scope="col" className="relative px-6 py-3">
                                                <span className="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody className="text-sm font-light bg-white divide-y divide-gray-200">
                                        {projects.data.map(({name, team, id}, key) => (
                                            <tr key={key} className="hover:bg-gray-50">
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    {name}
                                                </td>

                                                <td className="flex px-6 py-4 whitespace-nowrap">
                                                    {team.apprentices.map((apprentice, idx) => (
                                                        <img key={idx}
                                                             className="w-6 h-6 mr-2 transform border border-gray-200 rounded-full cursor-pointer hover:scale-125"
                                                             src={`/storage/${apprentice?.photo}`}
                                                             alt={apprentice.jss.username}/>
                                                    ))}
                                                </td>

                                                <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                    <InertiaLink href={route('project.show', {id: id})}
                                                                 className="text-gray-600 hover:text-gray-900">
                                                        Detail
                                                    </InertiaLink>
                                                </td>
                                            </tr>
                                        ))}
                                        {projects.data.length === 0 && (
                                            <tr>
                                                <td className="w-full py-4 text-center bg-white" colSpan={3}>
                                                    data tidak tersedia!
                                                </td>
                                            </tr>
                                        )}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div className="">
                        <Pagination meta={projects.meta}/>
                    </div>
                </>
            ) : (
                <>
                    <div className="relative pt-1 mt-4">
                        <div className="flex items-center justify-between mb-2">
                            <div>
                                <span
                                    className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full">
                                    {percentage}%
                                </span>
                            </div>
                        </div>
                        <div className="flex h-2 mb-4 overflow-hidden text-xs bg-green-200 rounded">
                            <div style={{width: `${percentage}%`}}
                                 className="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap"/>
                        </div>
                        <div className="pt-4 mt-10 border-t-2">
                            <h4 className="mt-2 font-semibold text-gray-700 uppercase">peserta</h4>
                            <div className="flex">
                                <div className="flex items-center gap-4 mt-4 mr-4">
                                    {project.team.apprentices.map((apprentice, idx) => (
                                        <React.Fragment key={idx}>
                                            <img src={`/storage/${apprentice.photo}`}
                                                 className="rounded-full h-14 w-14" alt={apprentice.jss.username}/>
                                            <div className="flex flex-col ml-2">
                                                <span className="font-semibold">{apprentice.jss.fullname}</span>
                                                <span className="text-sm italic">{apprentice.jss_id}</span>
                                            </div>
                                        </React.Fragment>
                                    ))}
                                </div>
                            </div>
                        </div>
                        <div className="pt-4 mt-10 border-t-2">
                            <h4 className="mt-2 font-semibold text-gray-700 uppercase">Pembimbing Lapangan</h4>
                            <div className="flex">
                                <div className="flex items-center gap-4 mt-4 mr-4">
                                    {project.team.admin.jss.fullname}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="w-full mt-10 overflow-x-auto border border-gray-300 rounded-lg h-ful">
                        <table className="w-full h-full rounded-lg whitespace-nowrap">
                            <thead className="leading-normal border-b border-gray-300">
                            <tr className="flex w-full">
                                <th className="w-full px-5 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase">
                                    Progress
                                </th>
                                <th className="w-full px-5 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase">
                                    <span className="font-semibold text-gray-800">Penanggung Jawab</span>
                                </th>
                                <th className="w-full px-5 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase">
                                    <span className="font-semibold text-gray-800">Status</span>
                                </th>
                                <th className="w-1/4 px-5 py-4 text-xs font-semibold tracking-wider text-left text-gray-800 uppercase">
                                    <span className="font-semibold text-gray-800">Aksi</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody
                                className="flex flex-col items-center w-full overflow-y-auto text-sm font-light text-gray-800 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50"
                                style={{maxHeight: '39vh'}}>
                            {project.progress.map(({name, jss, id, status, apprentice_id}, idx) => {
                                return (
                                    <tr className="flex w-full border-b last:border-b-0 hover:bg-gray-50" key={idx}>
                                        <td className="w-full px-5 py-3 text-sm">
                                                <span className="font-semibold">
                                                    {name}
                                                </span>
                                        </td>
                                        <td className="flex items-center w-full px-5 py-3 text-sm">
                                                <span>
                                                    {jss.fullname}
                                                </span>
                                        </td>
                                        <td className="flex items-center w-full px-5 py-3 text-sm">
                                                <span>
                                                    {status === 'SELESAI' ? (
                                                        <span
                                                            className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full group-hover:shadow">
                                                            {status}
                                                        </span>
                                                    ) : (
                                                        <span
                                                            className="inline-block px-2 py-1 text-xs font-semibold text-gray-600 uppercase bg-gray-200 rounded-full group-hover:shadow">
                                                            {status}
                                                        </span>
                                                    )}
                                                </span>
                                        </td>
                                        <td className="w-1/4 px-5 py-2">
                                            <div className="flex justify-center text-lg rounded-lg" role="group">
                                                <InertiaLink href={route('progress.show', {id: id})} as="button"
                                                             className="px-4 py-2 mx-0 text-gray-600 bg-white border border-r-0 border-gray-300 outline-none hover:bg-green-200 hover:text-green-600 rounded-l-md">
                                                    <svg className="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                              strokeWidth="2"
                                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                              strokeWidth="2"
                                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </InertiaLink>

                                                <button
                                                    onClick={() => _onClick(apprentice_id, name, id, status, jss.fullname)}
                                                    className={`px-4 py-2 mx-0 text-gray-600 bg-white border border-l-0 border-gray-300 outline-none rounded-r-md ${apprentice_id !== auth.user?.apprentice.id ? 'cursor-not-allowed hover:bg-gray-200' : 'hover:bg-yellow-200 hover:text-yellow-600'}`}
                                                    disabled={apprentice_id !== auth.user?.apprentice.id}>
                                                    <svg className="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                         fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path strokeLinecap="round" strokeLinejoin="round"
                                                              strokeWidth="2"
                                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                </button>
                                                <Confirm
                                                    title="Ubah Planning"
                                                    open={editOpen}
                                                    onClose={() => setEditOpen(false)}
                                                    onConfirm={() => put(`/progress/${data.id}`)}
                                                    confirmText="Ubah">

                                                    <label htmlFor="apprentice"
                                                           className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Penanggung
                                                        Jawab</label>
                                                    <input id="apprentice"
                                                           onChange={(e) => _onChange(e)}
                                                           value={edit.fullname}
                                                           name="name"
                                                           readOnly
                                                           className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none bg-gray-50 focus:border-0"/>

                                                    <label htmlFor="progrees"
                                                           className="block pb-1 mt-2 text-sm font-semibold text-gray-600">planning</label>
                                                    <input id="progress"
                                                           onChange={(e) => _onChange(e)}
                                                           value={edit.name}
                                                           name="name"
                                                           className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>

                                                    <input
                                                        value={edit.apprentice_id}
                                                        name="apprentice_id"
                                                        hidden
                                                        onChange={() => {
                                                        }}
                                                        className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>

                                                    <label htmlFor="status"
                                                           className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Status</label>
                                                    <select
                                                        id="status"
                                                        onChange={(e) => _onChange(e)}
                                                        value={edit.status}
                                                        name="status"
                                                        className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                                                        <option value="">Pilih Status</option>
                                                        <option value="PENGEMBANGAN">Pengembangan</option>
                                                        <option value="SELESAI">Selesai</option>
                                                    </select>

                                                </Confirm>
                                            </div>
                                        </td>
                                    </tr>
                                )
                            })}
                            </tbody>
                        </table>
                    </div>
                </>
            )}
        </>
    )
}

ProjectIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
