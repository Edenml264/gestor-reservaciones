<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-gray-800 mb-6">Nuestros Servicios</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($services as $service)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $service->image_url ?? asset('images/default-service.jpg') }}" 
                     alt="{{ $service->name }}" 
                     class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-gray-800">${{ number_format($service->price, 2) }}</span>
                        <a href="{{ route('services.show', $service) }}" 
                           class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Reservar
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
