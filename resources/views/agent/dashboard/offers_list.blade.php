<x-agent.layout title="Analytics">
    <div class="min-h-full">
        @include('agent/dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Rent Offers for your properties'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                @if($offers->isNotEmpty())
                    <h5 class="my-4 text-2xl font-semibold">Offers pending</h5>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="pl-4 py-3 bg-indigo-100">
                            <p class="text-gray-900 font-semibold">
                                Disclaimer: Wait for the admin to accept or reject offers.
                            </p>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Property
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Client Name
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $offer)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                        <th scope="row" class="px-6 py-4 font-medium text">
                                            {{ $offer->property->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $offer->user->full_name }}
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
                                            class="font-medium text-green-600 hover:underline">
                                                Show
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif($properties->isNotEmpty())
                <div>
                    <p class="text-lg">No pending offers for renting your properties.</p>
                    <p class="text-lg mb-4">Improve your property ads to receive offers.</p>                 
                    <a href="/{{Auth::guard('agents')->user()->username}}/properties" target="_blank" class="inline-flex items-center font-medium w-[5.1rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Your Ads</a>
                </div>
                @else
                    <div>
                        <p class="text-lg">You currently don't have any properties.</p>
                        <p class="text-lg mb-4">Add a property ad to receive offers.</p>                  
                        <a href="/{{Auth::guard('agents')->user()->username}}/properties/new" target="_blank" class="inline-flex items-center font-medium w-[5.25rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Add Now</a>
                    </div>
                @endif
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
