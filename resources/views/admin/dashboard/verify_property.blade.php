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
                                        id="editbtn" data-id="{{$property->id}}" data-username="{{$property->agent->username}}"
                                        data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                                        {{-- href="/{{$property->agent->username}}/properties/edit/{{$property->id}}" --}}
                                        class="font-medium text-blue-600 hover:text-blue-800">
                                            Edit
                                        </a>
                                    </td>
                                    <td class="px-5 py-4">
                                        <a 
                                        href="/{{$property->agent->username}}/properties/{{$property->id}}"
                                        class="font-medium text-green-600 hover:text-green-800">
                                            Show
                                        </a>
                                    </td>
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

            <!-- Main modal -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-sm max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-gray-50 rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Verify Access
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-6 ml-auto inline-flex justify-center items-center" data-modal-hide="defaultModal">
                                <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 space-y-3">
                            <p class="text-base leading-relaxed text-gray-500">
                                Enter your password below to confirm access
                            </p>
                            <input class="text-sm px-2.5 py-1.5 border-1 rounded-lg border-gray-300 bg-gray-100"
                            type="password" name="password" id="password" placeholder="Your password here" autofocus>
                            <p id="errorMsg" class="hidden mt-1 text-sm leading-6 text-red-600"></p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-3 space-x-2 border-t border-gray-200 rounded-b">
                            <button
                            id="confirm-password"
                            class="text-white text-sm bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg px-4 py-2 text-center">
                                Confirm Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
  
                
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
    var username = null;
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

    $('body').on('click', '#editbtn', function(){
        id = $(this).attr("data-id");
        username = $(this).attr("data-username");
    });
    $('body').on('click', '#confirm-password', function(){
        $.ajax({
            url: '{{ route('confirm-password-edit') }}',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            data: {
                id: id,
                username: username,
                password: document.getElementById('password').value
            },

            success: function(response) {
                console.log('success');
                window.location.href = response.url;
            },
            error: function(error) {
                var errorMsg=document.getElementById('errorMsg');
                errorMsg.classList.remove('hidden');
                errorMsg.textContent=error.responseJSON.error;
            }
        });  
    });

})
</script>

