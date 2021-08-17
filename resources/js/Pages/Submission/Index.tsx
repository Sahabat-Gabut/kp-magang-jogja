import Pagination from '@/Components/molecules/Pagination';
import SearchFilter from '@/Components/molecules/SearchFilter';
import AppLayout from '@/Components/templates/AppLayout'
import {Listbox, Transition} from '@headlessui/react';
import {SelectorIcon} from '@heroicons/react/solid';
import {Inertia} from '@inertiajs/inertia';
import {InertiaLink} from '@inertiajs/inertia-react';
import {pickBy} from 'lodash';
import React, {Fragment, useEffect, useState} from 'react'
import {usePrevious} from 'react-use';
import route from 'ziggy-js';
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Team} from "@/types/models";

const status = [
    {id: 1, name: 'Semua', value: ''},
    {id: 2, name: 'Diterima', value: 'DITERIMA'},
    {id: 3, name: 'Ditolak', value: 'DITOLAK'},
    {id: 3, name: 'Sedang Diproses', value: 'SEDANG DIPROSES'},
]

export default function Submission() {
    const {data_paginate, filters} = useTypedPage<{ data_paginate: PaginatedData<Team> }>().props;
    const {data: submissions, meta} = data_paginate;
    const [selectedStatus, setSelectedStatus] = useState(status[0]);
    const [values, setValues] = useState({
        status: filters.status || ''
    });

    const prevValues = usePrevious(values);
    useEffect(() => {
        if (prevValues) {
            const query = Object.keys(
                pickBy(values)).length
                ? pickBy(values)
                : {};
            Inertia.get(route(route().current() as string), query, {
                replace: true,
                preserveState: true
            });
        }
    }, [values]);

    function handleChange(e: any) {
        setSelectedStatus(e);
        setValues({status: e.value});
    }

    return (
        <>
            <div className="flex flex-col items-center gap-2 mt-10 mb-5 md:flex-row">
                <SearchFilter/>
                <Listbox value={selectedStatus} onChange={(value) => handleChange(value)}>
                    <div className="relative w-full md:w-96">
                        <Listbox.Button
                            className="relative w-full py-2 pl-3 pr-10 text-left bg-white border border-gray-300 rounded-lg cursor-default md:w-96 focus:outline-none focus-visible:ring-2 focus-visible:ring-opacity-75 focus-visible:ring-white focus-visible:ring-offset-orange-300 focus-visible:ring-offset-2 focus-visible:border-indigo-500 sm:text-sm">
                            <span className="block truncate">
                                {selectedStatus.name}
                            </span>
                            <span className="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                <SelectorIcon
                                    className="w-5 h-5 text-gray-400"
                                    aria-hidden="true"/>
                            </span>
                        </Listbox.Button>
                        <Transition
                            as={Fragment}
                            leave="transition ease-in duration-100"
                            leaveFrom="opacity-100"
                            leaveTo="opacity-0">
                            <Listbox.Options
                                className="absolute z-50 w-full py-1 mt-1 overflow-auto text-base bg-white rounded-md shadow-lg max-h-60 ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                {status.map((status, key) => (
                                    <Listbox.Option
                                        key={key}
                                        className={({active}) => `${active ? 'text-green-900 bg-green-100' : 'text-gray-900'} cursor-default select-none relative py-2 px-4`}
                                        value={status}>
                                        {({selected}) => (
                                            <>
                                                <span
                                                    className={`${selected ? 'font-medium' : 'font-normal'} block truncate`}>
                                                    {status.name}
                                                </span>
                                            </>
                                        )}
                                    </Listbox.Option>
                                ))}
                            </Listbox.Options>
                        </Transition>
                    </div>
                </Listbox>
                {/* <button className="flex items-center w-full gap-2 px-3 py-2 text-gray-800 bg-white border border-gray-300 rounded-lg md:w-36 hover:bg-gray-50 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 13l-3 3m0 0l-3-3m3 3V8m0 13a9 9 0 110-18 9 9 0 010 18z" />
                    </svg>
                    Ekspor
                </button> */}
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
                                        Dinas
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Universitas
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th
                                        scope="col"
                                        className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Peserta
                                    </th>
                                    <th scope="col" className="relative px-6 py-3">
                                        <span className="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody className="text-sm font-light bg-white divide-y divide-gray-200">
                                {submissions.map(({agency: {name}, id, university, apprentices, status}, key) => (
                                    <tr key={key} className="hover:bg-gray-50">
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {name}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {university}
                                        </td>
                                        <td className="px-6 py-4 whitespace-nowrap">
                                            {status === "SEDANG DIPROSES" && (
                                                <span
                                                    className="inline-flex px-2 text-xs font-semibold leading-5 text-yellow-800 bg-yellow-100 rounded-full">
                                                        {status}
                                                    </span>
                                            )}
                                            {status === "DITERIMA" && (
                                                <span
                                                    className="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                                        {status}
                                                    </span>
                                            )}
                                            {status === "DITOLAK" && (
                                                <span
                                                    className="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                        {status}
                                                    </span>
                                            )}
                                        </td>
                                        <td className="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                            <div className="flex items-center">
                                                {apprentices.map((user, idx) => (
                                                    <img key={idx}
                                                         className="w-6 h-6 transform border border-gray-200 rounded-full cursor-pointer hover:scale-125"
                                                         src={`storage/${user.photo}`} alt={user.jss.username}/>
                                                ))}
                                            </div>
                                        </td>
                                        <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                            <InertiaLink href={route('submission.show', {id: id.toString()})}
                                                         className="text-gray-600 hover:text-gray-900">
                                                Detail
                                            </InertiaLink>
                                        </td>
                                    </tr>
                                ))}
                                {submissions.length === 0 && (
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

            <div className="px-2">
                <Pagination meta={meta}/>
            </div>
        </>
    )
}

Submission.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
