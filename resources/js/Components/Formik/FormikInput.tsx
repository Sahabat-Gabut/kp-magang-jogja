import {FieldConfig, useField} from 'formik';
import React from 'react'

type Props = FieldConfig & React.HTMLProps<HTMLInputElement> & { label: string }

const FormikInput = ({label, readOnly, hidden, ...props}: Props) => {
    const [field, meta] = useField(props);

    return (
        <div className="w-full">
            <label htmlFor={props.name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>
            <input {...field}
                   {...props}
                   id={props.name}
                   readOnly={readOnly}
                   className={`border rounded-lg px-3 py-2 mt-1 text-sm w-full border border-gray-300 focus:outline-none focus:border-green-600 ${meta.touched && meta.error ? 'border-red-300' : ''} ${readOnly ? 'bg-gray-100 select-none' : ''}`}
                   hidden={hidden}/>
            <span className="block pb-1 text-sm text-red-600">{meta.touched && meta.error}</span>
        </div>
    )
}

export default FormikInput;