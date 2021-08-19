import Pagination from '@/Components/Pagination';
import AppLayout from '@/Layouts/AppLayout';
import React, {Fragment, useEffect, useState} from 'react'
import moment from 'moment-timezone'
import {Listbox, RadioGroup, Transition} from '@headlessui/react';
import {HiOutlineSelector} from 'react-icons/hi'
import {classNames} from '@/Hooks/constants';
import {usePrevious} from 'react-use';
import pickBy from '@/Lib/pickBy';
import {Inertia} from '@inertiajs/inertia';
import useRoute from "@/Hooks/useRoute";
import {useForm} from '@inertiajs/inertia-react';
import Confirm from '@/Components/Dialog/ConfirmDialog';
import useTypedPage from "@/Hooks/useTypedPage";
import {Apprentice, Attendance, PaginatedData} from "@/types";

export default function AttendanceShow() {
    const route = useRoute();
    const {attendance_paginate: {data, meta}, apprentices, filters}
        = useTypedPage<{
        attendance_paginate: PaginatedData<Attendance>;
        apprentices: { data: Apprentice[] };
    }>().props;
    const [index, setIndex] = useState(0);
    const [editOpen, setEditOpen] = useState(false);
    const [deleteOpen, setDeleteOpen] = useState(false);
    const [selected, setSelected] = useState(apprentices.data[index]);
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
            Inertia.get(route(route().current() as string, {team: selected.team_id}), query, {
                replace: true,
                preserveState: true
            });
        }
    }, [selected, filter]);

    const _onChange = (value: any, name: string) => {
        if (name === 'select') {
            setSelected(value);
            setIndex(apprentices.data.findIndex(
                ({id}) => id === value.id)
            );
        }
        setFilter(values => ({
            ...values,
            [name]: name === 'select'
                ? value.id.toString()
                : value
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
            <div className="relative flex gap-2 my-5">
                <div>
                    <label htmlFor="" className="block mb-1 text-sm font-medium text-gray-700">tampilkan</label>
                    <select
                        className="relative w-20 py-2 pl-3 pr-10 text-left bg-white border border-gray-300 rounded-md shadow-sm cursor-default focus:outline-none focus:ring-1 focus:ring-green-200 focus:border-green-500 sm:text-sm"
                        onChange={(e) => _onChange(e.target.value, 'show')}>
                        <option value="7">7</option>
                        <option value="14">14</option>
                        <option value="21">21</option>
                    </select>
                </div>

                <div>
                    <Listbox value={selected} onChange={(values: any) => _onChange(values, 'select')}>
                        {({open}: any) => (
                            <>
                                <Listbox.Label className="block text-sm font-medium text-gray-700">Pilih
                                    Peserta</Listbox.Label>
                                <div className="relative mt-1">
                                    <Listbox.Button
                                        className="relative w-full py-2 pl-3 pr-10 text-left bg-white border border-gray-300 rounded-md shadow-sm cursor-default md:w-72 focus:outline-none focus:ring-1 focus:ring-green-200 focus:border-green-500 sm:text-sm">
                                        <span className="flex items-center">
                                            <img src={`/storage/${selected.photo}`} alt=""
                                                 className="flex-shrink-0 w-6 h-6 rounded-full"/>
                                            <span className="block ml-3 truncate">{selected.jss.fullname}</span>
                                        </span>
                                        <span
                                            className="absolute inset-y-0 right-0 flex items-center pr-2 ml-3 pointer-events-none">
                                            <HiOutlineSelector className="w-5 h-5 text-gray-400" aria-hidden="true"/>
                                        </span>
                                    </Listbox.Button>

                                    <Transition
                                        show={open}
                                        as={Fragment}
                                        leave="transition ease-in duration-100"
                                        leaveFrom="opacity-100"
                                        leaveTo="opacity-0">
                                        <Listbox.Options static
                                                         className="absolute z-10 w-full py-1 mt-1 overflow-hidden text-base bg-white rounded-md shadow-lg md:w-72 max-h-56 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                            {apprentices.data.map((apprentice, idx) => (
                                                <Listbox.Option
                                                    key={idx}
                                                    className={({active}: any) => classNames(active ? 'text-green-900 bg-green-200' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9')}
                                                    value={apprentice}>
                                                    {({selected}: any) => (
                                                        <>
                                                            <div className="flex items-center">
                                                                <img src={`/storage/${apprentice.photo}`} alt=""
                                                                     className="flex-shrink-0 w-6 h-6 rounded-full"/>
                                                                <span
                                                                    className={classNames(selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate')}>
                                                                    {apprentice.jss.fullname}
                                                                </span>
                                                            </div>
                                                        </>
                                                    )}
                                                </Listbox.Option>
                                            ))}
                                        </Listbox.Options>
                                    </Transition>
                                </div>
                            </>
                        )}
                    </Listbox>
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
