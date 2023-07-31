<x-admin.layout title="Analytics">
    <div class="min-h-full">
        @include('admin/dashboard/_nav')
        @include('admin/dashboard/_header', ['heading' => 'Agents Details'])
        <main>
            {{-- {{ dd($properties) }} --}}
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="flex gap-2 items-center">
                    <h5 class="my-4 text-2xl font-semibold">Agents currently registered</h5>
                    <h5 class="text-lg">({{count($agents)}})</h5>
                </div>
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
                                    Full name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Uploaded
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Rented
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agents)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $agents['full_name'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $agents['email'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $agents['properties_uploaded'] }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $agents['properties_rented'] }}
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
