import Icons from '@/Components/icons';
import CardInfo from '@/Components/organisms/CardInfo';
import AppLayout from '@/Components/templates/AppLayout'
import { usePage } from '@/hooks/usePage';
import React from 'react'

export default function Dashboard() {
    const { total_team, total_project, total_submission, total_admin, auth: { user } } = usePage().props;

    return (
        <>
            {user?.admin && (
                <div className="grid gap-6 mt-4 mb-8 md:grid-cols-2 xl:grid-cols-4">
                    <CardInfo name="Total Tim" count={total_team} icon={<Icons.UserGroup className="w-5 h-5" />} iconColor="text-orange-500 bg-orange-100" />
                    <CardInfo name="Total permohonan magang" count={total_submission} icon={<Icons.Chat className="w-5 h-5" />} iconColor="text-green-500 bg-green-100" />
                    <CardInfo name="Total projek" count={total_project} icon={<Icons.Beaker className="w-5 h-5" />} iconColor="text-blue-500 bg-blue-100" />
                    <CardInfo name="Total admin" count={total_admin} icon={<Icons.ShieldCheck className="w-5 h-5" />} iconColor="text-teal-500 bg-teal-100" />
                </div>
            )}
        </>
    )
}

Dashboard.layout = (page: React.ReactChild) => <AppLayout children={page} />;
