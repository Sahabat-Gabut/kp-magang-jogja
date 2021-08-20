import {InertiaLink} from "@inertiajs/inertia-react";
import React, {useState} from "react"
import route from "ziggy-js";
import {GuestUserMenu} from "@/Components/Guest";
import {useViewportScroll} from "framer-motion"
import useTypedPage from "@/Hooks/useTypedPage";
import {HiMenu, HiOutlineX} from "react-icons/hi";
import clsx from "clsx";

const GuestHeader = () => {
    const props = useTypedPage().props;
    const ref = React.useRef<HTMLHeadingElement>(null);
    const [dropdownOpen, setDropdownOpen] = useState(false);
    const [y, setY] = React.useState<Number>(0)
    const {height = 0} = ref.current?.getBoundingClientRect() ?? {}
    const {scrollY} = useViewportScroll()

    React.useEffect(() => {
        return scrollY.onChange(() => setY(scrollY.get()));
    }, [scrollY]);

    return (
        <nav ref={ref}
             className={clsx('z-50 fixed w-full transition duration-300 ease-in-out',
                 y > height ? 'bg-green-600 text-white bg-opacity-95' : dropdownOpen ? '' : 'bg-opacity-0',
                 dropdownOpen && 'bg-green-600 text-white bg-opacity-95',
             )}>
            <div className="max-w-screen-xl mx-auto lg:px-4">
                <div className="flex flex-col items-center justify-between py-0 lg:flex-row lg:py-4">
                    <div className="w-full px-4 py-3 lg:w-auto lg:py-0 lg:px-0">
                        <div className="flex items-center justify-between">
                            <InertiaLink className="flex items-center flex-shrink-0 mr-8 font-medium focus:outline-none"
                                         href="/">
                                <img className="h-11" src="/img/logo.webp" alt="magang dinas"/>
                                <div className="flex flex-col">
                                    <span className="ml-2 font-bold uppercase">magang dinas</span>
                                    <span className="ml-2 -mt-2 italic font-normal">kota yogyakarta</span>
                                </div>
                            </InertiaLink>
                            <div className="block lg:hidden">
                                <button type="button"
                                        aria-expanded="false"
                                        onClick={() => {
                                            setDropdownOpen(!dropdownOpen)
                                        }}
                                        className="inline-flex items-center justify-center p-2 text-gray-400 transition">
                                    <div>
                                        {dropdownOpen ?
                                            <HiOutlineX
                                                className={clsx('w-6 h-6', y > height ? 'text-white' : dropdownOpen ? 'text-white' : 'text-gray-600', dropdownOpen && 'text-white')}/>
                                            :
                                            <HiMenu
                                                className={clsx('w-6 h-6', y > height ? 'text-white' : dropdownOpen ? 'text-white' : 'text-gray-600', dropdownOpen && 'text-white')}/>}
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div
                        className="flex-col justify-between hidden w-full p-2 border-t border-gray-800 lg:flex lg:flex-row lg:items-center lg:border-t-0 lg:py-0">
                        <div className="flex flex-col justify-end w-full lg:flex-row lg:items-center"
                             id="headlessui-disclosure-panel-2">
                            <div>
                                {props.auth.user ?
                                    <GuestUserMenu/> :
                                    <div className="flex flex-col lg:flex-row lg:items-center">
                                        <InertiaLink href={route('login')} as="button"
                                                     className={`${y > height ? 'text-white hover:text-gray-100' : 'text-gray-800 hover:text-green-800'} lg:mx-0.5 block tracking-tight py-2 px-4 rounded-lg transition-colors duration-200`}>Masuk</InertiaLink>
                                        <InertiaLink href={route('submission.create')} as="button"
                                                     className={`${y > height ? 'text-white hover:text-gray-100' : 'text-gray-800 hover:text-green-800'} lg:mx-0.5 block tracking-tight py-2 px-4 rounded-lg transition-colors duration-200`}>Daftar</InertiaLink>
                                    </div>
                                }
                            </div>
                        </div>
                    </div>
                </div>
                <div className={clsx('sm:hidden', {
                    block: dropdownOpen,
                    hidden: !dropdownOpen
                }, 'transition duration-300 ease-in-out')}>
                    <div className="pt-2 pb-3 space-y-1 flex flex-col">
                        {props.auth.user ? (
                            <>
                                {props.auth.user && (
                                    <InertiaLink as="button"
                                                 href={route('dashboard')}
                                                 className={'text-left font-semibold lg:mx-0.5 block relative tracking-tight py-2 px-4 rounded-lg transition-colors duration-200'}>
                                        <span>Dasbor</span>
                                    </InertiaLink>
                                )}
                                <InertiaLink as="button"
                                             className={'text-left font-semibold lg:mx-0.5 block relative tracking-tight py-2 px-4 rounded-lg transition-colors duration-200'}
                                             href={route('logout')}
                                             method="post">
                                    <span>Keluar</span>
                                </InertiaLink>
                            </>
                        ) : (
                            <div className="flex flex-col lg:flex-row lg:items-center">
                                <InertiaLink href={route('login')} as="button"
                                             className={clsx(y > height ? 'text-white hover:text-gray-100' : dropdownOpen ? 'text-white' : 'text-gray-600', dropdownOpen && 'text-white', 'text-left lg:mx-0.5 block tracking-tight py-2 px-4 rounded-lg transition-colors duration-200')}>Masuk</InertiaLink>
                                <InertiaLink href={route('submission.create')} as="button"
                                             className={clsx(y > height ? 'text-white hover:text-gray-100' : dropdownOpen ? 'text-white' : 'text-gray-600', dropdownOpen && 'text-white', 'text-left lg:mx-0.5 block tracking-tight py-2 px-4 rounded-lg transition-colors duration-200')}>Daftar</InertiaLink>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </nav>
    )
}

export default GuestHeader;
