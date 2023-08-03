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
                    <div class="flex justify-end items-center gap-x-4 pl-4 py-2 bg-indigo-100">
                        <p class="font-semibold">Create accounts for your new agents</p>
                        <a href="/agent/register" class="text-sm px-3 py-2 font-semibold bg-indigo-700 rounded-lg text-white hover:bg-indigo-900 mr-4">
                            Create
                        </a>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Full name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Uploaded
                                </th>
                                <th scope="col" class="text-center px-6 py-3">
                                    Rented
                                </th>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                    <th scope="row" class="px-6 py-4 font-medium text">
                                        {{ $agent['full_name'] }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $agent['email'] }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $agent['properties_uploaded'] }}
                                    </td>
                                    <td class="text-center px-6 py-4">
                                        {{ $agent['properties_rented'] }}
                                    </td>
                                    <td class="px-4 py-4">
                                        <a 
                                        href="/agent/{{$agent->username}}"
                                        class="font-medium text-green-600 hover:underline">
                                            View Profile
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
