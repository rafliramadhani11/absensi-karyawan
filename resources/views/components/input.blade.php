<div class="my-3">
    <div class="flex items-center justify-between">
        <label for="{{ $id ?? $name }}" class="block text-sm font-medium leading-6 text-gray-900">
            {{ $label }}
        </label>
        @error($name)
            <p class="text-xs text-red-500 ">{{ $message }}</p>
        @enderror
    </div>

    <div class="relative ">
        <input id="{{ $id ?? $name }}" name="{{ $name }}" autocomplete="{{ $autocomplete ?? $name }}"
            {{ $attributes->merge(['class' => 'block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6']) }}>

        @if ($type === 'password')
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" id="toggle-password"
                onclick="togglePassword()">
                <!-- Eye closed icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5 text-gray-500" id="eye-closed">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>

                <!-- Eye open icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5 text-gray-500" id="eye-open" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>
        @endif
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('{{ $id ?? $name }}');
        const eyeClosedIcon = document.getElementById('eye-closed');
        const eyeOpenIcon = document.getElementById('eye-open');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeClosedIcon.style.display = 'none';
            eyeOpenIcon.style.display = 'block';
        } else {
            passwordInput.type = 'password';
            eyeClosedIcon.style.display = 'block';
            eyeOpenIcon.style.display = 'none';
        }
    }
</script>
