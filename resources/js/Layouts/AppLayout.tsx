// @ts-ignore
import {Head} from '@inertiajs/inertia-react';
import toast, {Toaster} from 'react-hot-toast';
import useTypedPage from "@/Hooks/useTypedPage";
import React, {PropsWithChildren, useEffect} from 'react'
import {AppAside, AppHeader} from '@/Components/App';

export default function AppLayout({children}: PropsWithChildren<{}>) {
    const {title, flash} = useTypedPage().props;
    useEffect(() => {
        flash.type && toast.success(flash.message)
    });

    return (
        <div className="flex h-screen bg-gray-50 dark:bg-gray-900">
            <Head><title>{title}</title></Head>
            <AppAside/>
            <div className="flex flex-col flex-1 w-full lg:bg-white shadow lg:mr-3">
                <Toaster position="top-right" reverseOrder={true}/>
                <main className="h-full overflow-y-auto rounded-t-lg md:mb-6 main-scroll md:mt-3">
                    <AppHeader/>
                    <div className="w-full p-4 overflow-hidden min-h-96 md:p-6 mt-0 lg:mt-5 lg:mt-0">
                        {children}
                    </div>
                </main>
            </div>
        </div>
    )
}
