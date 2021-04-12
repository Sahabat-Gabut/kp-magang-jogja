<x-app-layout title="Project">
    <div class="px-4">
        <div class="">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">{{ __('Project') }}</h2>
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
                                    Progress
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
                                    {{__('50%')}}
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
    </div>
</x-app-layout>