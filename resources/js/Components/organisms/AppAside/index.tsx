import React from "react"
import Icons from "@/Components/icons"
import AsideLink from "@/Components/molecules/AsideLink";
import { usePage } from "@/hooks/usePage";

const AppAside = () => {
    const { auth } = usePage().props;
    return (
        <aside className="flex-shrink-0 hidden w-64 overflow-y-auto rounded-md lg:block">
            <div className="py-4 text-gray-500 dark:text-gray-400">
                <div className="flex items-center mt-3 mb-6 ml-6 text-gray-800">
                    <img className="h-11" src="/img/logo.webp" alt="magang dinas" />
                    <div className="flex flex-col">
                        <span className="ml-2 font-bold uppercase">magang dinas</span>
                        <span className="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
                    </div>
                </div>

                <AsideLink text="Dasbor" href="/dashboard" icon={<Icons.Home className="w-5 h-5" />} />

                <div className="mt-2">
                    <label className="ml-6 text-sm font-bold text-gray-600 uppercase">App</label>
                </div>

                <AsideLink text="Absensi" href="/attendance" icon={<Icons.ClipboardList className="w-5 h-5" />} />
                <AsideLink text="Projek" href="/project" icon={<Icons.Beaker className="w-5 h-5" />} />

                {/* ADMIN PANEL */}
                {auth.user?.admin && (
                    <>
                        <div className="my-2">
                            <label className="ml-6 text-sm font-bold text-gray-600 uppercase">Admin Panel</label>
                        </div>
                        <AsideLink text="Daftar Pengajuan" href="/submission" icon={<Icons.PaperClip className="w-5 h-5" />} />
                        {auth.user?.admin.role.id !== 3 && (
                            <>
                                {auth.user?.admin.role.id === 1 && (
                                    <AsideLink text="Daftar Dinas" href="/agency" icon={<Icons.Library className="w-5 h-5" />} />
                                )}
                                <AsideLink text="Daftar Admin" href="/admin" icon={<Icons.Key className="w-5 h-5" />} />
                            </>
                        )}
                    </>
                )}
            </div>
        </aside>
    )
}

export default AppAside;
