<x-layout>
    <!-- Registration Form -->
    <div class="max-w-2xl mx-auto py-8 px-4 bg-neutral-900 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-slate-400">Register a New User</h2>
        <p class="text-center text-sm text-blue-50 mt-1 mb-8">Please provide the required information.</p>
        
        <form method="POST" action="/register" class="space-y-6">
            @csrf 

            <!-- Username Field -->
            <div>
                <x-form-label for="name" class="text-lg text-slate-300">Username</x-form-label>
                <x-form-input name="name" id="name" placeholder="John Doe" required class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                <x-form-error name="name"/>
            </div>

            <!-- Email Fields -->
            <div>
                <x-form-label for="email" class="text-lg text-slate-300">E-mail</x-form-label>
                <x-form-input name="email" id="email" type="email" placeholder="johndoe@example.com" required class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                <x-form-error name="email"/>
            </div>
            
            <div>
                <x-form-label for="email_confirmation" class="text-lg text-slate-300">Confirm E-mail</x-form-label>
                <x-form-input name="email_confirmation" id="email_confirmation" type="email" placeholder="johndoe@example.com" required class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                <x-form-error name="email_confirmation"/>
            </div>

            <!-- Password Fields -->
            <div>
                <x-form-label for="password" class="text-lg text-slate-300">Password</x-form-label>
                <x-form-input name="password" id="password" type="password" placeholder="YourPassword123" required class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                <x-form-error name="password"/>
            </div>
            
            <div>
                <x-form-label for="password_confirmation" class="text-lg text-slate-300">Confirm Password</x-form-label>
                <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="YourPassword123" required class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"/>
                <x-form-error name="password_confirmation"/>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex items-center justify-between gap-x-4">
                <a href="/" class="text-sm font-semibold text-red-500 hover:text-red-600">Cancel</a>
                <x-form-button class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">Register</x-form-button>
            </div>
        </form>
    </div>
</x-layout>
