import React, {ChangeEvent, useState} from 'react'
import AppLayout from '@/Layouts/AppLayout';
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import {Project} from "@/types/models";
import {DialogModal} from "@/Components/Dialog";
import {Input, Select} from "@/Components/Form";
import {SecondaryButton, SuccessButton} from "@/Components/Button";
import DangerButton from "../../Components/Button/DangerButton";
import {BsArrowLeftShort} from "react-icons/bs";

export default function ShowProject() {
    const route = useRoute();
    const {project, percentage} = useTypedPage<{ project: Project; percentage: number }>().props;
    const [progressID, setProgressID] = useState(0);
    const [addOpen, setAddOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [edit, setEdit] = useState({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project.id,
        link: ''
    });
    const form = useForm({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project.id,
        link: ''
    });

    const {setData, post, put, data} = form;

    const _onChange = (e: any) => {
        setData(data => ({...data, [e.target.name]: e.target.value}));
        setEdit(values => ({...values, [e.target.name]: e.target.value}));
    };

    const _onClick = (apprentice_id: number, name: string, id: number, status: string, link: string) => {
        setEditOpen(true);
        setData({id: id, name: name, apprentice_id: apprentice_id, status: status, project_id: project.id, link: link});
        setEdit({id: id, name: name, apprentice_id: apprentice_id, status: status, project_id: project.id, link: link});
    };

    const addProgress = () => {
        post(route('progress.store'), {
            preserveScroll: true,
            onSuccess: () => setAddOpen(false),
            onFinish: () => form.reset()
        });
    };

    const updateProgress = () => {
        put(route('progress.update', {id: data.id}), {
            preserveScroll: true,
            onSuccess: () => setEditOpen(false),
            onFinish: () => form.reset()
        });
    };

    const deleteProgress = () => {
        form.delete(route('progress.destroy', {id: progressID}), {
            preserveScroll: true,
            onFinish: () => setDeleteOpen(false),
        });
    };

    return (
        <>
            <div className="relative my-5">
                <div className="flex justify-between">
                    <InertiaLink href={route('project.index')} as="button"
                                 className="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition gap-2"><BsArrowLeftShort/>
                        kembali
                    </InertiaLink>
                    <div className={'flex gap-2'}>
                        <SecondaryButton onClick={() => setAddOpen(true)}>
                            Tambah Planning
                        </SecondaryButton>
                        <InertiaLink
                            href={route('showPDF', {id: project.id})}
                            className={'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition'}>
                            Ekspor
                        </InertiaLink>
                        {/*<SecondaryButton onClick={() => setAddOpen(true)}>*/}
                        {/*    Ekspor*/}
                        {/*</SecondaryButton>*/}
                    </div>
                </div>
                <div className="flex items-center justify-end mb-2 mt-5 border-t pt-5">
                    <span
                        className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full">
                        {percentage}%
                    </span>
                </div>
                <div className="flex h-2 mb-4 overflow-hidden text-xs bg-green-200 rounded">
                    <div style={{width: `${percentage}%`}}
                         className="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap"/>
                </div>
                <div className="pt-4 mt-5">
                    <h4 className="mt-2 font-semibold text-gray-700 uppercase">peserta</h4>
                    <div className="flex">
                        <div className="flex items-center gap-4 mt-4 mr-4">
                            {project.team.apprentices.map((apprentice, idx) => (
                                <React.Fragment key={idx}>
                                    <img src={`/storage/${apprentice.photo}`} className="rounded-full h-14 w-14"
                                         alt={apprentice.jss.username}/>
                                    <div className="flex flex-col ml-2">
                                        <span className="font-semibold">{apprentice.jss.fullname}</span>
                                        <span className="text-sm italic">{apprentice.jss_id}</span>
                                    </div>
                                </React.Fragment>
                            ))}
                        </div>
                    </div>
                </div>
                <div className="pt-4 mt-5">
                    <h4 className="mt-2 font-semibold text-gray-700 uppercase">Pembimbing Lapangan</h4>
                    <div className="flex">
                        <div className="flex items-center gap-4 mt-4 mr-4">
                            {project.team.admin.jss.fullname}
                        </div>
                    </div>
                </div>
            </div>
            <div className="flex flex-col shadow-md">
                <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div
                            className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50"
                            style={{maxHeight: '63vh'}}>
                            <table className="min-w-full">
                                <thead className="sticky top-0 bg-gray-50" style={{zIndex: 2}}>
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
                                {project.progress.map(({name, jss, id, status, apprentice_id, link}, key) => (
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
                                                <InertiaLink href={route('progress.show', {id: id})} as="button"
                                                             className="font-semibold text-gray-600 outline-none hover:text-gray-900 focus:outline-none">
                                                    Lihat
                                                </InertiaLink>

                                                <button
                                                    onClick={() => _onClick(apprentice_id, name, id, status, link ? link : '')}
                                                    className="font-semibold text-gray-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                    Ubah
                                                </button>

                                                <button onClick={() => {
                                                    setDeleteOpen(true);
                                                    setProgressID(id);
                                                }}
                                                        className="font-semibold text-gray-600 outline-none hover:text-red-900 focus:outline-none">
                                                    Hapus
                                                </button>
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

            {/* ADD PLANNING */}
            <DialogModal isOpen={addOpen} onClose={() => setAddOpen(false)}>
                <DialogModal.Content title={'Tambah Planning'}>
                    <Select name={'apprentice_id'}
                            label={'Penanggung Jawab'}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}>
                        <option value="">Pilih Penanggung Jawab</option>
                        {project.team.apprentices.map((apprentice, key) => (
                            <option key={key}
                                    value={apprentice.id}>{apprentice.jss.fullname}</option>
                        ))}
                    </Select>

                    <Input name={'name'}
                           label={'Planning'}
                           onChange={(e: ChangeEvent<HTMLInputElement>) => _onChange(e)}/>

                    <Select name={'status'}
                            label={'Status'}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}>
                        <option value="">Pilih Status</option>
                        <option value="PENGEMBANGAN">Pengembangan</option>
                        <option value="SELESAI">Selesai</option>
                    </Select>
                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setAddOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <SuccessButton onClick={addProgress} className={'ml-2'}>Tambah Planning</SuccessButton>
                </DialogModal.Footer>
            </DialogModal>

            {/* EDIT PROGRESS */}
            <DialogModal isOpen={editOpen} onClose={() => setEditOpen(false)}>
                <DialogModal.Content title={'Ubah Planning'}>
                    <Select name={'apprentice_id'}
                            label={'Penanggung Jawab'}
                            value={edit.apprentice_id}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}>
                        <option value="">Pilih Penanggung Jawab</option>
                        {project.team.apprentices.map((apprentice, key) => (
                            <option key={key}
                                    value={apprentice.id}>{apprentice.jss.fullname}</option>
                        ))}
                    </Select>

                    <Input name={'name'}
                           value={edit.name}
                           label={'Planning'}
                           onChange={(e: ChangeEvent<HTMLInputElement>) => _onChange(e)}/>

                    <Input name={'link'}
                           value={edit.link}
                           label={'Lampiran (LINK)'}
                           onChange={(e: ChangeEvent<HTMLInputElement>) => _onChange(e)}/>

                    <Select name={'status'}
                            label={'Status'}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}
                            value={edit.status}>
                        <option value="">Pilih Status</option>
                        <option value="PENGEMBANGAN">Pengembangan</option>
                        <option value="SELESAI">Selesai</option>
                    </Select>
                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setEditOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <SuccessButton onClick={updateProgress} className={'ml-2'}>Ubah Planning</SuccessButton>
                </DialogModal.Footer>
            </DialogModal>

            {/*/!* HAPUS PROGRESS *!/*/}
            <DialogModal isOpen={deleteOpen} onClose={() => setDeleteOpen(false)}>
                <DialogModal.Content title={'Hapus Planning'}>
                    Apakah kamu yakin ingin menghapus planning ini? Data yang sudah
                    dihapus tidak akan bisa dikembalikan kembali.
                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setDeleteOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <DangerButton
                        onClick={deleteProgress}
                        className={'ml-2'}>
                        Hapus Planning
                    </DangerButton>
                </DialogModal.Footer>
            </DialogModal>
        </>
    );
}

ShowProject.layout = (children: React.ReactChild) => <AppLayout children={children}/>
