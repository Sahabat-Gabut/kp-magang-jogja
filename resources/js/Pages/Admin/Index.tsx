import Pagination from '@/Components/Pagination';
import SearchFilter from '@/Components/Form/SearchFilter';
import AppLayout from '@/Layouts/AppLayout'
import {HiOutlinePlusSm} from 'react-icons/hi';
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
import Select from "@/Components/Form/Select";
import InputJSS from "@/Components/Form/InputJSS";

export default function AdminIndex() {
    const route = useRoute();
    const {
        data_paginate: {
            data: admins, meta
        }, agencies, roles, auth, title
    } = useTypedPage<{
        data_paginate: PaginatedData<Admin>;
        agencies: Agency[];
        roles: Role[]
    }>().props;
    const form = useForm({
        id: 0,
        jss_id: '',
        role_id: 0,
        agency_id: 0,
    });

    const [addOpen, setAddOpen] = useState(false);
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [overlay, setOverlay] = useState(false);
    const {setData, put, post} = form;

    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;
        setData(data => ({...data, [key]: value}));
    };

    return (
        <>
            <h2 className="text-2xl font-extrabold text-gray-900 border-l-2 pl-3 hidden lg:block">{title}</h2>

            <div className="relative flex items-center gap-2 mb-5 rounded-lg">
                <SearchFilter/>
                <SecondaryButton className={'flex items-center gap-2'} onClick={() => setAddOpen(true)}>
                    <HiOutlinePlusSm className="w-4 h-4"/>
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
                        <Table.Tr key={key} className={'hover:bg-gray-50 text-gray-700'}>
                            <Table.Td><span className={'font-medium text-gray-900'}>{jss.id}</span></Table.Td>
                            <Table.Td>{jss.fullname}</Table.Td>
                            <Table.Td>{role.name}</Table.Td>
                            <Table.Td>
                                <div className="flex justify-end gap-2">
                                    <button onClick={() => {
                                        setEditOpen(true);
                                        setData({id: id, jss_id: jss.id, role_id: role.id, agency_id: agency_id});
                                    }}
                                            className="font-medium outline-none hover:text-yellow-600 focus:outline-none">
                                        Ubah
                                    </button>
                                    <button onClick={() => {
                                        setDeleteOpen(true);
                                        setData('id', id);
                                    }}
                                            className="font-medium outline-none hover:text-red-600 focus:outline-none">
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
                    <InputJSS
                        name={'jss_id'}
                        value={form.data.jss_id}
                        setOverlay={setOverlay}
                        setValue={setData}
                        onChange={(e) => _onChange(e)}/>
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
                    <SuccessButton onClick={() => post(route('admin.store'), {
                        preserveScroll: true,
                        onSuccess: () => setAddOpen(false),
                        onFinish: () => form.reset()
                    })} className={'ml-2'}>Tambah Admin</SuccessButton>
                </DialogModal.Footer>
            </DialogModal>

            {/* Modal Edit Admin */}
            <DialogModal isOpen={editOpen} onClose={() => setEditOpen(false)}>
                <DialogModal.Content title={'Ubah Admin'}>
                    <InputJSS
                        name={'jss_id'}
                        value={form.data.jss_id}
                        setOverlay={setOverlay}
                        setValue={setData}
                        onChange={(e) => _onChange(e)}/>

                    <Select name={'role_id'} label={'Role'} value={form.data.role_id} onChange={(e) => _onChange(e)}>
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
                    <Select name={'agency_id'} label={'Dinas'} value={form.data.agency_id}
                            onChange={(e) => _onChange(e)}>
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
                    <SuccessButton onClick={() => put(route('admin.update', {admin: form.data.id}), {
                        preserveScroll: true,
                        onSuccess: () => setEditOpen(false),
                        onFinish: () => form.reset()
                    })} className={'ml-2'}>Ubah Admin</SuccessButton>
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
                        onClick={() => form.delete(route('admin.destroy', {id: form.data.id}), {
                            preserveScroll: true,
                            onFinish: () => setDeleteOpen(false),
                        })}
                        className={'ml-2'}>
                        Hapus Admin
                    </DangerButton>
                </DialogModal.Footer>
            </DialogModal>
            {overlay && (
                <div className="absolute top-0 left-0 right-0 z-50 w-screen h-screen bg-black bg-opacity-50">
                    <div className="flex h-full text-white">
                        <div className="m-auto">
                            sedang mencari akun JSS
                        </div>
                    </div>
                </div>
            )}
        </>
    )
}

AdminIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
