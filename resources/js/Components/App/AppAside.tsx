import React from "react"
import AsideLink from "@/Components/App/AsideLink";
import useTypedPage from "@/Hooks/useTypedPage";
import {
    HiBeaker,
    HiClipboardList,
    HiCog,
    HiHome,
    HiKey,
    HiLibrary,
    HiOutlineBeaker,
    HiOutlineClipboardList,
    HiOutlineCog,
    HiOutlineHome,
    HiOutlineKey,
    HiOutlineLibrary,
    HiOutlineTag,
    HiTag
} from "react-icons/hi";

const AppAside = () => {
    const {auth} = useTypedPage().props;
    return (
        <aside className="flex-shrink-0 hidden w-64 overflow-y-auto rounded-md lg:block">
            <div className="py-4 text-gray-500 dark:text-gray-400">
                <div className="flex items-center mt-3 mb-6 ml-6 text-gray-800">
                    <img className="h-11" src="/img/logo.webp" alt="magang dinas"/>
                    <div className="flex flex-col">
                        <span className="ml-2 font-bold uppercase">magang dinas</span>
                        <span className="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
                    </div>
                </div>

                <AsideLink text="Dasbor" href={'/dashboard'} icon={<HiOutlineHome className="w-5 h-5"/>}
                           iconFill={<HiHome className="w-5 h-5"/>}/>

                <div className="mt-2">
                    <label className="ml-6 text-sm font-bold text-gray-600 uppercase">App</label>
                </div>

                <AsideLink text="Absensi" href={'/attendance'} icon={<HiOutlineClipboardList className="w-5 h-5"/>}
                           iconFill={<HiClipboardList className="w-5 h-5"/>}/>
                <AsideLink text="Projek" href={'/project'} icon={<HiOutlineBeaker className="w-5 h-5"/>}
                           iconFill={<HiBeaker className="w-5 h-5"/>}/>

                {/* ADMIN PANEL */}
                {auth.user?.admin && (
                    <>
                        <div className="my-2">
                            <label className="ml-6 text-sm font-bold text-gray-600 uppercase">Admin Panel</label>
                        </div>
                        <AsideLink text="Daftar Pengajuan" href={'/submission'}
                                   icon={<HiOutlineTag className="w-5 h-5"/>}
                                   iconFill={<HiTag className="w-5 h-5"/>}/>
                        {auth.user?.admin.role.id !== 3 && (
                            <>
                                {auth.user?.admin.role.id === 1 && (
                                    <AsideLink text="Daftar Dinas" href={'/agency'}
                                               icon={<HiOutlineLibrary className="w-5 h-5"/>}
                                               iconFill={<HiLibrary className="w-5 h-5"/>}/>
                                )}
                                <AsideLink text="Daftar Admin" href={'/admin'}
                                           icon={<HiOutlineKey className="w-5 h-5"/>}
                                           iconFill={<HiKey className="w-5 h-5"/>}/>
                                {auth.user?.admin.role.id === 2 && (
                                    <AsideLink text="Pengaturan Dinas" href={'/agency/setting'}
                                               icon={<HiOutlineCog className="w-5 h-5"/>}
                                               iconFill={<HiCog className="w-5 h-5"/>}/>
                                )}
                            </>
                        )}
                    </>
                )}
            </div>
        </aside>
    )
}

export default AppAside;
