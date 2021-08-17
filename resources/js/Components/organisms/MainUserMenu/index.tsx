import React, {Fragment} from 'react';
import {InertiaLink} from '@inertiajs/inertia-react';
import {Popover, Transition} from '@headlessui/react';
import {ChevronDownIcon} from '@heroicons/react/solid';
import useTypedPage from "@/Hooks/useTypedPage";

export default function MainUserMenu() {
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
                                <InertiaLink as="button"
                                             className="block w-full px-4 py-2 text-sm font-medium tracking-tight text-left text-gray-800 transition duration-200 cursor-pointer focus:outline-none hover:text-gray-900 hover:bg-gray-100"
                                             href="/dashboard">
                                    <span>Dasbor</span>
                                </InertiaLink>
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
        // <div className="relative">
        //     <button ref={trigger}
        //         aria-haspopup="true"
        //         onClick={() => setDropdownOpen(true)}
        //         aria-expanded={dropdownOpen}
        //         className="flex items-center text-sm font-medium text-red-500 transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
        //         <span className={`font-medium ${y > height ? 'text-white' : 'text-gray-800'}`}>{props.auth.user?.username}</span>

        //         <div className="ml-1">
        //             <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        //                 <path className={`${y > height ? 'text-white' : 'text-gray-800'}`} fillRule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clipRule="evenodd"></path>
        //             </svg>
        //         </div>
        //     </button>

        //     {dropdownOpen &&
        //         <section className="absolute right-0 z-50 w-48 mt-2 text-gray-700 origin-top-right rounded-md shadow-lg">
        //             <ul ref={dropdown}
        //                 onFocus={() => setDropdownOpen(true)}
        //                 onBlur={() => setDropdownOpen(false)}
        //                 className="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700" aria-label="submenu">
        //                 {props.auth.user?.admin || props.auth.user?.apprentice?.team.status === 'DITERIMA'
        //                     ?
        //                     <>
        //                         <li>
        //                             <InertiaLink className="inline-flex items-center w-full p-2 text-sm font-semibold text-gray-600 transition-colors duration-150 rounded-md hover:bg-green-200 hover:text-green-800"
        //                                 href="/dashboard">
        //                                 <Icons.Home className="w-4 h-4 mr-3" />
        //                                 <span>Dasbor</span>
        //                             </InertiaLink>
        //                         </li>
        //                         <div className="border-t border-gray-300"></div>
        //                     </>
        //                     : ""}
        //                 <li>
        //                     <div onClick={logout}
        //                         className="inline-flex items-center w-full p-2 text-sm font-semibold text-gray-600 transition-colors duration-150 rounded-md cursor-pointer hover:bg-red-200 hover:text-red-800">
        //                         <Icons.Logout className="w-4 h-4 mr-3" />
        //                         Logout
        //                     </div>
        //                 </li>
        //             </ul>
        //         </section>}
        // </div>
    )
}
