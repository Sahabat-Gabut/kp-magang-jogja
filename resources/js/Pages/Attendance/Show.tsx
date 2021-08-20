import Pagination from '@/Components/Pagination';
import AppLayout from '@/Layouts/AppLayout';
import React, {ChangeEvent, useEffect, useState} from 'react'
import moment from 'moment-timezone'
import {RadioGroup} from '@headlessui/react';
import {usePrevious} from 'react-use';
import useRoute from "@/Hooks/useRoute";
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import Confirm from '@/Components/Dialog/ConfirmDialog';
import useTypedPage from "@/Hooks/useTypedPage";
import {Apprentice, Attendance, PaginatedData} from "@/types";
import {Select} from "@/Components/Form";
import {BsArrowLeftShort} from "react-icons/bs";
import {Inertia} from "@inertiajs/inertia";
import pickBy from "@/Lib/pickBy";

export default function AttendanceShow() {
    const route = useRoute();
    const {attendance_paginate: {data, meta}, apprentices, filters}
        = useTypedPage<{
        attendance_paginate: PaginatedData<Attendance>;
        apprentices: { data: Apprentice[] };
    }>().props;
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [filter, setFilter] = useState({
        select: filters.select || '',
        show: filters.show || ''
    });
    const prevValues = usePrevious(filter);

    useEffect(() => {
        if (prevValues) {
            const query = Object.keys(
                pickBy(filter)).length
                ? pickBy(filter)
                : {};
            Inertia.get(route(route().current() as string, {team: apprentices.data[0].team_id}), query, {
                replace: true,
                preserveState: true
            });
        }
    }, [filter]);

    const _onChange = (e: any) => {
        const key = e.target.name;
        const val = e.target.value;

        setFilter(values => ({
            ...values, [key]: val
        }));
    }

    const attendanceForm = useForm({
        id: 0,
        status: ''
    });
    const [edit, setEdit] = useState({
        id: 0,
        status: ''
    });

    const {setData, put} = attendanceForm;

    const _onClick = (id: number, status: string) => {
        setEditOpen(true);
        setStatus(status);
        setData({id: id, status: status});
        setEdit({id: id, status: status});
    };
    const handleDelete = (id: number) => {
        setDeleteOpen(true);
        setData('id', id)
    }
    let [status, setStatus] = useState('')

    const onChangeStatus = (status: string) => {
        setStatus(status);
        setData('status', status)
    }
    return (
        <>
            <nav className="hidden lg:flex items-center text-gray-500 text-sm font-medium space-x-2 whitespace-nowrap">
                <InertiaLink href={route('attendance.index')} className="hover:text-gray-900">
                    Daftar Absensi
                </InertiaLink>
                <svg width="24" height="24" fill="none" className="flex-none text-gray-300">
                    <path d="M10.75 8.75l3.5 3.25-3.5 3.25" stroke="currentColor" strokeWidth="1.5"
                          strokeLinecap="round" strokeLinejoin="round"/>
                </svg>
                <span aria-current="page"
                      className="truncate">
                    Detail
                </span>
            </nav>
            <h2 className="text-2xl font-extrabold text-gray-900 hidden lg:block">Daftar Absensi</h2>

            <div className="relative flex flex-col lg:flex-row gap-2 mb-5 lg:items-center justify-between">
                <InertiaLink href={route('attendance.index')} as="button"
                             className="inline-flex w-32 items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition gap-2">
                    <BsArrowLeftShort/>
                    kembali
                </InertiaLink>
                <div className={'flex gap-2 items-center'}>
                    <Select name={'show'}
                            className={'py-2 px-3 font-medium w-20'}
                            style={{lineHeight: '25px!important'}}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}>
                        <option value="7">7</option>
                        <option value="14">14</option>
                        <option value="21">21</option>
                    </Select>

                    <Select name={'select'}
                            className={'py-2 px-3 font-medium'}
                            style={{lineHeight: '25px!important'}}
                            onChange={(e: ChangeEvent<HTMLSelectElement>) => _onChange(e)}>
                        <option value={''}>semua peserta</option>
                        {apprentices.data.map((apprentice, key) => (
                            <option key={key} value={`${apprentice.id}`}>{apprentice.jss.fullname}</option>
                        ))}
                    </Select>
                </div>
            </div>

            <div className="flex flex-col">
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
                                        Jadwal
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Peserta
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
                                {data.map(({start_attendance, end_attendance, apprentice, status, id}, key) => {
                                    const start = moment(start_attendance);
                                    const ends = moment(end_attendance);
                                    return (
                                        <tr key={key} className="hover:bg-gray-50">
                                            <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className="font-semibold">
                                                        {moment(start_attendance).format('dddd Do MMMM YYYY')}
                                                    </span>
                                                <br/>
                                                <span>
                                                        {start.tz('Asia/Jakarta').format('h:mm:ss')}
                                                    {' - '}
                                                    {ends.tz('Asia/Jakarta').format('h:mm:ss z')}
                                                    </span>
                                            </td>

                                            <td className="px-6 py-4 whitespace-nowrap">
                                                <div className="flex">
                                                    <img
                                                        className="w-6 h-6 mr-2 transform border border-gray-200 rounded-full cursor-pointer hover:scale-125"
                                                        src={`/storage/${apprentice?.photo}`}
                                                        alt={apprentice?.jss.username}/>
                                                    <span>
                                                            {apprentice?.jss.fullname}
                                                        </span>
                                                </div>
                                            </td>

                                            <td className="px-6 py-4 whitespace-nowrap">
                                                {status !== null && (
                                                    status === "TEPAT WAKTU"
                                                        ?
                                                        <span
                                                            className="inline-block px-2 py-1 text-xs font-semibold text-green-600 uppercase bg-green-200 rounded-full group-hover:shadow">
                                                                {status}
                                                            </span>
                                                        : status === "TERLAMBAT" ? (
                                                            <span
                                                                className="inline-block px-2 py-1 text-xs font-semibold text-red-600 uppercase bg-red-200 rounded-full group-hover:shadow">
                                                                    {status}
                                                                </span>
                                                        ) : (
                                                            <span
                                                                className="inline-block px-2 py-1 text-xs font-semibold text-gray-600 uppercase bg-gray-200 rounded-full group-hover:shadow">
                                                                    {status}
                                                                </span>
                                                        )
                                                )}
                                            </td>

                                            <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                <div className="flex justify-end gap-2 text-center">
                                                    <button onClick={() => _onClick(id, status)}
                                                            className="font-semibold text-gray-600 outline-none hover:text-yellow-900 focus:outline-none">
                                                        Ubah
                                                    </button>
                                                    <button onClick={() => handleDelete(id)}
                                                            className="font-semibold text-gray-600 outline-none hover:text-red-900">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    )
                                })}
                                {data.length === 0 && (
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

            <Pagination meta={meta}/>

            <Confirm
                title="Ubah Absensi"
                open={editOpen}
                onClose={() => setEditOpen(false)}
                onConfirm={() => put(route('attendance.update', {id: edit.id}))}
                confirmText="Ubah">

                <RadioGroup value={status} onChange={(status: string) => onChangeStatus(status)} className="flex gap-5">
                    <RadioGroup.Option value="TEPAT WAKTU">
                        {({active, checked}: any) => (
                            <div className="flex items-center gap-1 cursor-pointer">
                                <span
                                    className={`
                                        ${checked ? 'bg-green-600 ' : ''}
                                        ${active ? 'ring-2 ring-green-500' : ''}
                                        w-4 h-4 rounded-full bg-white border border-gray-300`}
                                />
                                Hadir
                            </div>
                        )}
                    </RadioGroup.Option>
                    <RadioGroup.Option value="IZIN">
                        {({active, checked}: any) => (
                            <div className="flex items-center gap-1 cursor-pointer">
                                <span
                                    className={`
                                        ${checked ? 'bg-green-600 ' : ''}
                                        ${active ? 'ring-2 ring-green-500' : ''}
                                        w-4 h-4 rounded-full bg-white border border-gray-300`}
                                />
                                Izin
                            </div>
                        )}
                    </RadioGroup.Option>
                    <RadioGroup.Option value="SAKIT">
                        {({active, checked}: any) => (
                            <div className="flex items-center gap-1 cursor-pointer">
                                <span
                                    className={`
                                        ${checked ? 'bg-green-600 ' : ''}
                                        ${active ? 'ring-2 ring-green-500' : ''}
                                        w-4 h-4 rounded-full bg-white border border-gray-300`}
                                />
                                Sakit
                            </div>
                        )}
                    </RadioGroup.Option>
                    <RadioGroup.Option value="TERLAMBAT">
                        {({active, checked}: any) => (
                            <div className="flex items-center gap-1 cursor-pointer">
                                <span
                                    className={`
                                        ${checked ? 'bg-green-600 ' : ''}
                                        ${active ? 'ring-2 ring-green-500' : ''}
                                        w-4 h-4 rounded-full bg-white border border-gray-300`}
                                />
                                Telat
                            </div>
                        )}
                    </RadioGroup.Option>
                </RadioGroup>

            </Confirm>
            <Confirm
                title="Hapus Absen"
                open={deleteOpen}
                onClose={() => setDeleteOpen(false)}
                onConfirm={() => attendanceForm.delete(route('attendance.destroy', {id: attendanceForm.data.id}))}
                confirmText="Hapus Absen"
                confirmClass="bg-red-600 hover:bg-red-700 focus:ring-red-500 text-white">
                <p className="text-sm">
                    Apakah anda yakin ingin menghapus absen ini? Data yang sudah dihapus tidak akan bisa dikembalikan
                    kembali.
                </p>
            </Confirm>
        </ >
    );
}

AttendanceShow.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
