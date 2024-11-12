<x-layout>
    

    <div class="max-w-md mx-auto bg-neutral-950 p-8 rounded-lg shadow-lg border border-slate-500">
        <form action="{{ route('subscribe.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <h2 class="text-2xl font-semibold text-center text-slate-400 mb-1">Sign-up for out premium content</h2>
            <p class="text-center text-sm text-blue-50">Please provide your payment information.</p>

            <div class="space-y-2"> <label for="name" class="block text-lg text-slate-300">Full name</label> 
                <input type="text" name="name" id="name" required class="w-full px-4 py-2 rounded-lg bg-neutral-900 border border-slate-500 text-slate-200 focus:outline-none focus:ring-2 focus:ring-green-500"/> 
                <x-form-error name="name"/> 
            </div>

            <div class="space-y-2"> <label for="bankacc" class="block text-lg text-slate-300">Bank account number</label> 
                <input type="text" name="bankacc" id="bankcc" required class="w-full px-4 py-2 rounded-lg bg-neutral-900 border border-slate-500 text-slate-200 focus:outline-none focus:ring-2 focus:ring-green-500"/> 
                <x-form-error name="bankacc"/> 
            </div> 

            <input type="hidden" name="premium" value="1">

            <div class="mt-8 flex items-center justify-between gap-x-4"> 
                <a href="/" class="text-sm font-semibold text-red-500 hover:text-red-600">
                    Cancel
                </a> 
                <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                    Sign-up now! 
                </button> 
            </div>
        </form>
    </div>
</x-layout>
