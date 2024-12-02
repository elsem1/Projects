<div>
    <input type="hidden" name="showImageUpload" id="showImageUpload" value="0">
    <button type="button" id="toggleImageUpload" class="mb-4 text-blue-500 font-bold hover:underline">
        Add Image
    </button>

    <div id="imageUploadSection" style="display: none;">        

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Image Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $article->image->name ?? '') }}" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" name="description" rows="2"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $article->image->description ?? '') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
            <input type="file" id="image" name="image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
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
