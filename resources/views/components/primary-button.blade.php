<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full text-center items-center px-4 py-2 border border-white rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-secondary focus:bg-secondary active:bg-secondary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
