<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Verification Requests'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
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
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $property['title'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $property->category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property['location'] }}, {{ $property['city'] }}
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
                                    <td class="px-4 py-4 pr-2">
                                        {{-- <div
                                        onclick="toggleDropdown(event)"
                                        class="w-24 justify-center flex gap-1 items-center px-2.5 py-1.5 border-yellow-500 border rounded-lg font-medium bg-yellow-100 text-gray-600 hover:text-black">
                                            <h5>Pending</h5>
                                            <img src="{{asset("assets/icons/arrow-down.svg")}}" alt="" class="w-4">
                                        </div>
                                        <div class="hidden z-100 absolute mt-1 bg-white shadow p-1 rounded-lg border border-gray-200">
                                            <h5 class="p-1 border-b ">Verify</h5>
                                            <h5 class="p-1 ">Reject</h5>
                                        </div> --}}                                        
                                        <button id="dropdownDefaultButton" data-id = "{{$property['id']}}" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Pending <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                        </svg></button>
                                        <!-- Dropdown menu -->
                                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                            <li>
                                                <a href="#" id="{{$property['id']}}" class="verify block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Verify</a>
                                            </li>
                                            <li>
                                                <a href="#" id="{{$property['id']}}" class="refute block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Refute</a>
                                            </li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
    $('body').on('click','#dropdownDefaultButton', function() {
         id = $(this).attr("data-id");
    });

    $('body').on('click','.verify', function(){
           $.ajax({
            url: 'your_ajax_url', // Replace with your actual AJAX URL
            method: 'POST', // or 'GET', 'PUT', 'DELETE', etc., depending on your backend
            data: { id: id }, // Data to send in the AJAX request
            success: function(response) {
                // Handle the AJAX response here
                console.log(response);
            },
            error: function(error) {
                // Handle the AJAX error here
                console.error(error);
            }
        });
    });

    })

   
})

</script>

