<x-app-layout title="Project">
    <div class="">
        <div>
            <h2 class="text-2xl font-semibold leading-tight">{{ __('Project') }}</h2>
        </div>
        <div class="pt-4 overflow-x-auto">
            <div class="tableFixHead inline-block min-w-full rounded-md overflow-hidden border border-gray-300">
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(\Auth::user()->apprenticeTeam)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{\Auth::user()->apprenticeProject->name_project}}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        @foreach (\App\Models\TeamApprentice::find(\Auth::user()->apprenticeProject->team_apprentice_id)->apprentices as $item)
                                            <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125" src="{{ $item->imgSrc }}"/>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="/project/detail/{{ \Auth::user()->apprenticeProject->team_apprentice_id }}" class="text-teal-600">{{__('Show Detail')}}</a>
                                </td>
                            </tr>
                        @endif

                        @if(\Auth::user()->adminDetail)
                            @foreach($team as $key => $t)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ $team[$key]->apprenticeProject->name_project }}
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex items-center">
                                        @foreach ($team[$key]->apprentices as $key => $value)
                                            <img class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125 cursor-pointer" src="{{ $value->imgSrc }}"/>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="/project/detail/{{$t->id}}" class="text-teal-600">{{__('Show Detail')}}</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>