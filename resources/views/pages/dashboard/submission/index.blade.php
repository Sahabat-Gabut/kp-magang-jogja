<x-app-layout title="Submission">
    <div class="px-4">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">{{ __('List Submission') }}</h2>
            </div>
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-l border block w-full bg-white border-gray-400 border-r-0 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option>5</option>
                            <option>10</option>
                            <option>20</option>
                        </select>
                    </div>
                    <div class="relative">
                        <select
                            class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                            <option>All</option>
                            <option>Procees</option>
                            <option>Accepted</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                </div>
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 overflow-x-auto">
                <div class="tableFixHead inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Project Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    User
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Agency
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{__('Aplikasi Absensi Face Recognition')}}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125" src="/assets/img/person.webp"/>
                                        <img class="w-6 h-6 rounded-full border-gray-200 border -m-1 transform hover:scale-125" src="/assets/img/person2.webp"/>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{__('Dinas Komunikasi Informatika dan Persandian Yogyakarta')}}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="/project/detail" class="text-teal-600">{{__('Show Detail')}}</a>
                                </td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</x-app-layout>