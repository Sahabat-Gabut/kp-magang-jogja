import classNames from 'clsx';
import React, {PropsWithChildren} from 'react';

type Props = React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>,
    HTMLButtonElement>;

export default function SuccessButton(
    {
        children,
        ...props
    }: PropsWithChildren<Props>) {
    return (
        <button {...props} className={classNames(
            'inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 rounded-md font-semibold text-xs text-white focus:ring-offset-2 uppercase tracking-widest shadow-sm focus:outline-none focus:border-green-300 focus:ring-2 focus:ring-green-500 active:text-green-800 active:bg-gray-50 disabled:opacity-25 transition',
            props.className,)}>
            {children}
        </button>
    );
}
