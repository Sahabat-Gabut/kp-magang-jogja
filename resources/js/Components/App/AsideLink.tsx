import {InertiaLink} from '@inertiajs/inertia-react';
import React from 'react'

type IAsideLink = {
    href: string;
    icon: React.ReactNode;
    iconFill: React.ReactNode;
    text: string;
}

const AsideLink = (props: IAsideLink) => {
    const [, group] = props.href.split("/")
    const active = window.location.pathname.includes(group);
    return (
        <li className="relative">
            <InertiaLink href={props.href}
                         className={`py-3 px-6 text-gray-600 inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:bg-green-200 hover:text-green-800 ${active ? 'bg-green-100 border-l-4 border-green-600 text-green-800' : ''}`}>
                {active ? props.iconFill : props.icon}
                <span className="ml-4">{props.text}</span>
            </InertiaLink>
        </li>
    );
}

export default AsideLink;
