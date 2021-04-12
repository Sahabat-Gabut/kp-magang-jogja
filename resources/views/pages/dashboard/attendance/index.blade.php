<x-app-layout title="Attendance">
    <div class="px-4">
        <div class="">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">{{ __('Attendance') }}</h2>
            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pt-4 overflow-x-auto">
                <div class="tableFixHead inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr class="text-xs font-semibold border-b border-gray-300 tracking-wide text-left text-gray-500 uppercase dark:border-gray-700 bg-gray-50">
                                <th
                                    class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Date
                                </th>
                                <th
                                    class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th
                                    class="px-5 py-3 border-b border-gray-300 z-20 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    27 Maret 2021 | 07:30 - 08:00
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                                        on time
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <button class="disabled:opacity-25 disabled:cursor-default text-green-600" onclick="alert('berhasil absen!')" disabled>Attendance</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    27 Maret 2021 | 07:30 - 08:00
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200">
                                        late
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="#" class="text-green-600">Attendance</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    27 Maret 2021 | 07:30 - 08:00
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="#" class="text-green-600">Attendance</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>