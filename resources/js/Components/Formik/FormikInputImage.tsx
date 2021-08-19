import {FieldConfig, useField} from 'formik';
import React from 'react'

interface Props extends FieldConfig {
    label: string;
    id?: string;
    readOnly?: boolean;
}

const FormikInputImage = ({label, id, readOnly, ...props}: Props) => {
    const [field, meta] = useField(props);

    return (
        <div className="w-full">
            <label htmlFor={props.name} className="font-semibold text-sm text-gray-600 pb-1 block mt-2">{label}</label>
            <input {...field}
                   {...props}
                   id={props.name}
                   className={`border rounded-lg px-3 py-2 mt-1 text-sm w-full border border-gray-300 focus:outline-none focus:border-green-600 ${meta.touched && meta.error ? 'border-red-300' : ''} ${readOnly ? 'bg-gray-100 select-none' : ''}`}
                   hidden/>
            <span className="text-sm text-red-600 pb-1 block">{meta.touched && meta.error}</span>
        </div>
    )
}

export default FormikInputImage;