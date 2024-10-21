<x-layout>
    <x-slot:heading>
       Register
    </x-slot:heading>


<form method="POST" action="/register">
  @csrf 
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-zinc-400">Register a New User</h2>
        <p class="mt-1 text-sm leading-6 text-blue-50">Please provide the required information.</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <x-form-field>
            <x-form-label for="first_name">First Name</x-form-label>
            <div class="mt-2">
                <x-form-input name="first_name" id="first_name" placeholder="John" required></x-form-input>

                <x-form-error name="first_name"/>
            </div>
            </x-form-field>
        </div>
        
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <x-form-field>
            <x-form-label for="last_name">Last Name</x-form-label>
            <div class="mt-2">
                <x-form-input name="last_name" id="last_name" placeholder="Doe" required></x-form-input>

                <x-form-error name="last_name"/>
            </div>
            </x-form-field>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <x-form-field>
            <x-form-label for="email">E-mail</x-form-label>
                <div class="mt-2">
                <x-form-input name="email" id="email" type="email" placeholder="johndoe@example.com" required/>

                <x-form-error name="email"/>
                </div>
            </x-form-field>

            <x-form-field>
            <x-form-label for="email_confirmation">Confirm E-mail</x-form-label>
                <div class="mt-2">
                <x-form-input name="email_confirmation" id="email_confirmation" type="email" placeholder="johndoe@example.com" required/>

                <x-form-error name="email_confirmation"/>
                </div>
            </x-form-field>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <x-form-field>
            <x-form-label for="password">Password</x-form-label>
                <div class="mt-2">
                    <x-form-input name="password" id="password"  type="password" placeholder="password123" required/>        

                <x-form-error name="password"/>
                </div>
            </x-form-field>
        
            <x-form-field>
            <x-form-label for="password_confirmation">Confirm Password</x-form-label>
                <div class="mt-2">
                    <x-form-input name="password_confirmation" id="password_confirmation"  type="password" placeholder="password_confirmation123" required/>        

                <x-form-error name="password_confirmation"/>
                </div>
            </x-form-field>
        </div>
            
    </div>

          
            
          
      
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/" class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
      <x-form-button>Register</x-form-button>
    </div>
  </form>
  
</x-layout>
