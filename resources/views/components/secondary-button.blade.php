<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white bg-gray-800 border border-gray-300 border-gray-500 rounded-md font-semibold text-xs text-gray-700 text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
