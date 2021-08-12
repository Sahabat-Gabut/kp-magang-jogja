import { FieldConfig, useField } from 'formik';
import React from 'react'
import { useEffect } from 'react';
import { useState } from 'react';

type Props = FieldConfig & React.HTMLProps<HTMLInputElement> & { label?: string }

const ImageField = ({ label, readOnly, ...props }: Props) => {
    const [field, meta, helper] = useField(props);

    const { touched, error } = meta;
    const { value } = field;
    const { setValue } = helper;

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
    }, [src, fileName, file])

    return (
        <div className="mr-5 h-36 w-36">
            <div className="relative flex">
                <label htmlFor={props.name} className="relative cursor-pointer group">
                    <div className={`relative flex mx-auto pb-5 bg-gray-100 border rounded-lg h-36 w-36 ${isError ? 'border-red-300' : 'border-gray-300'}`}>
                        <span className={`flex w-full bg-gray-100 rounded-lg h-32 ${file && src && 'hidden'}`}>
                            <svg className="mx-auto w-36 h-36" fill="#b1b2b6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clipRule="evenodd"></path></svg>
                        </span>
                        {file && src && <img src={src.result} alt={file.name} className="object-cover w-full rounded-lg h-36" />}
                        <div className="absolute mx-auto rounded-lg h-36 w-36 md:mx-0 group-hover:bg-black group-hover:bg-opacity-20"></div>
                        <div className="absolute flex w-full h-full opacity-0 group-hover:opacity-100">
                            <svg className="w-6 h-6 m-auto" fill="none" stroke="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                </label>
            </div>
            <span className="block pb-1 text-sm text-red-600">{isError && error}</span>
            <input
                {...props}
                type="file"
                hidden={true}
                id={props.name}
                name={props.name}
                onChange={_onChange} />
        </div>
    )
}

export default ImageField;