<x-agent.layout title="Analytics">
    <div class="min-h-full">
        @include('agent/dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Rent Offers for your properties'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                @if($offers->isNotEmpty())
                    @foreach($offers as $offer)
                        <div>
                            {{$offer}}
                        </div>
                    @endforeach
                @elseif($properties->isNotEmpty())
                    <div>
                        <p class="text-lg">You currently don't have any properties.</p>
                        <p class="text-lg mb-4">Add a property ad to receive offers.</p>                  
                        <a href="/{{Auth::guard('agents')->user()->username}}/properties/new" target="_blank" class="inline-flex items-center font-medium w-[5.25rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Add Now</a>
                    </div>
                @else
                    <div>
                        <p class="text-lg">No pending offers for renting your properties.</p>
                        <p class="text-lg mb-4">Improve your property ads to receive offers.</p>                 
                        <a href="/{{Auth::guard('agents')->user()->username}}/properties" target="_blank" class="inline-flex items-center font-medium w-[5.1rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Your Ads</a>
                    </div>
                @endif
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
