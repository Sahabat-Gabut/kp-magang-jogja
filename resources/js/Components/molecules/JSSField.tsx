import axios from 'axios';
import { FieldConfig, useField, useFormikContext } from 'formik';
import React, { useState } from 'react'
import Swal from 'sweetalert2'

type Props = FieldConfig & React.HTMLProps<HTMLInputElement> & { label: string, index?: number }

const swalCustom = Swal.mixin({
    customClass: {
        confirmButton: 'rounded-full bg-green-600 px-4 py-2 text-white font-semibold',
        title: 'text-md font-semibold'
    },
    buttonsStyling: false,
});

const JSSField = ({ label, readOnly, hidden, index, ...props }: Props) => {

    const [field, meta, helper] = useField(props);
    const { setFieldValue } = useFormikContext();
    const { setValue, setTouched } = helper;
    const [overlay, setOverlay] = useState(false);

    const findJSS = () => {
        setOverlay(true);
        if (field.value.length > 0) {
            setTimeout(() => {
                axios.get(`/getJSS/${field.value}`)
                    .then((res) => {
                        if (res.status === 200) {
                            swalCustom.fire({
                                title: 'Data Ditemukan!',
                                html: `<div><div class="flex">
                                            <div>ID JSS : </div>
                                            <div class="ml-5">${res.data.data.id}</div>
                                        </div>
                                        <div class="flex">
                                            <div>Nama : </div>
                                            <div class="ml-5">${res.data.data.name}</div>
                                        </div></div>`
                            });
                        }
                        setFieldValue(`participants.${index}.name`, res.data.data.name);
                    })
                    .catch(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Maaf pengguna JSS tidak ditemukan',
                        });
                        setValue("");
                        setTouched(false);
                        setFieldValue(`participants.${index}.name`, "");
                    })
                setOverlay(false);
            }, 1000);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'ID JSS Harus diisi!',
            })
            setOverlay(false)
        }
    }

    return (
        <div className="w-full">
            <label htmlFor={`jss_id_${props.name}`} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">ID JSS</label>
            <div className="relative w-full">
                <div className="flex">
                    <button type="button" onClick={() => findJSS()} className="absolute flex items-center h-8 px-3 py-1 mt-2 text-sm text-gray-600 border rounded-md cursor-pointer bg-gray-50 right-1">cari</button>
                    <input
                        {...field}
                        {...props}
                        type="text"
                        name={props.name}
                        id={`jss_id_${props.name}`}
                        className={`border rounded-lg px-3 py-2 mt-1 text-sm w-full border-gray-300 focus:outline-none focus:border-green-600 ${meta.touched && meta.error ? 'border-red-300' : ''}`} />
                </div>
                <span className="block pb-1 text-sm text-red-600">{meta.touched && meta.error}</span>
            </div>
            {overlay && (
                <div className="fixed top-0 left-0 right-0 z-50 w-screen h-screen bg-black bg-opacity-50">
                    <div className="flex h-full text-white">
                        <div className="m-auto">
                            sedang mencari akun JSS
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
}

export default JSSField;