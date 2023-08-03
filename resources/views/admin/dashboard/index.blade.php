<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Agency analytics'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="flex flex-wrap gap-x-8 mb-16 gap-y-3">
                    <h5 class="basis-full my-4 text-2xl font-semibold">Total number of properties</h5>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-sky-100 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsUp }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-indigo-200 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsRented }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-sky-100 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently uploaded</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/upload.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyUp }}</h5>
                        </div>
                    </div>
                    <div class="text-gray-800 min-w-48 w-64 text-right px-4 py-4 bg-indigo-200 shadow-lg rounded-lg">
                        <h5 class="text-sm pb-1">Currently rented</h5>
                        <div class="flex justify-between items-center">
                            <img class="w-14" src="{{asset("assets/icons/housekey.svg")}}" alt="">
                            <h5 class="text-4xl font-bold">{{ $noOfPropsCurrentlyRented }}</h5>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 items-center">
                    <h5 class="my-4 text-2xl font-semibold">Properties currently uploaded</h5>
                    <h5 class="text-lg">({{count($properties)}})</h5>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center gap-4 pl-4 py-3 bg-indigo-100">
                        <p class="mb-0.5 text-gray-900 font-semibold">
                            Note: Following list also includes the properties that are not verified.
                        </p>
                        <a
                        href="/admin/dashboard/verify-property" class="flex items-center font-semibold rounded-lg text-indigo-900 hover:scale-[1.03]">
                            <h5 class="mb-0.5">Go to verification page</h5>
                            <img src="{{asset('assets/icons/arrow-chevron-right.svg')}}" alt="" class="w-4">
                        </a>
                    </div>
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
                                    City
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Views
                                </th>
                                <th scope="col" class="text-center p-4">
                                    Status
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
                            @foreach($properties as $property)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $property['title'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $property->category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property['location'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $property['city'] }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        {{ $property->views->count() }}
                                    </td>
                                    <td class="w-4 p-4 ">
                                        {{ $property->is_rented ? 'Rented' : 'Vacant'; }}
                                    </td>
                                    @if(!$property['is_rented'])
                                        <td class="px-6 py-4">
                                            <a 
                                            href="/{{$property->agent->username}}/properties/edit/{{$property->id}}"
                                            class="font-medium text-blue-600 hover:underline">
                                                Edit
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-6 py-4"></td>
                                    @endif
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->agent->username}}/properties/{{$property->id}}"
                                        class="font-medium text-green-600 hover:underline">
                                            Show
                                        </a>
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
