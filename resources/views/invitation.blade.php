<x-guest-layout>
    <div class="flex flex-col items-center text-center space-y-6">
        @php
            $isSuccess = $message[0] === 'success';
        @endphp

        <div class="p-3 {{ $isSuccess ? 'bg-green-100' : 'bg-red-100' }} rounded-full">
            @if ($isSuccess)
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            @else
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            @endif
        </div>

        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
            {{ $isSuccess ? 'Félicitations !' : 'Oups !' }}
        </h2>

        <p class="text-gray-600 leading-relaxed max-w-sm">
            {{ $message[1] }}
        </p>

        <div class="pt-4 w-full">
            <a href="{{ url('/') }}" class="inline-block w-full">
                <x-primary-button class="w-full justify-center">
                    {{ __('Retour à l\'accueil') }}
                </x-primary-button>
            </a>
        </div>
    </div>
</x-guest-layout>
