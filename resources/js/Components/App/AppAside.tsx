import React, {Fragment} from "react"
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
    HiOutlineSelector,
    HiOutlineTag,
    HiTag
} from "react-icons/hi";
import {Popover, Transition} from "@headlessui/react";
import {useDefaultPhoto} from "@/Hooks";
import {InertiaLink} from "@inertiajs/inertia-react";

const AppAside = () => {
    const {auth} = useTypedPage().props;
    return (
        <aside className="flex-col hidden w-64 overflow-y-auto rounded-md lg:flex">
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
            <Popover className="relative p-6 flex-1 flex flex-col justify-end">
                {({open}) => (
                    <>
                        <Transition as={Fragment}
                                    enter="transition ease-out duration-200"
                                    enterFrom="opacity-0 translate-y-1"
                                    enterTo="opacity-100 translate-y-0"
                                    leave="transition ease-in duration-150"
                                    leaveFrom="opacity-100 translate-y-0"
                                    leaveTo="opacity-0 translate-y-1">
                            <Popover.Panel
                                className="absolute z-50 mx-auto overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm left-0 right-0 w-full"
                                style={{marginBottom: '3.5rem', width: '14rem'}}>
                                {auth.user && (
                                    <InertiaLink as="button"
                                                 className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                                 href="/">
                                        <span>Website</span>
                                    </InertiaLink>
                                )}
                                <InertiaLink
                                    className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                    href="/logout" method="post" as="button">
                                    <span>Keluar</span>
                                </InertiaLink>
                            </Popover.Panel>
                        </Transition>
                        <Popover.Button
                            className="flex items-center group gap-2 focus:outline-none border py-1 pl-2 bg-white rounded-lg justify-between shadow focus:ring-1 focus:ring-green-500">
                            <div className={'flex items-center gap-2'}>
                                {auth.user?.admin ? (
                                    <img className="w-8 h-8 rounded-full hidden lg:block"
                                         src={auth.user?.admin.photo ? `/storage/${auth.user?.admin.photo}` : useDefaultPhoto(auth.user?.fullname)}
                                         alt=""/>
                                ) : (auth.user?.apprentice ? (
                                    <img className="w-8 h-8 rounded-full hidden lg:block"
                                         src={auth?.user.apprentice.photo ? `/storage/${auth.user?.apprentice.photo}` : useDefaultPhoto(auth.user?.fullname)}
                                         alt=""/>
                                ) : (
                                    <img className="w-8 h-8 rounded-full hidden lg:block"
                                         src={useDefaultPhoto(auth.user?.fullname)}
                                         alt={auth.user?.fullname}/>
                                ))}
                                <div className="flex flex-col mr-2">
                                    <span
                                        className="flex items-center justify-center tracking-tight text-sm">
                                        {auth.user?.username}
                                    </span>
                                    <span className="-mt-1 text-xs italic tracking-tight text-left">
                                        {auth.user?.admin ? auth.user.admin.role.name : auth.user?.id}
                                    </span>
                                </div>
                            </div>
                            <span className={'h-full bg-white pr-2 flex items-center'}>
                                <HiOutlineSelector/>
                            </span>
                        </Popover.Button>
                    </>
                )}
            </Popover>
        </aside>
    )
}

export default AppAside;
