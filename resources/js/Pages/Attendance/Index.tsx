import Pagination from '@/Components/Pagination';
import SearchFilter from '@/Components/Form/SearchFilter';
import AppLayout from '@/Layouts/AppLayout'
import {InertiaLink, useForm} from '@inertiajs/inertia-react';
import moment from 'moment-timezone';
import React from 'react'
import useRoute from "@/Hooks/useRoute";
import useTypedPage from "@/Hooks/useTypedPage";
import {PaginatedData} from "@/types/UsePageProps";
import {Attendance, Team} from "@/types/models";
import Table from "@/Components/Table";
import {IoIosArrowForward} from "react-icons/io";

export default function AttendanceIndex() {
    const route = useRoute();
    const {
        data_paginate: {meta, data},
        auth
    } = useTypedPage<{ data_paginate: PaginatedData<Attendance & Team> }>().props;

    const attendanceForm = useForm({status: ''});
    const {put} = attendanceForm;

    const formHandler = (e: React.FormEvent, id: string) => {
        e.preventDefault();
        put(route('attendance.update', {id})).then();
    }

    return (
        <>

            {auth.user?.admin ? (
                <>
                    <div className="mt-10 mb-5 rounded-lg ">
                        <SearchFilter/>
                    </div>
                    <Table>
                        <Table.THead>
                            <Table.Tr>
                                <Table.Th>Nama Projek</Table.Th>
                                <Table.Th>Peserta</Table.Th>
                                <Table.Th srOnly={true}>Aksi</Table.Th>
                            </Table.Tr>
                        </Table.THead>
                        <Table.TBody>
                            {data.map((team: Team, key: number) => (
                                <Table.Tr key={key} className={'hover:bg-gray-50'}>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('attendaceshow', {id: team.id})}
                                                     className="w-full text-left py-3 px-6"
                                                     as={'button'}>
                                            {team?.project
                                                ?
                                                team.project.name
                                                :
                                                <span className="font-bold text-red-500">PROJEK BELUM DISET</span>
                                            }
                                        </InertiaLink>
                                    </Table.Td>
                                    <Table.Td style={{padding: 0}}>
                                        <InertiaLink href={route('attendaceshow', {id: team.id})}
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
                                        <InertiaLink href={route('attendaceshow', {id: team.id})}
                                                     className="w-full text-left py-3 px-6 flex justify-end"
                                                     as={'button'}>
                                            <IoIosArrowForward/>
                                        </InertiaLink>
                                    </Table.Td>
                                </Table.Tr>
                            ))}
                            {data.length === 0 && (
                                <Table.Tr>
                                    <Table.Td className="w-full py-4 text-center bg-white" colSpan={3}>
                                        data tidak tersedia!
                                    </Table.Td>
                                </Table.Tr>
                            )}
                        </Table.TBody>
                    </Table>
                    {/*<div className="flex flex-col">*/}
                    {/*    <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">*/}
                    {/*        <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">*/}
                    {/*            <div*/}
                    {/*                className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50"*/}
                    {/*                style={{maxHeight: '70vh'}}>*/}
                    {/*                <table className="min-w-full">*/}
                    {/*                    <thead className="sticky top-0 bg-gray-50" style={{zIndex: 2}}>*/}
                    {/*                    <tr>*/}
                    {/*                        <th*/}
                    {/*                            scope="col"*/}
                    {/*                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">*/}
                    {/*                            Nama Projek*/}
                    {/*                        </th>*/}
                    {/*                        <th*/}
                    {/*                            scope="col"*/}
                    {/*                            className="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">*/}
                    {/*                            Peserta*/}
                    {/*                        </th>*/}
                    {/*                        <th scope="col" className="relative px-6 py-3">*/}
                    {/*                            <span className="sr-only">Edit</span>*/}
                    {/*                        </th>*/}
                    {/*                    </tr>*/}
                    {/*                    </thead>*/}
                    {/*                    <tbody className="text-sm font-light bg-white divide-y divide-gray-200">*/}
                    {/*                    {data.map((team: Team, key: number) => (*/}
                    {/*                        <tr key={key} className="hover:bg-gray-50">*/}
                    {/*                            <td className="px-6 py-4 whitespace-nowrap">*/}
                    {/*                                {*/}
                    {/*                                    team?.project ?*/}
                    {/*                                        team.project.name*/}
                    {/*                                        :*/}
                    {/*                                        <span*/}
                    {/*                                            className="font-bold text-red-500">PROJEK BELUM DISET</span>*/}
                    {/*                                }*/}
                    {/*                            </td>*/}

                    {/*                            <td className="flex px-6 py-4 whitespace-nowrap">*/}
                    {/*                                {team.apprentices.map((apprentice, idx) => (*/}
                    {/*                                    <img key={idx}*/}
                    {/*                                         className="w-6 h-6 mr-2 transform border border-gray-200 rounded-full cursor-pointer hover:scale-125"*/}
                    {/*                                         src={`/storage/${apprentice?.photo}`}*/}
                    {/*                                         alt={apprentice.jss.username}/>*/}
                    {/*                                ))}*/}
                    {/*                            </td>*/}

                    {/*                            <td className="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">*/}
                    {/*                                <InertiaLink href={route('attendaceshow', {id: team.id})}*/}
                    {/*                                             className="text-gray-600 hover:text-gray-900">*/}
                    {/*                                    Detail*/}
                    {/*                                </InertiaLink>*/}
                    {/*                            </td>*/}
                    {/*                        </tr>*/}
                    {/*                    ))}*/}
                    {/*                    {data.length === 0 && (*/}
                    {/*                        <tr>*/}
                    {/*                            <td className="w-full py-4 text-center bg-white" colSpan={3}>*/}
                    {/*                                data tidak tersedia!*/}
                    {/*                            </td>*/}
                    {/*                        </tr>*/}
                    {/*                    )}*/}
                    {/*                    </tbody>*/}
                    {/*                </table>*/}
                    {/*            </div>*/}
                    {/*        </div>*/}
                    {/*    </div>*/}
                    {/*</div>*/}

                    <div className="px-2">
                        <Pagination meta={meta}/>
                    </div>
                </>
            ) : (
                <>
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
                                                        <br></br>
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
                                                                src={`/storage/${apprentice?.photo}`}/>
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
                                                        <div className="flex text-center">
                                                            {moment().format() >= start_attendance.toString() && (
                                                                status.length === 0 ?
                                                                    <form
                                                                        onSubmit={(event) => formHandler(event, id.toString())}>
                                                                        <button
                                                                            className="px-4 py-1 mx-0 text-gray-600 bg-white border border-gray-300 rounded-md outline-none hover:bg-gray-200 hover:text-gray-600 focus:outline-none">
                                                                            absen
                                                                        </button>
                                                                    </form>
                                                                    :
                                                                    <button
                                                                        className="px-4 py-1 mx-0 bg-gray-200 border border-gray-300 rounded-md outline-none cursor-not-allowed focus:outline-none">
                                                                        absen
                                                                    </button>
                                                            )}
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
                </>
            )}
        </>
    )
}

AttendanceIndex.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
