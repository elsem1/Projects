<x-layout>
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Message Details</h1>

            <!-- Originele zender -->
            <div class="mb-2">
                <h2 class="text-l font-bold text-gray-700">
                    {{ $originalSender->sender_id === auth()->id() ? 'To:' : 'From:' }} {{ $originalSender->sender->username }}
                </h2>
            </div>

            <div class="mb-3">
                <h3 class="text-l font-semibold text-gray-800">Subject: {{ $message->subject }}</h3>
            </div>

            <!-- Vorige berichten -->
            @if ($previousMessages->isNotEmpty())
                <div class="mb-2">
                    <h2 class="text-l font-bold text-gray-700 mb-4">Conversation</h2>

                    <!-- Voorgaande berichten in zelfde gesprek -->
                    <ul class="divide-y divide-gray-200">
                        @foreach ($previousMessages->reverse() as $prevMessage)
                            <li class="py-4">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $prevMessage->sender->username }}
                                    </h3>
                                    <span class="text-xs text-gray-400">{{ $prevMessage->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <p class="text-sm text-gray-600">{{ $prevMessage->message }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulier voor reactie -->
            <div id="replyForm" class="bg-white shadow-md rounded-lg p-6 hidden">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Reply</h2>
                <form id="replyMessageForm" action="{{ route('messages.reply') }}" method="POST">
                    @csrf

                    <input type="hidden" name="receiver_id" value="{{ $message->sender_id }}">
                    <input type="hidden" name="subject" value="{{ $message->subject }}">
                    <input type="hidden" name="sender_id" value="{{ auth()->id() }}">

                    <div class="mb-6">
                        <textarea id="message" name="message" rows="5" placeholder="Type your message here..." class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                </form>
            </div>

            <!-- Knoppen sectie -->
            <div class="flex justify-between space-x-4">
                <a href="{{ route('messages.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow hover:bg-gray-400">
                    Back
                </a>
                <button id="showReplyForm" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                    Reply
                </button>
            </div>

            <script>
                document.getElementById('showReplyForm').addEventListener('click', function() {
                    var replyForm = document.getElementById('replyForm');
                    var replyMessageForm = document.getElementById('replyMessageForm');

                    // Toon het formulier of verstuur het bericht
                    if (replyForm.classList.contains('hidden')) {
                        replyForm.classList.remove('hidden');
                        // Verander de tekst van de knop naar 'Sent Reply'
                        this.textContent = 'Sent Reply';
                    } else {
                        replyMessageForm.submit();
                    }
                });
            </script>
        </div>
    </div>
</x-layout>
