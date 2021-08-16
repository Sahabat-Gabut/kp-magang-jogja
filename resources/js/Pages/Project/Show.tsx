import React, { useState } from 'react'
import AppLayout from '@/Components/templates/AppLayout';
import { InertiaLink, useForm } from '@inertiajs/inertia-react';
import Confirm from '@/Components/molecules/ConfirmDialog';
import route from 'ziggy-js';
import useTypedPage from "@/hooks/useTypedPage";
import {Project} from "@/types/models";

export default function ShowProject() {
    const { project, percentage } = useTypedPage<{project: Project; percentage: number}>().props;
    const [addOpen, setAddOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [edit, setEdit] = useState({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project.id,
    });
    const progressForm = useForm({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project.id
    });

    const { setData, post, put, data } = progressForm;

    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;

        setData(data => ({ ...data, [key]: value }));
        setEdit(values => ({ ...values, [key]: value }));
    };

    const _onClick = (apprentice_id: number, name: string, id: number, status: string) => {
        setEditOpen(true);
        setData({ id: id, name: name, apprentice_id: apprentice_id, status: status, project_id: project.id });
        setEdit({ id: id, name: name, apprentice_id: apprentice_id, status: status, project_id: project.id, });
    };

    return (
        <>
            <div className="relative my-5">
                <div className="flex items-center justify-between mb-2">
                    <div>
                        <span className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full">
                            {percentage}%
                        </span>
                    </div>
                    <div className="text-right">
                        <button onClick={() => setAddOpen(true)} className="px-4 py-1 border border-gray-300 rounded-lg">
                            Tambah Planning
                        </button>
                        <Confirm
                            title="Tambah Planning"
                            open={addOpen}
                            onClose={() => setAddOpen(false)}
                            onConfirm={() => post('/progress')}
                            confirmText="Simpan">

                            <label htmlFor="apprentice" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Penanggung Jawab</label>
                            <select
                                id="apprentice"
                                onChange={(e) => setData('apprentice_id', parseInt(e.target.value))}
                                className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                                <option value="">Pilih Penanggung Jawab</option>
                                {project.team.apprentices.map((apprentice, idx) => (
                                    <option key={idx} value={apprentice.id}>{apprentice.jss.fullname}</option>
                                ))}
                            </select>

                            <label htmlFor="progrees" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">planning</label>
                            <input id="progress"
                                onChange={(e) => { setData('name', e.target.value) }}
                                className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600" />

                            <label htmlFor="status" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Status</label>
                            <select
                                id="status"
                                onChange={(e) => setData('status', e.target.value)}
                                className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                                <option value="">Pilih Status</option>
                                <option value="PENGEMBANGAN">Pengembangan</option>
                                <option value="SELESAI">Selesai</option>
                            </select>

                        </Confirm>
                    </div>
                </div>
                <div className="flex h-2 mb-4 overflow-hidden text-xs bg-green-200 rounded">
                    <div style={{ width: `${percentage}%` }} className="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap"></div>
                </div>
                <div className="pt-4 mt-10 border-t-2">
                    <h4 className="mt-2 font-semibold text-gray-700 uppercase">peserta</h4>
                    <div className="flex">
                        <div className="flex items-center gap-4 mt-4 mr-4">
                            {project.team.apprentices.map((apprentice, idx) => (
                                <React.Fragment key={idx}>
                                    <img src={`/storage/${apprentice.photo}`} className="rounded-full h-14 w-14" />
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

            <div className="flex flex-col">
                <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50" style={{ maxHeight: '63vh' }} >
                            <table className="min-w-full">
                                <thead className="sticky top-0 bg-gray-50" style={{ zIndex: 2 }}>
                                    <tr>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Progress
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Penanggung Jawab
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Status
                                        </th>
                                        <th scope="col" className="relative px-6 py-3">
                                            <span className="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="text-sm font-light bg-white divide-y divide-gray-200">
                                    {project.progress.map(({ name, jss, id, status, apprentice_id }, key) => (
                                        <tr key={key} className="hover:bg-gray-50">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {name}
                                            </td>

                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="flex">
                                                    {jss.fullname}
                                                </div>
                                            </td>

                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {status}
                                            </td>

                                            <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                <div className="flex justify-end gap-2 rounded-lg" role="group">
                                                    <InertiaLink href={route('progress.show', id)} as="button" className="font-semibold text-gray-600 outline-none hover:text-gray-900 focus:outline-none">
                                                        Lihat
                                                    </InertiaLink>

                                                    <button onClick={() => _onClick(apprentice_id, name, id, status)} className="font-semibold text-yellow-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                        Ubah
                                                    </button>
                                                    <Confirm
                                                        title="Ubah Planning"
                                                        open={editOpen}
                                                        onClose={() => setEditOpen(false)}
                                                        onConfirm={() => put(`/progress/${data.id}`)}
                                                        confirmText="Ubah">

                                                        <label htmlFor="apprentice" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Penanggung Jawab</label>
                                                        <select
                                                            id="apprentice"
                                                            onChange={(e) => _onChange(e)}
                                                            name="apprentice_id"
                                                            value={edit.apprentice_id}
                                                            className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                                                            <option value="">Pilih Penanggung Jawab</option>
                                                            {project.team.apprentices.map((apprentice, idx) => (
                                                                <option key={idx} value={apprentice.id}>{apprentice.jss.fullname}</option>
                                                            ))}
                                                        </select>

                                                        <label htmlFor="progrees" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">planning</label>
                                                        <input id="progress"
                                                            onChange={(e) => _onChange(e)}
                                                            value={edit.name}
                                                            name="name"
                                                            className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600" />

                                                        <label htmlFor="status" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Status</label>
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

                                                    <button onClick={() => setDeleteOpen(true)} className="font-semibold text-red-600 outline-none hover:text-red-900 focus:outline-none">
                                                        Hapus
                                                    </button>
                                                    <Confirm
                                                        title="Hapus Planning"
                                                        open={deleteOpen}
                                                        onClose={() => setDeleteOpen(false)}
                                                        onConfirm={() => progressForm.delete(`/progress/${id}`)}
                                                        confirmText="Hapus Planning"
                                                        confirmClass="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                                                        <p className="text-sm">
                                                            Apakah kamu yakin ingin menghapus planning ini? Data yang sudah dihapus tidak akan bisa dikembalikan kembali.
                                                        </p>
                                                    </Confirm>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

ShowProject.layout = (children: React.ReactChild) => <AppLayout children={children} />
