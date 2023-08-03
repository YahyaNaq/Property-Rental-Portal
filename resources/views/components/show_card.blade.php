<main> 
    <div class="mx-16 my-6 w-full max-w-4xl shadow bg-white border border-gray-200 rounded-lg">
        <div class="py-5 px-5 pb-5">
            <h5 class="text-3xl font-semibold capitalize tracking-tight text-gray-900 pb-2">{{ $property->title }}</h5>
            <h5 class="text-sm w-max font-medium px-2 py-1 tracking-tight bg-gray-200 rounded-lg text-gray-700">{{ $property->category->name }}</h5>
            <div class="flex items-center gap-6 my-5">
                <a class="flex items-center gap-2">
                    <img src="{{asset("assets/images/dp.jpg")}}" class="h-8 rounded-full" alt="">
                    @if(Auth::guard('admins')->check() || Auth::check() || Auth::guard('agents')->id()==$property['agent_id'])
                        <h5 class="text-md font-medium">{{ $property->agent->full_name }}</h5>
                    @elseif(Auth::guard('agents')->check() || Auth::guest())
                        <h5 class="text-md font-medium">Agent Name</h5>
                    @endif
                </a>
                <h1 class="text-sm text-gray-500">Posted {{ $property['created_at']->diffForHumans() }}</h1>
            </div>
            <div class="flex items-center justify-between">
                <span class="flex items-end gap-x-1 font-semibold text-gray-900">
                    <h1 class="text-lg">PKR</h1>
                    <h5 class="text-3xl">{{ number_format($property['monthly_rent']) }}</h5>
                </span>
                @if(!$property['is_rented'])
                    <a href="/{{$username}}/properties/{{$property['id']}}/make-offer" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Make Offer</a>
                @endif
            </div>
        </div>
        <div class="w-full bg-white rounded-lg">
            <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg" id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
                <li class="mr-2">
                    <a href="#about" id="selected" type="button" onclick="changeTab(event)" class="text-blue-600 border-b-2 border-blue-600 cursor-pointer inline-block font-medium p-4 rounded-tl-lg hover:bg-gray-100">About</a>
                </li>
                {{-- <li class="mr-2">
                    <a type="button" onclick="changeTab(event)" class="cursor-pointer inline-block p-4 hover:text-gray-600 hover:bg-gray-100">Photos</a>
                </li>
                <li class="mr-2">
                    <a type="button" onclick="changeTab(event)" class="cursor-pointer inline-block p-4 hover:text-gray-600 hover:bg-gray-100">Contact</a>
                </li> --}}
            </ul>
            <div>
            {{-- About --}}
                <div id="about" class="max-h-88 overflow-auto p-4 bg-white rounded-lg md:p-8">
                    <p class="text-gray-600">
                        {{ substr($property['description'], 0, 600) }}<span id='more_dots'>...</span>
                        <span id="more_desc" class="hidden">{{ substr($property['description'], 600, 2000) }}</span>
                        <span class="text-black mb-3 font-medium cursor-pointer" onclick="loadMore(event)"> See More</span>
                    </p>
                    <h5 class="text-lg font-semibold mt-6 mb-2">Highlighted details</h5>
                    <div class="flex flex-wrap gap-x-24 gap-2 mb-3 text-gray-600">
                        <div class="flex items-center gap-2">
                            <img src="{{asset("assets/icons/bed.svg")}}" class="grayscale h-4" alt="">
                            <h5 class="mr-2 text-gray-700">Bedrooms</h5>
                            <h5 class="text-gray-800 font-medium">{{ $property['bedrooms'] }}</h5>
                        </div>
                        <div class="flex items-center gap-2">
                            <img src="{{asset("assets/icons/bath.svg")}}" class="h-4" alt="">
                            <h5 class="mr-2 text-gray-700">Bathrooms</h5>
                            <h5 class="text-gray-800 font-medium">{{ $property['bathrooms'] }}</h5>
                        </div>
                        <div class="flex items-center gap-2">
                            <img src="{{asset("assets/icons/area.svg")}}" class="h-[1.158rem]" alt="">
                            <h5 class="mr-2 text-gray-700">Area</h5>
                            <h5 class="text-gray-800 font-medium">{{ $property['area'] }} sq ft</h5>
                        </div>
                        <div class="flex items-center gap-2">
                            <img src="{{asset("assets/icons/location.svg")}}" class="h-4" alt="">
                            <h5 class="mr-2 text-gray-700">Location</h5>
                            <h5 class="text-gray-800 font-medium">{{ $property['location'] }}, {{ $property['city'] }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>              
</main>