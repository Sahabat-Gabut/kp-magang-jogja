import React from 'react';
import {GuestLayout} from "@/Layouts";

export default function SubmissionSuccess() {
    return (
        <>
            <div className="flex flex-col h-full">
                <div className="pt-16 pb-16 -mt-16 bg-fixed border-b"
                     style={{backgroundImage: 'url("/img/noisy_grid.png")'}}>
                    <div
                        className="container flex items-center justify-between max-w-screen-md px-5 py-16 mx-auto text-left md:px-0 lg:max-w-screen-xl">
                    </div>
                </div>
                <div className="flex justify-center w-full">
                    <div className="container max-w-screen-xl">
                        <div className="relative w-full -mt-16 bg-white shadow-lg rounded-xl">
                            <div className={'bg-white w-full p-10 text-center rounded-lg'}>
                                <h3>Selamat anda berhadil mendaftar!</h3>
                                <span>Mohon menunggu sampai pengajuan anda dikonfirmasi oleh pihak dinas terkait!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}

SubmissionSuccess.layout = (page: React.ReactChild) => <GuestLayout showFooter={false} children={page}/>;