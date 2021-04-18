<x-app-layout title="Detail Project">
    <div class="p-4 border rounded-md bg-white">
        <div class="flex justify-between items-center" x-data="{ open: false }">
            <span>{{ $team[0]->apprenticeProject->name_project }}</span>

            <livewire:create-progress-project :id="$team[0]->apprenticeProject->id" :teamid="$team[0]->id">
        </div>
        <div class="relative pt-1 mt-4">
            <div class="flex mb-2 items-center justify-between">
                <div>
                <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-green-600 bg-green-200">
                    {{ $percentage }}%
                </span>
                </div>
                <div class="text-right">
                </div>
            </div>
            <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-green-200">
                <div style="width:{{ $percentage }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-green-500"></div>
            </div>
        </div>

        <div class="pt-4 overflow-x-auto">
            <div class="tableFixHead inline-block min-w-full rounded-md overflow-hidden border border-gray-300">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Planning
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
                        @foreach($progress as $key => $value)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $value->name }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $value->status }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="/project/detail/{{ $team[0]->id }}/{{ $value->id }}/change" class="text-yellow-600 rounded-md px-1 bg-yellow-300 mr-2">
                                        {{__('Perbarui')}}
                                    </a>
                                    <a href="/project/detail/{{ $team[0]->id }}/{{ $value->id }}/remove" class="text-red-600 rounded-md px-1 bg-red-300">
                                        {{__('Hapus')}}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <div class="mt-10 border-t-2 pt-4">
            <span class="uppercase font-bold mt-2">team</span>
            <div class="flex">
                @foreach ($team[0]->apprentices as $key => $value)
                    <div class="flex mt-4 items-center mr-4">
                        <img src="{{ $value->imgSrc }}" class="h-14 w-14 rounded-full" />
                        <div class="flex flex-col ml-2">
                            <span class="font-semibold">{{ implode(' ', array_slice(explode(' ', $team[0]->apprenticeUser[$key]->fullname), 0, 2))."\n" }}</span>
                            <span class="-mt-1 italic">JSS-I{{ $value->jss_id }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

