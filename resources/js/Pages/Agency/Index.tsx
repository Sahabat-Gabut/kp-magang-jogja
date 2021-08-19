import SearchFilter from '@/Components/Form/SearchFilter';
import Pagination from '@/Components/Pagination';
import AppLayout from '@/Layouts/AppLayout'
import React, {useState} from 'react'
import {useForm} from '@inertiajs/inertia-react';
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Agency} from "@/types/models";
import Table from "@/Components/Table";
import DialogModal from "@/Components/Dialog/DialogModal";
import Input from "@/Components/Form/Input";
import SecondaryButton from "@/Components/Button/SecondaryButton";
import SuccessButton from "@/Components/Button/SuccessButton";
import Textarea from "@/Components/Form/Textarea";
import DangerButton from "@/Components/Button/DangerButton";

export default function AgencyIndex() {
    const route = useRoute();
    const {data_paginate} = useTypedPage<{ data_paginate: PaginatedData<Agency> }>().props;
    const {data: agencies, meta} = data_paginate;
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);

    const [edit, setEdit] = useState({
        id: 0,
        name: '',
        quota: 0,
        location: '',
    });
    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;
        setData(data => ({...data, [key]: value}));
        setEdit(values => ({...values, [key]: value}));
    };

    const _onClick = (id: number, name: string, quota: number, location?: string) => {
        setEditOpen(true);
        setData({id: id, name: name, quota: quota, location: location || ''});
        setEdit({id: id, name: name, quota: quota, location: location || ''});
    };
    const handleDelete = (id: number) => {
        setDeleteOpen(true);
        setData('id', id)
    }

    const form = useForm({
        id: 0,
        name: '',
        quota: 0,
        location: '',
    });

    const {setData, put} = form;

    const updateAgency = () => {
        put(route('agency.update', {agency: edit.id}), {
            preserveScroll: true,
            onSuccess: () => setEditOpen(false),
            onFinish: () => form.reset()
        });
    }

    const deleteAgency = () => {
        form.delete(route('agency.destroy', {agency: form.data.id}), {
            preserveScroll: true,
            onFinish: () => setDeleteOpen(false),
        });
    }

    return (
        <>
            <div className="flex flex-col items-center gap-2 mt-10 mb-5 md:flex-row">
                <SearchFilter/>
            </div>

            <Table>
                <Table.THead>
                    <Table.Tr>
                        <Table.Th>Dinas</Table.Th>
                        <Table.Th>Kuota</Table.Th>
                        <Table.Th srOnly={true}>Aksi</Table.Th>
                    </Table.Tr>
                </Table.THead>
                <Table.TBody>
                    {agencies.map(({id, name, quota, location}, key) => (
                        <Table.Tr key={key} className={'hover:bg-gray-50'}>
                            <Table.Td>{name}</Table.Td>
                            <Table.Td>{quota}</Table.Td>
                            <Table.Td>
                                <div className="flex justify-end gap-2">
                                    <button onClick={() => _onClick(id, name, quota, location)}
                                            className="font-semibold text-emerald-500 hover:text-emerald-600 outline-none focus:outline-none">
                                        Ubah
                                    </button>
                                    <button onClick={() => handleDelete(id)}
                                            className="font-semibold text-red-300 outline-none hover:text-red-500">
                                        Hapus
                                    </button>
                                </div>
                            </Table.Td>
                        </Table.Tr>
                    ))}
                </Table.TBody>
            </Table>

            <Pagination meta={meta}/>

            <DialogModal isOpen={editOpen} onClose={() => setEditOpen(false)}>

                <DialogModal.Content title={'Ubah Dinas'}>
                    <Input name={'name'} label={'Nama'} value={edit.name} onChange={(e) => _onChange(e)}/>
                    <Textarea onChange={(e) => _onChange(e)}
                              name={'location'}
                              label={'Lokasi Dinas'}
                              defaultValue={edit.location}/>
                    <Input name={'quota'}
                           label={'Kuota Magang'}
                           onChange={(e) => _onChange(e)}
                           value={edit.quota}
                           type="number"/>
                </DialogModal.Content>

                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setEditOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <SuccessButton onClick={updateAgency} className={'ml-2'}>Ubah Dinas</SuccessButton>
                </DialogModal.Footer>

            </DialogModal>

            <DialogModal isOpen={deleteOpen} onClose={() => setDeleteOpen(false)}>
                {/* // TODO: DYNAMIC NAME AGENCY */}
                <DialogModal.Content title={'Hapus Dinas'}>
                    Apakah kamu yakin ingin menghapus Dinas ini? Data yang sudah dihapus tidak akan bisa dikembalikan
                    kembali.
                </DialogModal.Content>

                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setDeleteOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <DangerButton onClick={deleteAgency} className={'ml-2'}>Hapus Dinas</DangerButton>
                </DialogModal.Footer>

            </DialogModal>
        </>
    )
}

AgencyIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
