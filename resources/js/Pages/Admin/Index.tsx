import Confirm from '@/Components/molecules/ConfirmDialog';
import Pagination from '@/Components/molecules/Pagination';
import SearchFilter from '@/Components/molecules/SearchFilter';
import AppLayout from '@/Components/templates/AppLayout'
import {PlusIcon} from '@heroicons/react/solid';
import {useForm} from '@inertiajs/inertia-react';
import React, {useState} from 'react';
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Admin, Agency, Role} from "@/types/models";
import useRoute from "@/Hooks/useRoute";

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
    const adminForm = useForm({
        id: 0,
        jss_id: '',
        role_id: 0,
        agency_id: 0,
    });

    const {setData, put, post} = adminForm;
    const _onChange = (e: any) => {
        const key = e.target.name;
        const value = e.target.value;
        setData(data => ({...data, [key]: value}));
        setEdit(values => ({...values, [key]: value}));
    };
    return (
        <>
            <div className="flex items-center gap-2 mt-10 mb-5 rounded-lg">
                <SearchFilter/>
                <button onClick={() => setAddOpen(true)}
                        className="flex items-center gap-2 px-3 py-2 text-gray-800 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none">
                    <PlusIcon className="w-4 h-4"/>
                    Tambah
                </button>
            </div>

            <div className="flex flex-col">
                <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div
                            className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50"
                            style={{maxHeight: '70vh'}}>
                            <table className="min-w-full">
                                <thead className="sticky top-0 bg-gray-50" style={{zIndex: 2}}>
                                <tr>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        ID JSS
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Nama
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Role
                                    </th>
                                    <th scope="col" className="relative px-6 py-3">
                                        <span className="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody className="text-sm font-light bg-white divide-y divide-gray-200">
                                {admins.map(({role, jss, id, agency_id}, key) => (
                                    <tr key={key} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {jss.id}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {jss.fullname}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {role.name}
                                        </td>
                                        <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <div className="flex justify-end gap-2">
                                                <button onClick={() => _onClick(id, jss.id, role.id, agency_id)}
                                                        className="font-semibold text-yellow-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                    Ubah
                                                </button>
                                                <button onClick={() => handleDelete(id)}
                                                        className="font-semibold text-red-600 outline-none hover:text-red-900">
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

            <div className="">
                <Pagination meta={meta}/>
            </div>
            <Confirm
                title="Tambah Admin"
                open={addOpen}
                onClose={() => setAddOpen(false)}
                onConfirm={() => post(route('admin.store'))}
                confirmText="Tambah">

                <label htmlFor="jss_id" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">JSS ID</label>
                <input id="jss_id"
                       onChange={(e) => _onChange(e)}
                       name="jss_id"
                       className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>

                <label htmlFor="role_id" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Role</label>
                <select
                    id="role_id"
                    onChange={(e) => _onChange(e)}
                    name="role_id"
                    className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                    <option value="">Pilih Role</option>
                    {roles.map((role, idx) => (
                        role.id === 1 ? (
                            auth?.user?.admin.role.id === 1 &&
                            <option key={idx} value={role.id}>{role.name}</option>
                        ) : (
                            <option key={idx} value={role.id}>{role.name}</option>
                        )
                    ))}
                </select>
                {auth.user?.admin.role.id === 1 && (
                    <>
                        <label htmlFor="agency_id"
                               className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Dinas</label>
                        <select
                            id="agency_id"
                            onChange={(e) => _onChange(e)}
                            name="agency_id"
                            className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                            <option value="">Pilih Dinas</option>
                            {agencies.map((agency, idx) => (
                                <option key={idx} value={agency.id}>{agency.name}</option>
                            ))}
                        </select>
                    </>
                )}
            </Confirm>
            <Confirm
                title="Ubah Admin"
                open={editOpen}
                onClose={() => setEditOpen(false)}
                onConfirm={() => put(route('admin.update', {admin: edit.id}))}
                confirmText="Ubah">

                <label htmlFor="jss_id" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">JSS ID</label>
                <input id="jss_id"
                       onChange={(e) => _onChange(e)}
                       name="jss_id"
                       value={edit.jss_id}
                       className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>

                <label htmlFor="role_id" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Role</label>
                <select
                    id="role_id"
                    onChange={(e) => _onChange(e)}
                    value={edit.role_id}
                    name="role_id"
                    className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                    <option value="">Pilih Role</option>
                    {roles.map((role, idx) => (
                        role.id === 1 ? (
                            auth.user?.admin.role.id === 1 &&
                            <option key={idx} value={role.id}>{role.name}</option>
                        ) : (
                            <option key={idx} value={role.id}>{role.name}</option>
                        )
                    ))}
                </select>
                {auth.user?.admin.role.id === 1 && (
                    <>
                        <label htmlFor="agency_id"
                               className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Dinas</label>
                        <select
                            id="agency_id"
                            onChange={(e) => _onChange(e)}
                            value={edit.agency_id}
                            name="agency_id"
                            className="block w-full h-full px-2 py-3 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white">
                            <option value="">Pilih Dinas</option>
                            {agencies.map((agency, idx) => (
                                <option key={idx} value={agency.id}>{agency.name}</option>
                            ))}
                        </select>
                    </>
                )}
            </Confirm>
            <Confirm
                title="Hapus Admin"
                open={deleteOpen}
                onClose={() => setDeleteOpen(false)}
                onConfirm={() => adminForm.delete(route('admin.destroy', {id: adminForm.data.id}))}
                confirmText="Hapus Admin"
                confirmClass="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                <p className="text-sm">
                    Apakah kamu yakin ingin menghapus admin ini? Data yang sudah dihapus tidak akan bisa dikembalikan
                    kembali.
                </p>
            </Confirm>
        </>
    )
}

AdminIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
