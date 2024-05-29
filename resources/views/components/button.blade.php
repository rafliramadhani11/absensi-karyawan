<button
    {{ $attributes->class([
            'px-4 py-2 text-white rounded-md',
            'bg-red-600' => $attributes->get('id') === 'hapus',
            'bg-blue-600' => $attributes->get('id') === 'submit',
            'bg-green-600' => !in_array($attributes->get('id'), ['hapus', 'submit']),
        ])->merge(['type' => 'button']) }}>
    {{ $slot }}
</button>
