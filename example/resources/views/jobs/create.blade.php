<x-layout>
    <x-slot:heading>
       Create Job
    </x-slot:heading>


<form method="POST" action="/jobs">
  @csrf <!-- Dit is nodig voor verificatie zodat de user ook echt de user is, deze krijgt een unieke token toegewezen. Moet altijd gebruikt worden voor veiligheid -->
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-zinc-400">Create a new job</h2>
        <p class="mt-1 text-sm leading-6 text-blue-50">Please provide the required job information.</p>
  
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="title">Title</x-form-label>
            <div class="mt-2">
              <x-form-input name="title" id="title" placeholder="But Sniffer" required></x-form-input>

              <x-form-error name="title"/>
            </div>
          </x-form-field>
        </div>
          

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="salary">Salary</x-form-label>
              <div class="mt-2">
                <x-form-input name="salary" id="salary" placeholder="€ 50.000" required></x-form-input>

                <x-form-error name="salary"/>
              </div>
            </x-form-field>
        </div>
          
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <x-form-field>
            <x-form-label for="job_description">Job description</x-form-label>
              <div class="mt-2">
                <textarea name="job_description" 
                          id="job_description" 
                          rows="3"                          
                          class="block w-full rounded-md border-0 py-1.5 px-3 bg-zinc-200 text-stone-800 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                          placeholder="Tell us something about the job" required></textarea>

                <x-form-error name="job_description"/>
              </div>
        </x-form-field>
      </div>

          
            
          
      
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/jobs" type="button" class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
      <x-form-button>Save</x-form-button>
    </div>
  </form>
  
</x-layout>

