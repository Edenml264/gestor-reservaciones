<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($service->image_url)
                    <img src="{{ $service->image_url }}" alt="{{ $service->name }}" class="w-full h-64 object-cover">
                @endif
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $service->name }}</h1>
                    <p class="text-gray-600 mb-6">{{ $service->description }}</p>
                    <div class="mb-8">
                        <span class="text-2xl font-bold text-gray-800">${{ number_format($service->price, 2) }}</span>
                    </div>
                    
                    <livewire:reservation-form :service="$service" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
