import React from 'react'
import {MainLayout} from '@/Components/templates'
import {useForm} from '@inertiajs/inertia-react';
import route from 'ziggy-js';
import useTypedPage from "@/Hooks/useTypedPage";

export default function Login() {
    const {errors} = useTypedPage().props;
    const loginForm = useForm({
        username: '',
        password: '',
    });

    const {
        data: {username, password},
        setData,
        processing
    } = loginForm;

    const formHandler = (e: React.FormEvent) => {
        e.preventDefault();
        loginForm.post(route('login')).then();
    }

    return (
        <>
            <main className="flex-col my-10">
                <div className="col-span-6 text-center">
                    <h2 className="mb-2">Login menggunakan Akun Jogja Smart Service</h2>
                    <h4 className="italic">Jika belum punya akun Jogja Smart Service silahkan Register <a
                        className="underline text-emerald-600"
                        href="https://jss.jogjakota.go.id/homepage?register=true">disini</a></h4>
                </div>
            </main>

            <div className="justify-center py-16 banner">
                <div className="container items-center max-w-screen-md mx-auto">
                    <div className="flex justify-center w-full">
                        <div className="flex w-1/2 bg-white divide-y divide-gray-200 rounded-md shadow">
                            <form className="w-full px-5 py-7" onSubmit={formHandler}>
                                <label className="block pb-1 text-sm font-semibold text-gray-600">username</label>
                                <input type="text"
                                       value={username}
                                       onChange={(e) => setData('username', e.target.value)}
                                       className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>
                                {errors?.username && <div className="text-sm text-red-500">{errors.username}</div>}

                                <label className="block pb-1 mt-5 text-sm font-semibold text-gray-600">Kata
                                    Kunci</label>
                                <input type="password"
                                       value={password}
                                       onChange={(e) => setData('password', e.target.value)}
                                       className="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-green-600"/>
                                {errors?.password && <div className="text-sm text-red-500">{errors.password}</div>}

                                <button type="submit"
                                        className={`mt-5 transition duration-200 bg-green-600 hover:bg-green-700 focus:bg-green-700 focus:shadow-sm focus:ring focus:ring-green-600 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block`}
                                        disabled={processing}>
                                    <span className="inline-block mr-2 uppercase">Masuk</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

Login.layout = (page: React.ReactChild) => <MainLayout children={page} showFooter={false}/>;
