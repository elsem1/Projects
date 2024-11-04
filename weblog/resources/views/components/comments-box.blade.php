<div class="w-full md:w-3/4">
    <form action="{{ route('articles.comments.store', $article->id) }}" method="POST">
        @csrf
        <div class="mt-20 mb-3">
            <textarea name="body" class="fs-6 form-control w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700" rows="1" placeholder="Type your comment here..."></textarea>
        </div>
        <div>
            <x-form-button>Post Comment</x-form-button>
        </div>
    </form>
     
    <div class="mt-5">
        @foreach ($article->comments as $comment)
            <div class="p-4 mb-4 bg-gray-800 rounded">
                <p class="text-white font-semibold">{{ $comment->user->name }}</p> 
                <p class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p> 
                <p class="text-gray-200">{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>
</div>
