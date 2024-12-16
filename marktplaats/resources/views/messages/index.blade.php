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

                <div class="mb-4">
                    <h2 class="text-lg font-bold text-gray-700 mb-2 pl-4">My Messages</h2>
                    <ul class="divide-y divide-gray-200">
                        @foreach ($conversations as $subject => $messages)
                            @php
                                $lastMessage = $messages->first();
                                $conversationPartner =
                                    $lastMessage->sender_id == Auth::id()
                                        ? $lastMessage->receiver->username
                                        : $lastMessage->sender->name;
                            @endphp
                            <li
                                class="flex items-center py-4 pl-6 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <span class="mr-3 text-xl">
                                    @if (!$lastMessage->is_read)
                                        <span class="text-blue-500">•</span>
                                    @else
                                        <span class="invisible">•</span> <!-- Placeholder voor opmaak -->
                                    @endif
                                </span>
                                <a href="{{ route('messages.show', $lastMessage->id) }}"
                                    class="flex-1 flex items-center space-x-4 no-underline">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center">
                                            <h2 class="font-bold text-gray-800">{{ $conversationPartner }}</h2>
                                            <span
                                                class="text-sm text-gray-500 pr-6">{{ $lastMessage->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <h3 class="text-sm text-gray-600">Subject: {{ $subject }}</h3>
                                        </div>
                                        <p class="text-sm italic text-gray-600">Last message:
                                            {{ Str::limit($lastMessage->message, 100) }}</p>
                                    </div>
                                </a>
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
