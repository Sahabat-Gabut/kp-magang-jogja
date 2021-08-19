import React from 'react';

interface PropsInput extends React.HTMLProps<HTMLInputElement> {
    label?: string;
    name: string;
}

export default function Input({label, name, ...props}: PropsInput) {
    return (
        <>
            {label &&
            <label htmlFor={name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>}
            <input id={name}
                   name={name}
                   className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"
                   {...props}/>
        </>
    )
}