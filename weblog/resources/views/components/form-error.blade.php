@props(['name'])

@error($name)
    <p class="text-s text-red-700 font-semibold mt-1.5">{{ $message }}</p>
@enderror