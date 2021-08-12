import SearchFilter from '@/Components/molecules/SearchFilter';
import Pagination from '@/Components/molecules/Pagination';
import AppLayout from '@/Components/templates/AppLayout'
import { usePage } from '@/hooks/usePage'
import React, { useState } from 'react'
import Confirm from '@/Components/molecules/ConfirmDialog';
import { useForm } from '@inertiajs/inertia-react';
import route from 'ziggy-js';

export default function Agency() {
    const { agency_paginate } = usePage().props;
    const { data: agencies, meta } = agency_paginate;
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
        setData(data => ({ ...data, [key]: value }));
        setEdit(values => ({ ...values, [key]: value }));
    };

    const _onClick = (id: number, name: string, quota: number, location?: string) => {
        setEditOpen(true);
        setData({ id: id, name: name, quota: quota, location: location || '' });
        setEdit({ id: id, name: name, quota: quota, location: location || '' });
    };
    const handleDelete = (id: number) => {
        setDeleteOpen(true);
        setData('id', id)
    }

    const agencyForm = useForm({
        id: 0,
        name: '',
        quota: 0,
        location: '',
    });

    const { setData, put } = agencyForm;


    return (
        <>
            <div className="flex flex-col items-center gap-2 mt-10 mb-5 md:flex-row">
                <SearchFilter />
            </div>

            <div className="flex flex-col">
                <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50" style={{ maxHeight: '65vh' }} >
                            <table className="min-w-full">
                                <thead className="sticky top-0 bg-gray-50" style={{ zIndex: 2 }}>
                                    <tr>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Dinas
                                        </th>
                                        <th
                                            scope="col"
                                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                            Kuota
                                        </th>
                                        <th scope="col" className="relative px-6 py-3">
                                            <span className="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="text-sm font-light bg-white divide-y divide-gray-200">
                                    {agencies.map(({ id, name, quota, location }, key) => (
                                        <tr key={key} className="hover:bg-gray-50">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {name}
                                            </td>
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {quota}
                                            </td>
                                            <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                <div className="flex justify-end gap-2">
                                                    <button onClick={() => _onClick(id, name, quota, location)} className="font-semibold text-yellow-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                        Ubah
                                                    </button>
                                                    <button onClick={() => handleDelete(id)} className="font-semibold text-red-600 outline-none hover:text-red-900">
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
                <Pagination
                    to={meta.to}
                    from={meta.from}
                    total={meta.total}
                    links={meta.links} />
            </div>
            <Confirm
                title="Ubah Dinas"
                open={editOpen}
                onClose={() => setEditOpen(false)}
                onConfirm={() => put(route('agency.update', edit.id))}
                confirmText="Ubah">

                <label htmlFor="name" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Nama</label>
                <input id="name"
                    onChange={(e) => _onChange(e)}
                    name="name"
                    value={edit.name}
                    className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600" />

                <label htmlFor="location" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Lokasi Dinas</label>
                <textarea id="location"
                    onChange={(e) => _onChange(e)}
                    name="location"
                    defaultValue={edit.location}
                    className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"></textarea>

                <label htmlFor="quota" className="block pb-1 mt-2 text-sm font-semibold text-gray-600">Kuota Magang</label>
                <input id="quota"
                    onChange={(e) => _onChange(e)}
                    name="quota"
                    value={edit.quota}
                    type="number"
                    className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600" />
            </Confirm>

            <Confirm
                title="Hapus Dinas"
                open={deleteOpen}
                onClose={() => setDeleteOpen(false)}
                onConfirm={() => agencyForm.delete(route('agency.destroy', agencyForm.data.id))}
                confirmText="Hapus Dinas"
                confirmClass="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                <p className="text-sm">
                    Apakah kamu yakin ingin menghapus Dinas ini? Data yang sudah dihapus tidak akan bisa dikembalikan kembali.
                </p>
            </Confirm>
        </>
    )
}

Agency.layout = (page: React.ReactChild) => <AppLayout children={page} />;
