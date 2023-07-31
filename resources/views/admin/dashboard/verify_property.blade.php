<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Agency analytics'])
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
                                    City
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Views
                                </th>
                                <th scope="col" class="text-center p-4">
                                    <h5>Status</h5>
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
                                    <td class="px-6 py-4">
                                        <a 
                                        href="/{{$property->user->username}}/properties/edit/{{$property->id}}"
                                        class="font-medium text-blue-600 hover:underline">
                                            Edit
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
