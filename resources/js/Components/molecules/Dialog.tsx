import React from 'react'

interface Props {
    children: React.ReactNode;
    open: boolean;
    onClose: Function;
}

export default function Dialog(props: Props) {
    const { open, onClose } = props;
    if (!open) {
        return <></>;
    } return (
        <div className="fixed inset-0 z-50 flex overflow-hidden">
            <div className="relative flex flex-col w-full p-8 m-auto rounded-lg">
                <div className="flex items-center justify-center min-h-screen text-center sm:block sm:p-0">
                    <div className="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-25 backdrop-filter backdrop-blur-sm" aria-hidden="true"></div>
                    <span className="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    {props.children}
                </div>
            </div>
        </div>
    );
}