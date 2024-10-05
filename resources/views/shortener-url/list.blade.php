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
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                No.</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                New Url</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                                Old Url</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                Clicks</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                Last Visited</th>
                                            <th scope="col"
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($urls as $url)
                                            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100 odd:bg-neutral-800 even:bg-neutral-700 hover:bg-neutral-700">
                                                <td class="px-6 py-4 text-sm">{{ ($urls->currentpage() - 1) * $urls->perpage() + $loop->iteration }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    <a href="{{ url('/') . '/' . $url->slug }}" target="_blank" rel="noopener noreferrer">{{ url('/') . '/' . $url->slug }}</a>
                                                </td>
                                                <td class="px-6 py-4 text-sm">{{ $url->original_url }}</td>
                                                <td class="px-6 py-4 text-sm">{{ $url->clicks }}</td>
                                                <td class="px-6 py-4 text-sm">{{  $url->last_clicked_at ? $url->last_clicked_at->diffForHumans() : 'Not Visited' }}</td>
                                                <td class="px-6 py-4 text-sm">
                                                    {{-- Link edit and delete button --}}
                                                    <div class="flex justify-end">
                                                        <div class="flex gap-2">
                                                            <a href="{{ route('url.edit', $url->id) }}">
                                                                <button
                                                                    class="text-blue-500 hover:text-blue-700 mr-2">Edit</button>
                                                            </a>
                                                            <form action="{{ route('url.destroy', $url->id) }}" class="deleteForm"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="text-red-500 hover:text-red-700">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 mr-3 ml-3">
                                    {{ $urls->onEachSide(1)->links() }}
                                </div>
                            </div>
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
