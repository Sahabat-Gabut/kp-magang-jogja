@php
    function resultContent($content, $word) {
        $replace = '<span style="background-color: #BCF0DA;">' . $word . '</span>'; 
        $content = str_replace( $word, $replace, $content ); 
        return $content;
    }
@endphp
<div class="banner justify-center py-16" style="background: url('/assets/img/hero-bg.png')">
    <div class="container max-w-screen-xl mx-auto items-center">
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative w-full">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-300">
                        <path
                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input 
                    wire:model="searchTerm"
                    placeholder="Cari Dinas"
                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-300 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
        <div class="pt-4 overflow-auto">
            <div class="tableFixHead inline-block min-w-full border border-gray-300 rounded-md overflow-x-hidden" style="max-height: 77vh">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Dinas
                            </th>
                            <th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kuota
                            </th>
                        </tr>
                    </thead>
                    <tbody class="striped">
                        @foreach ($agency as $key => $a)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($searchTerm<>'')
                                {!! resultContent(ucwords(strtolower($a->name)),ucwords($searchTerm)) !!}
                                @else
                                    {!! ucwords(strtolower($a->name)) !!}
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $a->quota }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $agency->links("components.pagination") }}
    </div>
</div>