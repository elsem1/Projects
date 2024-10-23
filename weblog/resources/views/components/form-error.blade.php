@props(['name'])
@error('name')
    <p class="text-xs text-red-700 font-semibold px-3 mt-1.5">{{ $message }}</p>
@enderror