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
            <div className="flex flex-col flex-1 w-full bg-white rounded-lg shadow lg:mt-3 lg:mb-3 lg:mr-3">
                <Toaster position="top-right"/>
                <main className="h-full overflow-y-auto rounded-t-lg md:mb-6 main-scroll md:mt-3">
                    <AppHeader/>
                    <div className="w-full px-4 pb-8 overflow-hidden min-h-96 md:p-6 md:pt-0">
                        <h4 className="pl-2 text-sm font-medium border-l-2 border-green-500 lg:hidden">
                            {title}
                        </h4>
                        {children}
                    </div>
                </main>
            </div>
        </div>
    )
}
