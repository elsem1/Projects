<div>
    <form ation="{{ route('comments.store', $article->id)  }}" method="POST">
        @csrf
        <div class=" mt-20 mb-3">
            <textarea name="body" class="fs-6 form-control w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700" rows="1" placeholder="Type your comment here..."></textarea>
        </div>
        <div>
            <button>aasdasd</button>
        </div>
    </form>
    <div class="space-y-6 w-full md:w-3/4 md:pr-12 mb-12">
        @foreach ($article->comments as $comment)
            <div class="p-4 rounded-lg bg-neutral-900 text-slate-200 border border-slate-700">
                <div class="flex items-center justify-between mb-2 text-sm text-slate-400">
                    <span class="font-semibold">{{ $comment->user->name }}</span>
                    <span>{{ $comment->created_at->format('M d, Y \a\t h:i A') }}</span>
                </div>
                <p class="text-base">{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>