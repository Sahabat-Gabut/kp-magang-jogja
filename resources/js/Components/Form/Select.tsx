import React from 'react';
import clsx from "clsx";

interface SelectProps extends React.HTMLProps<HTMLSelectElement> {
    label?: string;
    name: string;
    children: React.ReactNode;
}

export default function Select({label, name, children, className, ...props}: SelectProps) {
    return (
        <>
            {label && (
                <label htmlFor={name}
                       className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>
            )}
            <select
                id={name}
                name={name}
                className={clsx('block w-full h-full px-2 pr-8 text-sm leading-tight text-gray-700 bg-white border border-gray-300 rounded-lg appearance-none cursor-pointer focus:ring-0 focus:border-green-500 focus:outline-none focus:bg-white', className)}
                {...props}>
                {children}
            </select>
        </>
    );
}