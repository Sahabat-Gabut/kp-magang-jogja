import React, {PropsWithChildren} from 'react';
import Modal, {ModalProps} from '@/Components/Dialog/Modal';

DialogModal.Content = function DialogModalContent(
    {
        title,
        children,
    }: PropsWithChildren<{ title: string }>) {
    return (
        <div className="p-6">
            <div className="text-xl font-semibold">{title}</div>

            <div className="mt-4 text-gray-600 text-sm">{children}</div>
        </div>
    );
};

DialogModal.Footer = function DialogModalFooter(
    {
        children,
    }: PropsWithChildren<Record<string, unknown>>) {
    return <div className="px-6 py-4 bg-gray-100 text-right">{children}</div>;
};

export default function DialogModal(
    {
        children,
        ...modalProps
    }: PropsWithChildren<ModalProps>) {
    return <Modal {...modalProps}>{children}</Modal>;
}