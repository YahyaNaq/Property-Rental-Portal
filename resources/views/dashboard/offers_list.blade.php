<x-layout title="Analytics">
    <div class="min-h-full">
        @include('dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Rent Offers made by you'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @if($offers->isNotEmpty())
                <h1>Total offers</h1>
                @foreach($offers as $offer)
                    <div>
                        <p>{{ $offer['amount'] }}</p>
                    </div>
                @endforeach
            @else
            <div>
                    <p class="text-lg">You haven't made any offers for renting a property.</p>
                    <p class="text-lg mb-4">Search for properties to make an offer.</p>                  
                    <a href="/" target="_blank" class="inline-flex items-center font-medium w-[6.25rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Search Now</a>
                </div>
            @endif
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-layout>
