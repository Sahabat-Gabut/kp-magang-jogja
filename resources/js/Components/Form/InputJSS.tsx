import React, {Dispatch} from 'react'
import axios from "axios";
import Swal from "sweetalert2";

interface PropsInput extends React.HTMLProps<HTMLInputElement> {
    label?: string;
    name: string;
    value: string;
    setValue: any;
    setOverlay: Dispatch<boolean>;
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

export default function InputJSS({label, name, value, setValue, setOverlay, ...props}: PropsInput) {

    const findJSS = () => {
        setOverlay(true);
        setTimeout(() => {
            axios.get(`/getJSS/${value}`)
                .then((res) => {
                    if (res.status === 200) {
                        Toast.fire({
                            // icon: 'success',
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
                })
                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: 'Maaf pengguna JSS tidak ditemukan',
                    });
                    setValue('jss_id', '');
                })
            setOverlay(false);
        }, 1000);
    }

    return (
        <div className="w-full">
            <label htmlFor={name} className="block pb-1 mt-2 text-sm font-semibold text-gray-600">ID
                JSS</label>
            <div className="relative w-full">
                <div className="flex">
                    <button type="button"
                            onClick={findJSS}
                            className="absolute flex items-center h-8 px-3 py-1 mt-2 text-sm text-gray-600 border rounded-md cursor-pointer bg-gray-50 right-1">cari
                    </button>
                    <input
                        {...props}
                        type="text"
                        name={name}
                        id={name}
                        value={value}
                        className={`border rounded-lg px-3 py-2 mt-1 text-sm w-full border-gray-300 focus:outline-none focus:border-green-600`}/>
                </div>
            </div>
        </div>
    );
}