<x-layout>
    <div class="content-wrapper max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <x-title>
            <x-slot:title>
                Messages Overveiw
            </x-slot:title>
            <x-slot:description>
                Sent and reviece messages
            </x-slot:description>
        </x-title>
    </div>

        <div class="messages-page container mx-auto my-8 px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">                    
                    
    
                    <!-- Messages List -->
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-gray-700 mb-4">Your Messages</h2>
                        <ul class="space-y-4">
                            @foreach ($messages as $message)
                                <li class="p-4 bg-gray-50 rounded-md shadow">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-bold text-gray-800">{{ $message->subject }}</h3>
                                        <span class="text-sm text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mt-2">{{ $message->body }}</p>
                                    <div class="mt-4 flex justify-end">
                                        <a href="{{ route('messages.index', $message->id) }}" class="text-blue-500 hover:underline">
                                            View Details
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
    
                <!-- Sidebar -->
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Message Actions</h2>
                        <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                            Compose New Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-layout>
