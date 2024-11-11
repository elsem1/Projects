<x-layout>   
   
   <div class="text-center px-6 py-5 mb-6 bg-neutral-950 border-b border-t border-slate-700">
         <h1 class="text-xl md:text-4xl pb-4 text-slate-400">
            {{ $title }}
         </h1>
         <p class="leading-loose text-blue-50">
            {!! $description !!}
       </p>
   </div>
   <div class="container mx-auto max-w-4xl">
      <div class="w-full md:w-3/4 md:pr-12 mb-12 mx-auto">
          @foreach($articles as $article)
          <article class="mb-4 p-4 bg-neutral-950 rounded-lg shadow-lg border border-slate-300">
            @if($article->premium)
            <div class="flex justify-between items-center mb-2">
                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-amber-500 text-yellow-800">
                    <i class="fas fa-star mr-1" style="color: gold;"></i> Premium Content
                </span>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-red-500">
                    <i class="fas fa-lock"></i>
                </span>
            </div>
            @endif         
                  <p href="{{ route('articles.show', $article->id) }}" class="text-gray-200 text-xl md:text-2xl no-underline">
                      {{ $article->title }}
                  </p>
              </h2>

              <div class="mb-4 text-sm text-blue-100">
                  by <a href="#" class="text-blue-400 hover:underline">{{ $article->user->name }}</a> 
                  {{ $article->created_at->diffForHumans() }}
                  <span class="font-bold mx-1"> | </span>
                  
                  @if($article->categories->count())
                      <span>
                          Categor{{ $article->categories_count !== 1 ? 'ies' : 'y' }}:
                          @foreach ($article->categories as $category)
                              <a href="{{ route('categories.show', $category->id) }}" class="text-blue-400 hover:underline">{{ $category->name }}</a>
                              @if (!$loop->last), @endif 
                          @endforeach
                      </span>
                  @endif

                  <span class="font-bold mx-1"> | </span>
                  <a href="#" class="text-blue-400 hover:underline">{{ $article->comments_count }} Comment{{ $article->comments_count !== 1 ? 's' : '' }}</a>
              </div>

              <p class="text-zinc-400 leading-normal">
                  {{ $article->body }}
              </p>
          </article>
          @endforeach
      </div>
   </div>
</x-layout>