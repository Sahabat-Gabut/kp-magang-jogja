import {InertiaLink, InertiaLinkProps} from '@inertiajs/inertia-react';
import React, {Fragment, useState} from 'react'
import {Popover, Transition} from '@headlessui/react';
import useTypedPage from "@/Hooks/useTypedPage";
import {HiMenu, HiOutlineChevronDown} from "react-icons/hi";
import clsx from "clsx";

const AppHeaderLink = ({href, className, children, ...props}: InertiaLinkProps) => {
    const [, group] = href.split("/");
    const active = window.location.pathname.includes(group);

    return (
        <InertiaLink href={href}
                     {...props}
                     className={clsx('py-2 px-4 text-gray-600 inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:bg-green-200 hover:text-green-800', className, active && 'bg-green-50 border-l-2 border-green-500 text-green-600')}>
            {children}
        </InertiaLink>
    )
};

export default function AppHeader() {
    const props = useTypedPage().props;
    const [showMenu, setShowMenu] = useState(false);
    return (
        <header
            className={clsx('sticky top-0 z-10 w-full pt-4 bg-white md:p-6 md:top-0 md:mt-0 lg:hidden')}>
            <div className="flex items-center justify-between h-full mx-auto px-4 lg:px-0 pb-4 border-b lg:border-b-0">
                <div className="flex items-center text-gray-800 block lg:hidden">
                    <img className="h-8" src="/img/logo.webp" alt="magang dinas"/>
                    <div className="flex flex-col">
                        <span className="ml-2 font-bold uppercase text-sm">magang dinas</span>
                        <span className="ml-2 -mt-2 italic font-normal text-xs">kota yogyakarta</span>
                    </div>
                </div>
                <button className="text-gray-600 rounded-md lg:hidden focus:outline-none"
                        aria-label="Menu" onClick={() => setShowMenu(!showMenu)}>
                    <HiMenu className={'w-5 h-5'}/>
                </button>
            </div>
            {showMenu && (
                <div className={'flex flex-col text-left border-b'}>
                    <AppHeaderLink href={'/dashboard'}>
                        Dasbor
                    </AppHeaderLink>
                    <AppHeaderLink href={'/attendance'}>
                        Absensi
                    </AppHeaderLink>
                    {props.auth.user?.admin && (
                        <>
                            <AppHeaderLink href={'/project'}>
                                Projek
                            </AppHeaderLink>
                            <AppHeaderLink href={'/submission'}>
                                Daftar Pengajuan
                            </AppHeaderLink>
                            {props.auth.user?.admin.role.id !== 3 && (
                                <>
                                    {props.auth.user?.admin.role.id === 1 && (
                                        <AppHeaderLink href={'/agency'}>
                                            Daftar Dinas
                                        </AppHeaderLink>
                                    )}
                                    <AppHeaderLink href={'/admin'}>
                                        Daftar Admin
                                    </AppHeaderLink>
                                    {props.auth.user?.admin.role.id === 2 && (
                                        <AppHeaderLink href={'/agency/setting'}>
                                            Pengaturan Dinas
                                        </AppHeaderLink>
                                    )}
                                </>
                            )}
                        </>
                    )}
                </div>
            )}
            <div
                className={clsx('p-4 border-b lg:border-b-0 lg:hidden text-gray-600 text-sm font-semibold transition-colors duration-150 flex justify-between', showMenu && 'hidden')}>
                <span>
                {props.title}
                </span>
                <div className="relative lg:hidden block">
                    <Popover className="relative">
                        {({open}) => (
                            <>
                                <Popover.Button
                                    className="flex items-center group focus:outline-none lg:px-0">
                                    <div className="flex flex-col mr-2">
                                        <span
                                            className="flex items-center justify-center tracking-tight">{props.auth.user?.username}</span>
                                    </div>
                                    <HiOutlineChevronDown/>
                                </Popover.Button>
                                <Transition as={Fragment}
                                            enter="transition ease-out duration-200"
                                            enterFrom="opacity-0 translate-y-1"
                                            enterTo="opacity-100 translate-y-0"
                                            leave="transition ease-in duration-150"
                                            leaveFrom="opacity-100 translate-y-0"
                                            leaveTo="opacity-0 translate-y-1">
                                    <Popover.Panel
                                        className="absolute z-50 pr-4"
                                        style={{width: '11rem'}}>
                                        <div
                                            className={'py-1 mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm'}>
                                            {props.auth.user && (
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
                                        </div>
                                    </Popover.Panel>
                                </Transition>
                            </>
                        )}
                    </Popover>
                </div>
            </div>
        </header>
    );
}
