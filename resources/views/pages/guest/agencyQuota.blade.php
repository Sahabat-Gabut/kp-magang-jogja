<x-guest-layout title="Pendaftaran Magang">
    <div class="banner justify-center py-16" style="background: url('/assets/img/hero-bg.png')">
        <div class="container max-w-screen-xl mx-auto items-center">
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
                                    {{ $a->name }}
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
        </div>
    </div>
</x-guest-layout>