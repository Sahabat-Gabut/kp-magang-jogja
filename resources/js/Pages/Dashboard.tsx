import AppLayout from '@/Layouts/AppLayout'
import React from 'react'
import useTypedPage from "@/Hooks/useTypedPage";
import InformationCard from "@/Components/InformationCard";
import {HiOutlineBeaker, HiOutlineChat, HiOutlineShieldCheck, HiOutlineUserGroup} from "react-icons/hi";

export default function Dashboard() {
    const {total_team, total_project, total_submission, total_admin, auth: {user}}
        = useTypedPage<{
        total_team: number;
        total_project: number;
        total_submission: number;
    }>().props;

    return (
        <>
            <h2 className="text-2xl font-extrabold text-gray-900 hidden lg:block border-l-2 pl-3">Dasbor</h2>
            {user?.admin && (
                <div className="grid gap-6 mt-4 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <InformationCard name="Total Tim" count={total_team}
                                     icon={<HiOutlineUserGroup className="w-5 h-5"/>}
                                     iconColor="text-orange-500 bg-orange-100"/>
                    <InformationCard name="Total permohonan magang" count={total_submission}
                                     icon={<HiOutlineChat className="w-5 h-5"/>}
                                     iconColor="text-green-500 bg-green-100"/>
                    <InformationCard name="Total projek" count={total_project}
                                     icon={<HiOutlineBeaker className="w-5 h-5"/>}
                                     iconColor="text-blue-500 bg-blue-100"/>
                    <InformationCard name="Total admin" count={total_admin}
                                     icon={<HiOutlineShieldCheck className="w-5 h-5"/>}
                                     iconColor="text-teal-500 bg-teal-100"/>
                </div>
            )}
        </>
    )
}

Dashboard.layout = (page: React.ReactChild) => <AppLayout children={page}/>;
