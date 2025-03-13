@if ($paginator->hasPages())
    <nav class="flex items-center justify-between mt-6">
        <ul class="inline-flex space-x-2">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded-l-lg cursor-not-allowed">❮ Prev</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 transition ease-in-out">❮
                        Prev</a>
                </li>
            @endif

            <!-- Pagination Links -->
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span
                            class="px-4 py-2 text-gray-500 bg-white border border-gray-300 cursor-default">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span
                                    class="px-4 py-2 text-white bg-blue-600 border border-blue-600 rounded-full">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-100 transition ease-in-out">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 transition ease-in-out">Next
                        ❯</a>
                </li>
            @else
                <li>
                    <span class="px-4 py-2 text-gray-400 bg-gray-200 rounded-r-lg cursor-not-allowed">Next ❯</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
