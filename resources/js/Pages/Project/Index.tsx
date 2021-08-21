import Pagination from '@/Components/Pagination';
import AppLayout from '@/Layouts/AppLayout'
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import React, {useState} from 'react'
import useRoute from "@/Hooks/useRoute";
import {Input, SearchFilter, Select} from '@/Components/Form';
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Project} from "@/types/models";
import Table from "@/Components/Table";
import {DialogModal} from "@/Components/Dialog";
import {SecondaryButton, SuccessButton} from "@/Components/Button";
import {IoIosArrowForward} from "react-icons/io";

export default function ProjectIndex() {
    const route = useRoute();
    const {data_paginate: projects, project, percentage, auth, title} = useTypedPage<{
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

    const form = useForm({
        id: 0,
        name: '',
        apprentice_id: 0,
        status: '',
        project_id: project?.id
    });

    const {setData, put, data} = form;

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

    const updateProject = () => {
        put(`/progress/${data.id}`, {
            preserveScroll: true,
            onSuccess: () => setEditOpen(false),
            onFinish: () => form.reset()
        })
    }

    return (
        <>
            {!project ? (
                <>
                    <h2 className="text-2xl font-extrabold text-gray-900 border-l-2 pl-3 hidden lg:block">Daftar
                        Projek</h2>

                    <div className="mb-5 rounded-lg">
                        <SearchFilter/>
                    </div>
                    <Table>
                        <Table.THead>
                            <Table.Tr>
                                <Table.Th>Nama Projek</Table.Th>
                                <Table.Th>Peserta</Table.Th>
                                <Table.Th className={'text-center'}>Status</Table.Th>
                                <Table.Th srOnly={true}>Aksi</Table.Th>
                            </Table.Tr>
                        </Table.THead>
                        <Table.TBody>
                            {projects.data.map(({name, team, id, status}, key) => (
                                <Table.Tr key={key} className={'hover:bg-gray-50'}>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('project.show', {id: id})}
                                                     className="w-full text-left py-3 px-6"
                                                     as={'button'}>
                                            {name}
                                        </InertiaLink>
                                    </Table.Td>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('project.show', {id: id})}
                                                     className="w-full text-left py-3 px-6 flex"
                                                     as={'button'}>
                                            {team.apprentices.map((apprentice, idx) => (
                                                <img key={idx}
                                                     className="w-6 h-6 mr-2 transform border border-gray-200 rounded-full cursor-pointer hover:scale-125"
                                                     src={`/storage/${apprentice?.photo}`}
                                                     alt={apprentice.jss.username}/>
                                            ))}
                                        </InertiaLink>
                                    </Table.Td>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('project.show', {id: id})}
                                                     className="w-full text-center py-3 px-6"
                                                     as={'button'}>
                                            {status === 'SELESAI' ? (
                                                <span
                                                    className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full group-hover:shadow">
                                                    {status}
                                                </span>
                                            ) : (
                                                <span
                                                    className="inline-block px-2 py-1 text-xs font-semibold text-gray-600 uppercase bg-gray-200 rounded-full group-hover:shadow">
                                                    Pengembangan
                                                </span>
                                            )}
                                        </InertiaLink>
                                    </Table.Td>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('project.show', {id: id})}
                                                     className="w-full text-left py-3 px-6 flex justify-end"
                                                     as={'button'}>
                                            <IoIosArrowForward/>
                                        </InertiaLink>
                                    </Table.Td>
                                </Table.Tr>
                            ))}
                            {projects.data.length === 0 && (
                                <Table.Tr>
                                    <Table.Td className="w-full py-4 text-center bg-white" colSpan={3}>
                                        data tidak tersedia!
                                    </Table.Td>
                                </Table.Tr>
                            )}
                        </Table.TBody>
                    </Table>

                    <Pagination meta={projects.meta}/>
                </>
            ) : (
                <>
                    <span aria-current="page"
                          className="truncate hidden lg:block pl-3 text-gray-500 text-sm font-medium">
                        Projek
                    </span>
                    <h2 className="text-2xl font-extrabold text-gray-900 border-l-2 pl-3 hidden lg:block">
                        {title}
                    </h2>
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
                        <div className="pt-4 mt-10 border-t-2 mb-5">
                            <h4 className="mt-2 font-semibold text-gray-700 uppercase">Pembimbing Lapangan</h4>
                            <div className="flex">
                                <div className="flex items-center gap-4 mt-4 mr-4">
                                    {project.team.admin.jss.fullname}
                                </div>
                            </div>
                        </div>
                    </div>

                    <Table>
                        <Table.THead>
                            <Table.Tr>
                                <Table.Th>Progress</Table.Th>
                                <Table.Th>Penanggung Jawab</Table.Th>
                                <Table.Th>Status</Table.Th>
                                <Table.Th srOnly={true}>Aksi</Table.Th>
                            </Table.Tr>
                        </Table.THead>
                        <Table.TBody>
                            {project.progress.map(({name, jss, id, status, apprentice_id}, key) => (
                                <Table.Tr key={key} className={'hover:bg-gray-50'}>
                                    <Table.Td>{name}</Table.Td>
                                    <Table.Td>{jss.fullname}</Table.Td>
                                    <Table.Td>
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
                                    </Table.Td>

                                    <Table.Td>
                                        <div className={'flex justify-end'}>
                                            <InertiaLink href={route('progress.show', {id: id})} as="button"
                                                         className="font-semibold text-gray-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                Detail
                                            </InertiaLink>
                                            <button
                                                onClick={() => _onClick(apprentice_id, name, id, status, jss.fullname)}
                                                disabled={apprentice_id !== auth.user?.apprentice.id}
                                                className="font-semibold ml-2 text-gray-600 outline-none hover:text-gray-700">
                                                Ubah
                                            </button>
                                        </div>
                                    </Table.Td>
                                </Table.Tr>
                            ))}
                        </Table.TBody>
                    </Table>

                    <DialogModal isOpen={editOpen} onClose={() => setEditOpen(false)}>
                        <DialogModal.Content title={'Ubah Planning'}>
                            <Input readOnly={true}
                                   name={'fullname'}
                                   value={edit.fullname}
                                   label={'Penanggung Jawab'}
                                   onChange={(e) => _onChange(e)}/>
                            <Input name={'progressName'}
                                   value={edit.name}
                                   label={'Planning'}
                                   onChange={(e) => _onChange(e)}/>

                            <Select name={'status'}
                                    onChange={(e) => _onChange(e)}
                                    label={'Status'}
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
                            <SuccessButton onClick={updateProject} className={'ml-2'}>Ubah Admin</SuccessButton>
                        </DialogModal.Footer>
                    </DialogModal>
                </>
            )}
        </>
    )
}

ProjectIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
