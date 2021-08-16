import { InertiaLink } from '@inertiajs/inertia-react';
import React, { Fragment } from 'react'
import { useDefaultPhoto } from '@/hooks/constants';
import { Popover, Transition } from '@headlessui/react';
import useTypedPage from "@/hooks/useTypedPage";

export default function AppHeader() {
    const props = useTypedPage().props;

    return (
        <header className="sticky top-0 z-10 w-full px-4 pt-4 pb-2 bg-white md:p-6 md:top-0 md:mt-0">
            <div className="flex items-center justify-between h-full mx-auto">
                <div>
                    <button className="p-1 mr-5 -ml-1 text-gray-600 rounded-md lg:hidden focus:outline-none" aria-label="Menu">
                        {/* TODOS: CREATE ICON! */}
                        <svg className="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clipRule="evenodd"></path></svg>
                    </button>
                    <h4 className="hidden pl-2 text-xl font-medium border-l-2 border-green-500 lg:block">
                        {props.title}
                    </h4>
                </div>
                <div className="relative pt-4 pb-2 lg:py-0">
                    <Popover className="relative">
                        {({ open }) => (
                            <>
                                <Popover.Button
                                    className="flex items-center px-4 group focus:outline-none lg:px-0">
                                    <div className="flex flex-col mr-2">
                                        <span className="flex items-center justify-center tracking-tight">{props.auth.user?.username}</span>
                                        <span className="-mt-1 text-xs italic tracking-tight text-right md:text-sm">
                                            {props.auth.user?.admin ? props.auth.user.admin.role.name : props.auth.user?.id}
                                        </span>
                                    </div>
                                    {props.auth.user?.admin ? (
                                        <img className="w-10 h-10 rounded-full"
                                            src={props.auth.user?.admin.photo ? `/storage/${props.auth.user?.admin.photo}` : useDefaultPhoto(props.auth.user?.fullname)}
                                            alt="" />
                                    ) : (props.auth.user?.apprentice ? (
                                        <img className="w-10 h-10 rounded-full"
                                            src={props.auth?.user.apprentice.photo ? `/storage/${props.auth.user?.apprentice.photo}` : useDefaultPhoto(props.auth.user?.fullname)}
                                            alt="" />
                                    ) : (
                                        <img className="w-10 h-10 rounded-full"
                                            src={useDefaultPhoto(props.auth.user?.fullname)}
                                            alt={props.auth.user?.fullname} />
                                    ))}
                                </Popover.Button>
                                <Transition as={Fragment}
                                    enter="transition ease-out duration-200"
                                    enterFrom="opacity-0 translate-y-1"
                                    enterTo="opacity-100 translate-y-0"
                                    leave="transition ease-in duration-150"
                                    leaveFrom="opacity-100 translate-y-0"
                                    leaveTo="opacity-0 translate-y-1">
                                    <Popover.Panel className="absolute z-50 w-56 py-1 mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-sm lg:right-0">
                                        {props.auth.user && (
                                            <InertiaLink as="button" className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                                href="/">
                                                <span>Website</span>
                                            </InertiaLink>
                                        )}
                                        <InertiaLink className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                            href="/logout" method="post" as="button">
                                            <span>Keluar</span>
                                        </InertiaLink>
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
