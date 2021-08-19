import Pagination from '@/Components/Pagination';
import SearchFilter from '@/Components/Form/SearchFilter';
import AppLayout from '@/Layouts/AppLayout'
import {PlusIcon} from '@heroicons/react/solid';
import {useForm} from '@inertiajs/inertia-react';
import React, {useState} from 'react';
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Admin, Agency, Role} from "@/types/models";
import useRoute from "@/Hooks/useRoute";
import DialogModal from "@/Components/Dialog/DialogModal";
import DangerButton from "@/Components/Button/DangerButton";
import SecondaryButton from "@/Components/Button/SecondaryButton";
import SuccessButton from "@/Components/Button/SuccessButton";
import Table from "@/Components/Table";
import Input from "@/Components/Form/Input";
import Select from "@/Components/Form/Select";

export default function AdminIndex() {
    const route = useRoute();
    const {data_paginate: {data: admins, meta}, agencies, roles, auth} =
        useTypedPage<{
            data_paginate: PaginatedData<Admin>;
            agencies: Agency[];
            roles: Role[]
        }>().props;
    const [addOpen, setAddOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [edit, setEdit] = useState({
        id: 0,
        jss_id: '',
        role_id: 0,
        agency_id: 0,
    });
    const _onClick = (id: number, jss_id: string, role_id: number, agency_id: number) => {
        setEditOpen(true);
        setData({id: id, jss_id: jss_id, role_id: role_id, agency_id: agency_id});
        setEdit({id: id, jss_id: jss_id, role_id: role_id, agency_id: agency_id});
    };
    const handleDelete = (id: number) => {
        setDeleteOpen(true);
        setData('id', id)
    }
    const form = useForm({
        id: 0,
        jss_id: '',
        role_id: 0,
        agency_id: 0,
    });

    const {setData, put, post} = form;
    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;
        setData(data => ({...data, [key]: value}));
        setEdit(values => ({...values, [key]: value}));
    };

    const deleteAdmin = () => {
        form.delete(route('admin.destroy', {id: form.data.id}), {
            preserveScroll: true,
            onFinish: () => setDeleteOpen(false),
        })
    };

    const updateAdmin = () => {
        put(route('admin.update', {admin: edit.id}), {
            preserveScroll: true,
            onSuccess: () => setEditOpen(false),
            onFinish: () => form.reset()
        })
    };

    const storeAdmin = () => {
        post(route('admin.store'), {
            preserveScroll: true,
            onSuccess: () => setAddOpen(false),
            onFinish: () => form.reset()
        });
    }

    return (
        <>
            <div className="flex items-center gap-2 mt-10 mb-5 rounded-lg">
                <SearchFilter/>
                <SecondaryButton className={'flex items-center gap-2 py-3'} onClick={() => setAddOpen(true)}>
                    <PlusIcon className="w-4 h-4"/>
                    Tambah
                </SecondaryButton>
            </div>

            <Table>
                <Table.THead>
                    <Table.Tr>
                        <Table.Th>ID JSS</Table.Th>
                        <Table.Th>Nama</Table.Th>
                        <Table.Th>Role</Table.Th>
                        <Table.Th srOnly={true}>Aksi</Table.Th>
                    </Table.Tr>
                </Table.THead>
                <Table.TBody>
                    {admins.map(({role, jss, id, agency_id}, key) => (
                        <Table.Tr key={key} className={'hover:bg-gray-50'}>
                            <Table.Td>{jss.id}</Table.Td>
                            <Table.Td>{jss.fullname}</Table.Td>
                            <Table.Td>{role.name}</Table.Td>
                            <Table.Td>
                                <div className="flex justify-end gap-2">
                                    <button onClick={() => _onClick(id, jss.id, role.id, agency_id)}
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

            {/* Modal Add Admin */}
            <DialogModal isOpen={addOpen} onClose={() => setAddOpen(false)}>
                <DialogModal.Content title={'Tambah Admin'}>
                    <Input name={'jss_id'} label={'ID JSS'} onChange={(e) => _onChange(e)}/>
                    <Select name={'role_id'} label={'Role'} onChange={(e) => _onChange(e)}>
                        <option value={''}>Pilih Role</option>
                        {roles.map((role, idx) => (
                            role.id === 1
                                ? auth?.user?.admin.role.id === 1 &&
                                <option key={idx} value={role.id}>{role.name}</option>
                                : <option key={idx} value={role.id}>{role.name}</option>
                        ))}
                    </Select>

                    {auth.user?.admin.role.id === 1 &&
                    <Select name={'agency_id'} label={'Dinas'} onChange={(e) => _onChange(e)}>
                        <option value={''}>Pilih Dinas</option>
                        {agencies.map((agency, idx) => (
                            <option key={idx} value={agency.id}>{agency.name}</option>
                        ))}
                    </Select>}

                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setAddOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <SuccessButton onClick={storeAdmin} className={'ml-2'}>Tambah Admin</SuccessButton>
                </DialogModal.Footer>
            </DialogModal>

            {/* Modal Edit Admin */}
            <DialogModal isOpen={editOpen} onClose={() => setEditOpen(false)}>
                <DialogModal.Content title={'Ubah Admin'}>
                    <Input name={'jss_id'} label={'ID JSS'} value={edit.jss_id} onChange={(e) => _onChange(e)}/>

                    <Select name={'role_id'} label={'Role'} value={edit.role_id} onChange={(e) => _onChange(e)}>
                        <option value={''}>Pilih Role</option>
                        {roles.map((role, idx) => (
                            role.id === 1
                                ?
                                auth?.user?.admin.role.id === 1 &&
                                <option key={idx} value={role.id}>{role.name}</option>
                                : <option key={idx} value={role.id}>{role.name}</option>
                        ))}
                    </Select>

                    {auth.user?.admin.role.id === 1 &&
                    <Select name={'agency_id'} label={'Dinas'} value={edit.agency_id} onChange={(e) => _onChange(e)}>
                        <option value={''}>Pilih Dinas</option>
                        {agencies.map((agency, idx) => (
                            <option key={idx} value={agency.id}>{agency.name}</option>
                        ))}
                    </Select>}
                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setEditOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <SuccessButton onClick={updateAdmin} className={'ml-2'}>Ubah Admin</SuccessButton>
                </DialogModal.Footer>
            </DialogModal>

            {/* Modal Delete Admin */}
            <DialogModal isOpen={deleteOpen} onClose={() => setDeleteOpen(false)}>
                <DialogModal.Content title={'Hapus Admin'}>
                    Apakah kamu yakin ingin menghapus admin ini? Data yang sudah dihapus tidak akan bisa dikembalikan.
                </DialogModal.Content>
                <DialogModal.Footer>
                    <SecondaryButton onClick={() => setDeleteOpen(false)}>
                        Batal
                    </SecondaryButton>
                    <DangerButton
                        onClick={deleteAdmin}
                        className={'ml-2'}>
                        Hapus Admin
                    </DangerButton>
                </DialogModal.Footer>
            </DialogModal>
        </>
    )
}

AdminIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
