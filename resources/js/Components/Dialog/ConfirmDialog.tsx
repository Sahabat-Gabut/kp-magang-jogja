import React from 'react'
import Dialog from './Dialog';

interface Props {
    title: string;
    children: React.ReactNode;
    open: boolean;
    onClose: Function;
    onConfirm: Function;
    confirmText?: string;
    confirmClass?: string;
}
export default function Confirm(props: Props) {
    const { open, onClose, title, children, onConfirm, confirmText, confirmClass = 'text-white bg-green-600 hover:bg-green-700 focus:ring-green-500' } = props;
    if (!open) {
        return <></>;
    }

    return (
        <Dialog open={open} onClose={onClose}>
            <div className="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div className="px-4 pt-5 pb-4 break-words whitespace-pre-wrap bg-white sm:p-6 sm:pb-4">
                    <h2 className="text-xl">{title}</h2>
                    {children}
                </div>
                <div className="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button onClick={() => { onClose(); onConfirm(); }} className={`${confirmClass} inline-flex justify-center w-full px-4 py-2 text-base font-medium border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm`}>
                        {confirmText ? confirmText : 'Ya'}
                    </button>
                    <button onClick={() => onClose()} type="button" className="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </Dialog >
    );
}