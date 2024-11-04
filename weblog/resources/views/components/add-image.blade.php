<div>
    <input type="hidden" name="showImageUpload" id="showImageUpload" value="0">
    <button type="button" id="toggleImageUpload" class="mb-4 text-green-500 font-bold hover:underline">
        Add Image
    </button>

    <div id="imageUploadSection" style="display: none;">
        <h2 class="text-xl md:text-2xl text-slate-300 mb-4">Upload Image</h2>

        <div class="mb-6">
            <x-form-label for="name" class="block text-lg md:text-xl font-semibold text-slate-400">Image Name:</x-form-label>
            <input type="text" id="name" name="name" value="{{ old('name', $article->image->name ?? '') }}"
            
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <x-form-label for="description" class="block text-lg md:text-xl font-semibold text-slate-400">Description:</x-form-label>
            <textarea id="description" name="description" rows="2"
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                {{ old('description', $article->image->description ?? '') }}</textarea>
        </div>

        <div class="mb-6">
            <x-form-label for="image" class="block text-lg md:text-xl font-semibold text-slate-400">Image:</x-form-label>
            <input type="file" id="image" name="image"
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
    </div>
</div>

<script>
    document.getElementById('toggleImageUpload').addEventListener('click', function() {
        var imageUploadSection = document.getElementById('imageUploadSection');
        var showImageUploadInput = document.getElementById('showImageUpload');
        
        if (imageUploadSection.style.display === 'none') {
            imageUploadSection.style.display = 'block';
            showImageUploadInput.value = '1'; 
        } else {
            imageUploadSection.style.display = 'none';
            showImageUploadInput.value = '0'; 
        }
    });
</script>
