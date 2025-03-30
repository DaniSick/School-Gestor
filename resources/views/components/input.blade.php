<div class="mt-4">
    <label class="block text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" {{ $attributes->merge(['class' => 'w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring']) }}>
</div>
