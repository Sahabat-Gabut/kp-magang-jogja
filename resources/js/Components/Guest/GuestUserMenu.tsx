import React, {Fragment} from 'react';
import {InertiaLink} from '@inertiajs/inertia-react';
import {Popover, Transition} from '@headlessui/react';
import {ChevronDownIcon} from '@heroicons/react/solid';
import useTypedPage from "@/Hooks/useTypedPage";

export default function GuestUserMenu() {
    const props = useTypedPage().props;

    return (
        <div className="relative pt-4 pb-2 lg:py-0">
            <Popover className="relative">
                {({open}) => (
                    <>
                        <Popover.Button
                            className="flex items-center px-4 group focus:outline-none lg:px-0">
                            <span>{props.auth.user?.username}</span>
                            <ChevronDownIcon
                                className={`${open ? '' : 'text-opacity-70'} ml-2 h-5 w-5 group-hover:text-opacity-80 transition ease-in-out duration-150`}
                                aria-hidden="true"/>
                        </Popover.Button>
                        <Transition as={Fragment}
                                    enter="transition ease-out duration-200"
                                    enterFrom="opacity-0 translate-y-1"
                                    enterTo="opacity-100 translate-y-0"
                                    leave="transition ease-in duration-150"
                                    leaveFrom="opacity-100 translate-y-0"
                                    leaveTo="opacity-0 translate-y-1">
                            <Popover.Panel
                                className="absolute z-50 w-56 py-1 mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm lg:right-0">
                                {props.auth.user.apprentice.team.status === 'DITERIMA' && (
                                    <InertiaLink as="button"
                                                 className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                                 href="/dashboard">
                                        <span>Dasbor</span>
                                    </InertiaLink>
                                )}
                                {props.auth.user.admin && (
                                    <InertiaLink as="button"
                                                 className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                                 href="/dashboard">
                                        <span>Dasbor</span>
                                    </InertiaLink>
                                )}
                                <InertiaLink
                                    className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                    href="/logout" method="post" as="button">
                                    <span>Keluar</span>
                                </InertiaLink>
                            </Popover.Panel>
                        </Transition>
                    </>
                )}
            </Popover>
        </div>
    )
}
