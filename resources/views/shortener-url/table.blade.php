<table class="table-auto min-w-full divide-y divide-gray-200">
    <thead>
        <tr>
            <th class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                No.</th>
            @if ($showUser)
                <th class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                    User</th>
            @endif
            <th class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                New Url</th>
            <th class="px-4 py-3 text-start text-xs font-medium text-gray-500 uppercase max-w-[24rem]">
                Old Url</th>
            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                Clicks</th>
            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                Last Visited</th>
            <th scope="col" class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">
                Created At</th>
            <th class="px-4 py-3 text-end text-xs font-medium text-gray-500 uppercase">
                Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">

        @foreach ($urls as $url)
            <tr class="odd:bg-white even:bg-gray-100 hover:bg-gray-100">
                <td class="px-4 py-3 text-xs">
                    {{ ($urls->currentpage() - 1) * $urls->perpage() + $loop->iteration }}
                </td>
                @if ($showUser)
                    <td class="px-4 py-3 text-xs">
                        {{ $url->user ? $url->user->name : 'Unknown' }}
                    </td>
                @endif
                <td class="px-4 py-3 text-xs">
                    <a href="{{ url('/') . '/' . $url->slug }}" target="_blank"
                        rel="noopener noreferrer">{{ url('/') . '/' . $url->slug }}</a>
                </td>
                <td class="px-4 py-3 text-xs max-w-[20rem] break-words">{{ $url->original_url }}</td>
                <td class="px-4 py-3 text-xs text-center">{{ $url->clicks }}</td>
                <td class="px-4 py-3 text-xs text-center">
                    {{ $url->last_clicked_at ? $url->last_clicked_at->diffForHumans() : 'Not Visited' }}
                </td>
                <td class="px-4 py-3 text-xs">
                    {{ $url->created_at->format('d-m-y h:i a') }}
                </td>
                <td class="px-4 py-3 text-xs">
                    {{-- Link edit and delete button --}}
                    <div class="flex justify-end">
                        <div class="flex gap-2">
                            <form action="{{ route('url.destroy', $url->id) }}" class="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
