

<x-layout>

    <div class="ad-page container mx-auto my-8 px-4">
        <!-- Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product Details -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <!-- Title and Meta -->
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">Naam Product</h1>
                    <div class="text-sm text-gray-500 flex justify-between mt-2">
                        <span>Views: 123</span>
                        <span>Likes: 45</span>
                        <span>Datum geplaatst: 25-11-2024</span>
                    </div>
                </div>
                
                <!-- Images -->
                <div class="mb-6">
                    <x-carousel :slides="$slides" />
                </div>
    
                <!-- Pricing and Bidding -->
                <div class="mb-6">
                    <div class="text-xl font-semibold text-gray-800 mb-2">
                        Prijs: €123,00 <span class="text-sm text-gray-600">(vanaf)</span>
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Plaats een bod
                    </button>
                </div>
    
                <!-- Characteristics -->
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-gray-700">Kenmerken</h2>
                    <ul class="mt-2 text-sm text-gray-600">
                        <li>Conditie: Nieuw</li>
                        <li>Kleur: Zwart</li>
                        <li>Maat: L</li>
                        <li>Eigenschappen: Waterdicht</li>
                        <li>Merk: XYZ</li>
                    </ul>
                </div>
    
                <!-- Description -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700">Beschrijving</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        Dit is een voorbeeldbeschrijving van het product. Hier kun je details toevoegen over het gebruik, specificaties, of andere relevante informatie die de koper nodig heeft.
                    </p>
                </div>
            </div>
    
            <!-- Seller Information -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Verkoper</h2>
                    <p class="text-gray-600 mt-2">Naam Verkoper</p>
                    <p class="text-sm text-gray-500">Locatie: Amsterdam</p>
                    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                        Bericht Verkoper
                    </button>
                </div>
    
                <!-- Bidding Section -->
                <div class="border-t pt-4">
                    <h2 class="text-lg font-bold text-gray-800">Biedingen</h2>
                    <ul class="mt-2 text-sm text-gray-600">
                        <li><strong>€110</strong> - Geboden door Jan</li>
                        <li><strong>€105</strong> - Geboden door Lisa</li>
                        <li><strong>€100</strong> - Geboden door Mark</li>
                    </ul>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Doe een bod
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    
</x-layout>