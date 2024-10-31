


<div class="md:w-64 md:sticky md:top-8">
    <aside class="rounded shadow overflow-hidden mb-6 border">
        <h3 class="text-sm bg-slate-300 text-zinc-900 py-3 px-4 font-bold border-b">Popular Categories</h3>
        <div class="p-4">
            <ul class="list-reset leading-normal text-blue-50">
                @foreach ($popularCategories as $category)
                    <li><a href="{{ route('categories.show', $category->id) }}" class="text-sm">{{ $category->name }} ({{ $category->articles_count }})</a></li>
                @endforeach
                <br>
                <li><a href="#" class="text-sm">Uncategorized</a></li>
            </ul>
        </div>
    </aside>
    
    <aside class="rounded shadow overflow-hidden mb-6 border">
        <h3 class="text-sm bg-slate-300 text-zinc-900 py-3 px-4 font-bold border-b">Latest Posts</h3>
        <div class="p-4">
            <ul class="list-reset leading-normal text-blue-50">
                <li><a href="#" class="text-sm">Lorem ipsum dolor sit amet.</a></li>
                <li><a href="#" class="text-sm">Sit amet, consectetur adipisicing elit.</a></li>
                <li><a href="#" class="text-sm">Lorem ipsum dolor sit amet.</a></li>
                <li><a href="#" class="text-sm">Sit amet, consectetur adipisicing elit.</a></li>
            </ul>
        </div>
    </aside>
</div>
