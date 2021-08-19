// @ts-ignore
import {Head} from '@inertiajs/inertia-react';
import React, {PropsWithChildren} from 'react'
import {GuestFooter, GuestHeader} from '@/Components/Guest';
import useTypedPage from "@/Hooks/useTypedPage";

const GuestLayout = ({children, showFooter = true}: PropsWithChildren<{
    showFooter?: boolean;
}>) => {
    const {title} = useTypedPage().props;

    return (
        <div className="flex flex-col h-screen antialiased tracking-tight text-gray-800 bg-white">
            <Head><title>{title}</title></Head>
            <GuestHeader/>
            <div className="flex-1 pt-16">
                {children}
            </div>
            {showFooter ? <GuestFooter/> : ""}
        </div>
    )
}

export default GuestLayout;
