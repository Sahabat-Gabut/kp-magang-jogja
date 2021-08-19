import React from 'react';
import {GuestLayout} from "@/Layouts";
import Table from "@/Components/Table";
import {useTypedPage} from "@/Hooks";

export default function AgencyShow() {
    const {agencies} = useTypedPage().props;
    return (
        <>
            <div className="flex flex-col h-full">
                <div className="pt-16 pb-16 -mt-16 bg-fixed border-b"
                     style={{backgroundImage: 'url("/img/noisy_grid.png")'}}>
                    <div
                        className="container flex items-center justify-between max-w-screen-md px-5 py-16 mx-auto text-left md:px-0 lg:max-w-screen-xl">
                        <span className="text-lg font-semibold text-gray-700 md:text-2xl">Kuota Magang</span>
                    </div>
                </div>
                <div className="flex justify-center w-full">
                    <div className="container max-w-screen-xl">
                        <div className="relative w-full -mt-16 bg-white shadow-lg rounded-xl">
                            <Table>
                                <Table.THead>
                                    <Table.Tr>
                                        <Table.Th>Dinas</Table.Th>
                                        <Table.Th>Kuota</Table.Th>
                                    </Table.Tr>
                                </Table.THead>
                                <Table.TBody>
                                    {agencies.map((agency, key) => (
                                        <Table.Tr key={key}>
                                            <Table.Td>{agency.name}</Table.Td>
                                            <Table.Td>{agency.quota}</Table.Td>
                                        </Table.Tr>
                                    ))}
                                </Table.TBody>
                            </Table>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

AgencyShow.layout = (page: React.ReactChild) => <GuestLayout showFooter={false} children={page}/>;