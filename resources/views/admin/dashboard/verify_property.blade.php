<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Verification Requests'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            @if($properties->isNotEmpty())
                <div class="flex gap-2 items-center">
                    <h5 class="my-4 text-2xl font-semibold">Properties with verification pending</h5>
                    <h5 class="text-lg">({{count($properties)}})</h5>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Category
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Location
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Agent name
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                                <th scope="col" class="p-4">
                                    Verification
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer" >
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $property['title'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $property->category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property->location->name }}, {{ $property->location->city->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property->agent->full_name }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <a 
                                        href="/{{$property->agent->username}}/properties/edit/{{$property->id}}"
                                        class="font-medium text-blue-600 hover:text-blue-800">
                                            Edit
                                        </a>
                                    </td>
                                    {{-- <td class="px-5 py-4">
                                        <a 
                                        href="/{{$property->agent->username}}/properties/edit/{{$property->id}}"
                                        class="font-medium text-blue-600 hover:text-blue-800">
                                            Show
                                        </a>
                                    </td> --}}
                                    <td class="px-4 py-4 pr-2">                                     
                                        <button id="dropdownDefaultButton" data-id = "{{$property['id']}}" data-dropdown-toggle="dropdown" class="w-24 justify-center flex gap-1 items-center px-2.5 py-1.5 border-yellow-500 border rounded-lg font-medium bg-yellow-100 text-gray-600 hover:text-black dropdown_{{$property['id']}}" type="button">Pending <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg></button>
                                        <!-- Dropdown menu -->
                                        <div id="dropdown" class="dropdown_{{$property['id']}} z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-24">
                                            <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                            <li>
                                                <button id="{{$property['id']}}" class="w-full verify block px-3 py-1.5 hover:text-black hover:font-medium">
                                                    Verify
                                                </button>
                                            </li>
                                            <li>
                                                <button id="{{$property['id']}}" class="w-full reject block px-3 py-1.5 hover:text-black hover:font-medium">
                                                    Reject
                                                </button>
                                            </li>
                                            </ul>
                                        </div>
                                        <h5 class="hidden v-status px-4 font-semibold text-green-700" id="verify_{{$property['id']}}">Verified</h5>
                                        <h5 class="hidden r-status px-4 font-semibold text-red-600" id="reject_{{$property['id']}}">Rejected</h5>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div>
                    <h5 class="text-lg font-semibold">No properties to verify.</h5>
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

    $('body').on('click','.verify', function(){
           $.ajax({
            url: '{{ route('verify-property') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: { id: id },

            success: function(response) {
                $('.dropdown'+ '_'+ id).addClass('hidden')
                $('#verify' + '_'+ id).removeClass('hidden')

            },
            error: function(error) {
            }
        });

    })
    $('body').on('click','.reject', function(){
           $.ajax({
            url: '{{ route('reject-property') }}',
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

