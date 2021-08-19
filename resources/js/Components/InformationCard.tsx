import React from 'react'

interface IProps {
    name: string
    count: Number | undefined
    icon: React.ReactNode
    iconColor: string
}

export default function InformationCard({name, count = 0, icon, iconColor}: IProps) {
    return (
        <div className="flex items-center p-4 bg-white rounded-lg shadow-sm border border-gray-200">
            <div className={`p-3 mr-4 rounded-full ${iconColor}`}>
                {icon}
            </div>
            <div>
                <p className="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                    {name}
                </p>
                <p className="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    {count}
                </p>
            </div>
        </div>
    );
}
