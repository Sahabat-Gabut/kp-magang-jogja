import classNames from 'classnames';
import React, {PropsWithChildren} from 'react';

type Props = React.DetailedHTMLProps<React.ButtonHTMLAttributes<HTMLButtonElement>,
    HTMLButtonElement>;

export default function SecondaryButton(
    {
        children,
        ...props
    }: PropsWithChildren<Props>) {
    return (
        <button {...props} className={classNames(
            'inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-gray-300 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition',
            props.className,)}>
            {children}
        </button>
    );
}
//inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm