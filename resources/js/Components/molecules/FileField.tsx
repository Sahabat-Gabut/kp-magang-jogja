import { FieldConfig, useField } from 'formik';
import React, { useEffect, useState } from 'react'

type Props = FieldConfig & React.HTMLProps<HTMLInputElement> & { label: string, helperText: string }

const FileField = ({ label, helperText, ...props }: Props) => {
    const [field, meta, helper] = useField(props);

    const { touched, error } = meta;
    const { setValue } = helper;
    const { value } = field;

    const isError = touched && error && true;

    const [fileName, setFileName] = useState<string>(value.name);
    const [file, setFile] = useState<File>(value.file);
    const [src, setSrc] = useState(value.src);

    const _onChange = (event: React.ChangeEvent<HTMLInputElement>) => {
        const { currentTarget } = event;

        if (currentTarget.files) {
            let reader = new FileReader();
            let file = currentTarget.files[0];
            if (file) {
                reader.onloadend = () => setFileName(file.name);
                if (file.name !== fileName) {
                    reader.readAsDataURL(file);
                    setSrc(reader);
                    setFile(file);
                }
            }
        }
    };

    useEffect(() => {
        if (file && fileName && src) {
            setValue({ file: file, src: src, name: fileName, blob: src.result });
        }
    }, [src, fileName, file]);

    return (
        <div className="w-full">
            <label htmlFor={props.name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">{label}</label>
            <div className={`relative h-10 border border-gray-400 border-dashed rounded-lg mt-1 text-sm w-full bg-gray-50 focus:outline-none focus:border-green-600 ${meta.touched && meta.error ? 'border-red-300' : ''}`}>
                <label htmlFor={props.name} className="absolute w-full h-full px-3 py-2 overflow-hidden font-mono text-right cursor-pointer">
                    {file ? <span className="h-4 overflow-hidden overflow-ellipsis whitespace-nowrap">{fileName}</span> : <span className="hover:underline">unggah berkas</span>}
                </label>
            </div>

            <input
                {...props}
                id={props.name}
                name={props.name}
                onChange={_onChange}
                type="file"
                hidden={true} />
            <div className="flex justify-between px-1 pt-2">
                <span className="block pb-1 text-sm text-red-600">{isError && error}</span>
                <span className="block pb-1 text-xs text-right text-gray-600">{helperText}</span>
            </div>
        </div>
    )
}

export default FileField;