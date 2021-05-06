@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="paginate">
        <div class="paginate-body-mobile">
            @if ($paginator->onFirstPage())
                <span class="disabled-nav">
                    {!! __('Sebelumnya') !!}
                </span>
            @else
                <button type="button" wire:click="previousPage" class="enable-nav">
                    {!! __('Sebelumnya') !!}
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" class="enable-nav">
                    {!! __('Berikutnya') !!}
                </button>
            @else
                <span class="disabled-nav">
                    {!! __('Berikutnya') !!}
                </span>
            @endif
        </div>

        <div class="paginate-body">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    Menampilkan
                    <span class="font-semibold">{{ $paginator->firstItem() }}</span>
                    -
                    <span class="font-semibold">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-semibold">{{ $paginator->total() }}</span>
                    Data
                </p>
            </div>

            <div class="flex items-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('Sebelumnya') }}">
                        <span class="prev-link-disabled" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </span>
                    </span>
                @else
                    <button type="button" wire:click="previousPage" rel="prev" class="prev-link" aria-label="{{ __('Sebelumnya') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </button>
                @endif
                <span class="container-link">

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="item-link">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="item-link-active">{{ $page }}</span>
                                    </span>
                                @else
                                    <button type="button" wire:click="gotoPage({{ $page }})" class="item-link" aria-label="{{ __('pagination.goto_page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button type="button" wire:click="nextPage" rel="next" class="next-link" aria-label="{{ __('Berikutnya') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </button>
                @else
                    <span aria-disabled="true" aria-label="{{ __('Berikutnya') }}">
                        <span class="next-link-disabled" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        </span>
                    </span>
                @endif
            </div>
        </div>
    </nav>
@endif
