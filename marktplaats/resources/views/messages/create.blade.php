<x-layout>
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Send a Message</h1>

            <div class="mb-2">
                <h2 class="text-l font-bold text-gray-700">To: {{ $receiver->name }}</h2>
            </div>

            <div class="mb-3">
                <h3 class="text-l font-semibold text-gray-800">Subject: {{ $subject }}</h3>
            </div>

            <div id="messageForm" class="bg-white shadow-md rounded-lg p-6">
                <form id="sendMessageForm" action="{{ route('messages.store') }}" method="POST">
                    @csrf

                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <input type="hidden" name="subject" value="{{ $subject }}">

                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700">Message:</label>
                        <textarea id="message" name="message" rows="5" placeholder="Type your message here..." class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('ads.show', $ad->id) }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                            Back
                        </a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
