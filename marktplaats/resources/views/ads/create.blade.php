@include('ads.ad-form', ['categories' => $categories])
<x-layout>
    <div class="create-ad-page container mx-auto my-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <x-adForm
                    :action="route('ads.store')" 
                    method="POST" 
                    :ad="null" 
                    buttonText="Create Ad">
                </x-adForm>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800">Lorem Ipsum</h2>
            </div>
        </div>
    </div>
</x-layout>
