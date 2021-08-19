import { InertiaLink } from '@inertiajs/inertia-react';
import React from 'react'

type IAsideLink = {
    href: string
    icon: React.ReactNode
    text: string
}

const AsideLink = (props: IAsideLink) => {
    const [, group] = props.href.split("/")
    const active = window.location.pathname.includes(group);
    return (
        <li className="relative px-6 py-1">
            <InertiaLink href={props.href}
                className={`p-2 text-gray-600 rounded-md inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:bg-green-200 hover:text-green-800 ${active ? 'bg-green-200' : ''}`}>
                {props.icon}
                <span className="ml-4">{props.text}</span>
            </InertiaLink>
        </li>
    );
}

export default AsideLink;
