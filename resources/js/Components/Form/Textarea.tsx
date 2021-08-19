import React from 'react';

interface PropsTextarea extends React.HTMLProps<HTMLTextAreaElement> {
    label?: string;
    name: string;
    children?: React.ReactNode;
}

export default function Textarea({label, name, children, ...props}: PropsTextarea) {
    return (
        <>
            {label &&
            <label htmlFor={name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>}
            <textarea id={name}
                      name={name}
                      className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"
                      {...props}>{children}</textarea>
        </>
    )
}