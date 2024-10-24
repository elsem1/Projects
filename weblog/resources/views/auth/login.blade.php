<x-layout>

    <form method="POST" action="/login">
    @csrf 
    <span>
        <span class="border-b border-gray-900/10 pb-12">
            <h2 class="text-base font-semibold leading-7 text-zinc-400">Login</h2>
            <p class="mt-1 text-m leading-6 text-blue-50">Please provide your login information.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                    <x-form-label for="email">E-mail</x-form-label>
                <div class="mt-2">
                    <x-form-input name="email" id="email" placeholder="example@email.com" :value="old('email')" ></x-form-input>

                    <x-form-error name="email"/>
                </div>
                </x-form-field>
            </div>
            
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                <x-form-label for="password">Password</x-form-label>
                <div class="mt-2">
                    <x-form-input name="password" id="password" type="password" placeholder="VeryStrongPassword123" ></x-form-input>

                    <x-form-error name="password"/>
                </div>
                </x-form-field>
            </div>

            
        <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="/" class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
        <x-form-button>Login</x-form-button>
        </div>
    </span>
    </form>

</x-layout>



