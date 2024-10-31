<x-layout>
    <!-- Login Form -->
    <form method="POST" action="/login" class="max-w-md mx-auto bg-neutral-900 p-8 rounded-lg shadow-lg">
        @csrf 

        <!-- Form Header -->
        <div class="border-b border-gray-900/10 pb-8">
            <h2 class="text-2xl font-semibold text-center text-slate-400 mb-1">Login</h2>
            <p class="text-center text-sm text-blue-50">Please provide your login information.</p>
        </div>

        <!-- Email Field -->
        <div class="mt-8">
            <x-form-field>
                <x-form-label for="email" class="text-lg text-slate-300">E-mail</x-form-label>
                <div class="mt-2">
                    <x-form-input name="email" id="email" placeholder="example@email.com" :value="old('email')" class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                    <x-form-error name="email"/>
                </div>
            </x-form-field>
        </div>

        <!-- Password Field -->
        <div class="mt-6">
            <x-form-field>
                <x-form-label for="password" class="text-lg text-slate-300">Password</x-form-label>
                <div class="mt-2">
                    <x-form-input name="password" id="password" type="password" placeholder="YourPassword123" class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                    <x-form-error name="password"/>
                </div>
            </x-form-field>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex items-center justify-between gap-x-4">
            <a href="/" class="text-sm font-semibold text-red-500 hover:text-red-600">Cancel</a>
            <x-form-button class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                Login
            </x-form-button>
        </div>
    </form>
</x-layout>
