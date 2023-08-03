<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Rent Offers for your properties'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                @if($offers->isNotEmpty())
                    <h5 class="my-4 text-2xl font-semibold">Offers pending</h5>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <div class="pl-4 py-3 bg-indigo-300">
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative mt-1">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                                <input type="text" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Search for items">
                            </div>
                        </div>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
                                    <th scope="col" class="p-4">
                                        Offer Status
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
                                                Show Property
                                            </a>
                                        </td>
                                        <td class="px-4 py-4 pr-2">                                     
                                            <button id="dropdownDefaultButton" data-id = "{{$offer->property->id}}" data-dropdown-toggle="dropdown" class="dropdown_{{$offer->property['id']}} w-24 justify-center flex gap-1 items-center px-2.5 py-1.5 border-yellow-500 border rounded-lg font-medium bg-yellow-100 text-gray-600 hover:text-black" type="button">Pending <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                            </svg></button>
                                            <!-- Dropdown menu -->
                                            <div id="dropdown" class="dropdown_{{$offer->property['id']}} z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-24">
                                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                                <li>
                                                    <button id="{{$offer->property->id}}" class="w-full accept block px-3 py-1.5 hover:text-black hover:font-medium">
                                                        Accept
                                                    </button>
                                                </li>
                                                <li>
                                                    <button id="{{$offer->property->id}}" class="w-full reject block px-3 py-1.5 hover:text-black hover:font-medium">
                                                        Reject
                                                    </button>
                                                </li>
                                                </ul>
                                            </div>
                                            <h5 class="hidden v-status px-4 font-semibold text-green-700" id="accept_{{$offer->property['id']}}">Accepted</h5>
                                            <h5 class="hidden r-status px-4 font-semibold text-red-600" id="reject_{{$offer->property['id']}}">Rejected</h5>
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
                    <a href="/{{$properties[0]->agent->username}}/properties" target="_blank" class="inline-flex items-center font-medium w-[5.1rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Your Ads</a>
                </div>
                @else
                    <div>
                        <p class="text-lg">Agency currently don't have any properties uploaded.</p>
                        <p class="text-lg mb-4">Add a property ad to receive offers.</p>                  
                        <a href="/{{$properties[0]->agent->username}}/properties/new" target="_blank" class="inline-flex items-center font-medium w-[5.25rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Add Now</a>
                    </div>
                @endif
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-admin.layout>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){

    var id = null;
    $('body').on('click','#dropdownDefaultButton', function() {
         id = $(this).attr("data-id");
    });

    $('body').on('click','.accept', function(){
           $.ajax({
            url: '{{ route('accept-offer') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: { id: id },

            success: function(response) {
                $('.dropdown'+ '_'+ id).addClass('hidden')
                $('#accept' + '_'+ id).removeClass('hidden')
            },
            error: function(error) {
                console.error(error);
            }
        });

    })
    $('body').on('click','.reject', function(){
           $.ajax({
            url: '{{ route('reject-offer') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: { id: id },

            success: function(response) {
                $('.dropdown'+ '_'+ id).addClass('hidden')
                $('#reject' + '_'+ id).removeClass('hidden')
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
})
</script>
