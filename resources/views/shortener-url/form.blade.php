<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Url Shortener</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .copy-button {
            position: absolute;
            right: 0;
            top: 0;
            font-weight: bold;
            background-color: gainsboro;
            padding: 9px 21px;

            color: black;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="relative w-3/4 mx-auto px-6">
        <header class="grid grid-cols-1 items-center gap-2 py-8 lg:py-10 lg:grid-cols-1">
            <nav class="-mx-3 flex flex-1 justify-center lg:justify-end">
                @auth
                    <a href="{{ route('url.list') }}"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm md:text-lg">
                        View All Shortened URLs
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow text-sm md:text-lg">
                        Login To Manage Shortened URLs
                    </a>
                @endauth
            </nav>
        </header>
    </div>

    <div class="flex flex-col sm:justify-center items-center mx-5">

        <div class="flex items-center gap-6">
            <a href="/">
                <x-application-logo class="w-10 h-10 lg:w-20 lg:h-20 fill-current text-gray-500" />
            </a>

            <h1 class="text-center lg:mb-3 text-lg lg:text-2xl">URL Shortener</h1>
        </div>

        <div class="w-full sm:max-w-2xl mt-6 px-6 py-10 bg-white bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('url.store') }}">
                @csrf
                <div>
                    <x-input-label for="original_url" :value="__('Your Long URL')" />
                    <x-text-input id="original_url" class="block mt-1 w-full" type="text" name="original_url"
                        :value="old('original_url')" placeholder="https://example.com" required autofocus />
                    <x-input-error :messages="$errors->get('original_url')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="block">
                        {{ __('Generate Short URL') }}
                    </x-primary-button>
                </div>
            </form>

            @session('shortener-url')
                <div class="mt-4">
                    <x-input-label for="short_url" :value="__('Generated Short URL')" />
                    <div class="mt-4 flex items-center gap-3">
                        <x-text-input id="short_url" class="block w-full" type="text" name="short_url"
                            value="{{  url('/') . '/' . session('shortener-url') }}" readonly />
                        <button
                            class="active:bg-gray-300 active:bg-gray-900 bg-gray-200 bg-gray-800 border border-transparent duration-150 ease-in-out font-semibold hover:bg-gray-700 inline-flex items-center ml-2 px-4 py-2 rounded-md text-gray-800 text-white text-xs tracking-widest transition uppercase ml-2"
                            onclick="copyToClipboard()">
                            Copy
                        </button>
                    </div>
                </div>
            @endsession

        </div>
    </div>

    <footer class="text-center mt-6">
        <p class="text-sm text-gray-600 text-gray-400">
            Developed By 
            <a href="https://github.com/mahfuz-rahman007" target="_blank" class="text-blue-500">Mahfujur Rahman</a>
            @2025
        </p>
        <p class="text-sm text-gray-600 text-gray-400">
            <a href="https://www.linkedin.com/in/mahfuzur-rahman-44723728a/" target="_blank" class="text-blue-500">LinkedIn</a>
        </p>
    </footer>

    <script>
        // Copy Short Url to Clipboard
        function copyToClipboard() {
            var copyText = document.getElementById("short_url");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
</body>

</html>
