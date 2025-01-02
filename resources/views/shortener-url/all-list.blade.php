<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-gray-200 leading-tight">
            {{ __('List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full align-middle">
                            @if ($urls->count() == 0)
                                <p class="py-12 text-center text-gray-400">No shortened URLs found.</p>
                            @else
                                <div class="overflow-hidden">
                                   
                                    @include('shortener-url.table', ['urls' => $urls, 'showUser' => true])

                                    <div class="mt-5 mb-5 mr-3 ml-3">
                                        {{ $urls->onEachSide(1)->links() }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Delete confirmation
        document.querySelectorAll('.deleteForm').forEach(form => {
            form.addEventListener('submit', event => {
                if (!confirm('Are you sure?')) {
                    event.preventDefault();
                }
            });
        })
    </script>
</x-app-layout>
