import React, {PropsWithChildren} from 'react';
import clsx from "clsx";

interface TdProps extends React.HTMLProps<HTMLTableCellElement> {
    children?: React.ReactNode,
    className?: string;
}

Table.Td = function Td({children, className = '', ...props}: TdProps) {
    return <td className={clsx("px-6 py-4 whitespace-nowrap", className)} {...props} > {children}</td>
};

Table.TBody = function Tbody({children, className = ''}: PropsWithChildren<{ className?: string }>) {
    return <tbody className={clsx("text-sm bg-white divide-y divide-gray-200", className)}>{children}</tbody>
};

Table.Th = function Th(
    {
        children, srOnly = false, className = ''
    }: PropsWithChildren<{ srOnly?: boolean, className?: string }>) {
    if (srOnly) {
        return <th scope="col" className={clsx("relative px-6 py-3", className)}><span
            className="sr-only">{children}</span>
        </th>
    } else {
        return <th scope="col"
                   className={clsx("px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase", className)}>{children}</th>
    }
}

interface TrProps extends PropsWithChildren<React.HTMLProps<HTMLTableRowElement>> {
    className?: string
}

Table.Tr = function Tr({children, className = '', ...props}: TrProps) {
    return <tr className={className} {...props}>{children}</tr>
}


Table.THead = function Thead({children}: PropsWithChildren<{}>) {
    return <thead className="sticky top-0 bg-gray-50" style={{zIndex: 2}}>{children}</thead>
};

export default function Table({children}: PropsWithChildren<{}>) {
    return (<div className="flex flex-col">
        <div className="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div className="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div
                    className="overflow-hidden overflow-y-auto border border-gray-200 rounded-lg scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-50"
                    style={{maxHeight: '65vh'}}>
                    <table className="min-w-full">
                        {children}
                    </table>
                </div>
            </div>
        </div>
    </div>)
};