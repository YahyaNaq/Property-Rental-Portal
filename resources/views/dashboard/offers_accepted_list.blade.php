<x-layout title="Analytics">
    <div class="min-h-full">
        @include('dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Rent Offers accepted'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @if($user->property ?? false)
                <h5 class="text-lg font-semibold">
                    You can't select an offer if you have rented a property.
                </h5>
            @elseif($offers_accepted->isNotEmpty())
                <h5 class="mt-3 mb-4 text-2xl font-semibold">Offers accepted</h5>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="pl-4 py-3 bg-indigo-100">
                        <p class="font-semibold">
                            Once your select a property for rent, other offers will be rejected
                        </p>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Property
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Agent Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Message
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rent (Rs)
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Offer (Rs)
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($offers_accepted as $offer)
                            <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $offer->property->title }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $offer->property->agent->full_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $offer['message'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $offer->property->monthly_rent }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $offer['amount_offered'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$offer->property->agent->username}}/properties/{{$offer->property->id}}"
                                        class="font-medium text-teal-700 hover:underline">
                                            Show Property
                                        </a>
                                    </td>
                                    <td class="px-4 py-4">
                                        <form action="{{route('offers.select', ['id' => $offer['id']])}}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-indigo-600 px-3 py-2 font-medium rounded-lg text-white hover:bg-indigo-700">
                                                Select
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif($offers_pending->isNotEmpty())
                <div>
                    <p class="text-lg">The offers you made are still pending.</p>
                    <p class="text-lg mb-4">Try offering higher rent.</p>                  
                    <a href="/" target="_blank" class="inline-flex items-center font-medium w-[6.25rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Search Now</a>
                </div>
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
