import React from "react";

export default function GuestFooter() {
    return (
        <footer className="border-t border-gray-300 w-full relative">
            <div className="flex flex-col py-7 text-white">
                <div
                    className="flex flex-col justify-center container max-w-screen-sm mx-auto items-center lg:flex-row lg:max-w-screen-xl">
                    <span className="text-gray-800">© 2021 Dinas Kominfosandi Yogyakarta. All right reserved. Hak cipta  
                        <a className="text-green-700 hover:text-green-900 hover:underline"
                           href="https://jss.jogjakota.go.id/v3" target="_blank"> Diskominfosan Privacy & Policy.</a>
                    </span>
                </div>
            </div>
        </footer>
    )
}