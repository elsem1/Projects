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
          <div class="sm:col-span-4">
            <label for="title" class="block text-sm font-bold leading-6 text-gray-200">Title</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="title" id="title" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-100 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="But Sniffer" required>
              </div>

              @error('title')
              <p class="text-xs text-red-700 font-semibold px-3 mt-1.5">{{ $message }}</p>
              @enderror

            </div>
          </div>
          

          <div class="sm:col-span-4">
            <label for="salary" class="block text-sm font-bold leading-6 text-gray-200">Salary</label>
            <div class="mt-2">
              <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                <input type="text" name="salary" id="salary" class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-100 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="€ 45.000" required>
              </div>

              @error('salary')
              <p class="text-xs text-red-700 font-semibold px-3 mt-1.5">{{ $message }}</p>
              @enderror

            </div>
          </div>
          

          <div class="sm:col-span-4">
            <label for="job_description" class="block text-sm font-bold leading-6 text-gray-200">Job description</label>
            <div class="mt-2">
              <textarea id="job_description" name="job_description" rows="3" class="block w-full rounded-md border-0 py-1.5 px-3 bg-zinc-200 text-stone-800 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Tell us something about the job" required></textarea>                
              </textarea> 
              
              @error('job_description')
              <p class="text-xs text-red-700 font-semibold px-3 mt-1.5">{{ $message }}</p>
              @enderror

            </div>
          </div>
          
      
  
    <div class="mt-6 flex items-center justify-end gap-x-6">
      <a href="/jobs" type="button" class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>
  
</x-layout>

