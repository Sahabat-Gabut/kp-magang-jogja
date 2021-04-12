<x-app-layout title="Detail Project">
    <div class="p-4 border rounded-md bg-white">
        <div class="flex justify-between items-center">
            <span>Aplikasi Absensi Face Recognition</span>
            <button class="bg-green-500 text-white px-4 py-1 rounded-md focus:outline-none">Tambah Planning</button>
        </div>

        <div class="relative pt-1 mt-4">
            <div class="flex mb-2 items-center justify-between">
                <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                    25%
                </span>
                </div>
                <div class="text-right">
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                <div style="width:30%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
            </div>
        </div>

        <div class="flex flex-col">
            <div class="flex justify-between">
                <a href="{{ route('project.upload') }}">Prototyping</a>
                <span>Done</span>
            </div>
            <div class="flex justify-between mt-4">
                <a href="#">Creating Database</a>
                <span>On Progress</span>
            </div>
            <div class="flex justify-between mt-4">
                <a href="#">Code</a>
                <span>On Progress</span>
            </div>
            <div class="flex justify-between mt-4">
                <a href="#">Hosting</a>
                <span>On Progress</span>
            </div>
        </div>

        <div class="mt-10 border-t-2 pt-4">
            <span class="uppercase font-bold mt-2">team</span>
            <div class="flex">
                <div class="flex mt-4 items-center mr-4">
                    <img src="/assets/img/person.webp" class="h-14 w-14 rounded-full" />
                    <div class="flex flex-col ml-4">
                        <span>Maulana Kurnia</span>
                        <span class="-mt-2 italic">IT Support</span>
                    </div>
                </div>
                <div class="flex mt-4 items-center mr-4">
                    <img src="/assets/img/person2.webp" class="h-14 w-14 rounded-full" />
                    <div class="flex flex-col ml-4">
                        <span>Rizaldi Aidinul</span>
                        <span class="-mt-2 italic">IT Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

