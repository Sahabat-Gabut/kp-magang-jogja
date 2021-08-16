import React from 'react'
import MainLayoutProps from './interface'
import { MainFooter, MainHeader } from '@/Components/organisms';
// @ts-ignore
import { Head } from '@inertiajs/inertia-react';
import useTypedPage from "@/hooks/useTypedPage";

const MainLayout = (props: MainLayoutProps) => {
    const { children, showFooter = true } = props;
    const { title } = useTypedPage().props
    return (
        <div className="flex flex-col h-screen antialiased tracking-tight text-gray-800 bg-white">
            <Head title={title} />
            <MainHeader />
            <div className="flex-1 pt-16">
                {children}
            </div>
            {showFooter ? <MainFooter /> : ""}
        </div>
    )
}

export default MainLayout;
