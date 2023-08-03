<x-agent.layout title="Analytics">
    <div class="min-h-full">
        @include('agent/dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Recent views on your properties'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                @if($views->isNotEmpty())
                    <h5 class="my-4 text-2xl font-semibold">Recent Views</h5>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-100 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Property
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Viewed By
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Viewed At
                                    </th>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($views as $view)
                                <tr class="bg-white border-b hover:bg-gray-50 cursor-pointer">
                                        <th scope="row" class="px-6 py-4 font-medium text">
                                            {{ $view->property->title }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $view->user->full_name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $view['updated_at']->diffForHumans() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a 
                                            href="/{{$view->property->agent->username}}/properties/{{$view->property->id}}"
                                            class="font-medium text-green-600 hover:underline">
                                                Show Property
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @elseif($properties->isNotEmpty())
                    <div>
                        <p class="text-lg">You currently don't have any views on your properties.</p>
                        <p class="text-lg mb-4">Check back later.</p>                  
                        <a href="/{{Auth::guard('agents')->user()->username}}/properties/new" target="_blank" class="inline-flex items-center justify-center font-medium w-[8rem] px-3.5 py-2.5 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Your Properties</a>
                    </div>
                @else
                    <div>
                        <p class="text-lg">You haven't uploaded any properties to get views.</p>
                        <p class="text-lg mb-4">Upload a property to be in the game.</p>                 
                        <a href="/{{Auth::guard('agents')->user()->username}}/properties" target="_blank" class="inline-flex items-center font-medium w-[5.1rem] px-3 py-2 text-center rounded-lg text-sm text-white bg-blue-700 hover:bg-blue-800">Your Ads</a>
                    </div>
                @endif
            </div>
        </main>
        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
