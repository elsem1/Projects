@props(['href', 'label', 'active' => false])

<a href="{{ $href }}" class="{{ $active ? 'bg-gray-500 text-white border-black' : 'text-gray-300 hover:bg-blue-200 hover:text-black' }} rounded-md px-3 py-2 text-base font-medium"
   aria-current="{{ $active ? 'page' : 'false' }}">
   {{ $slot }}
</a>
