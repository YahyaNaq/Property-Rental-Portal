<x-agent.layout title="Add a new Property">
    <section class="min-h-full">
        @include('agent/properties/_nav', ['username' => Auth::guard('agents')->user()->username])
        @include('dashboard/_header', ['heading' => 'Add a new Property'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form action="{{route('store', ['username' => $username ])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">A quick tip</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Add HD images and a good description to stand out.</p>
        
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                {{-- Title --}}
                                <div class="sm:col-span-4">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="text" name="title" id="title" value="{{old('title')}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="for ex: 3rd floor apartment at a reasonable price">
                                        </div>
                                    </div>

                                    @error('title')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                {{-- Description --}}
                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" value="{{ old('description') }}" rows="8" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"
                                        placeholder="Share your ideas on a topic."
                                        >{{ old('description') }}</textarea>
                                    </div>

                                    @error('description')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Category --}}
                                <div class="sm:col-span-3">
                                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                    <div class="mt-2">
                                        <select id="category" name="category" value="{{ old('category') }}" autocomplete="category-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        @foreach($categories as $category)
                                            <option>{{ $category }}</option>  
                                        @endforeach
                                        </select>
                                    </div>

                                    @error('category')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Location --}}
                                <div class="sm:col-span-3">
                                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Location</label>
                                    <div class="mt-2">
                                      <select id="location" name="location" value="{{ old('location') }}" autocomplete="location-name" class="block w-full h-10 overflow-y-auto rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        @foreach($locations as $location)
                                            <option>
                                                {{ $location->name }}
                                            </option>
                                        @endforeach    
                                      </select>
                                    </div>

                                    @error('location')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div> 

                                {{-- Area --}}
                                <div class="sm:col-span-3">
                                    <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Area (sq yards)</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="area" id="area" value="{{old('area')}}" step="10" min="80" max="60500" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Total area of your property">
                                        </div>
                                    </div>

                                    @error('area')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Monthly rent --}}
                                <div class="sm:col-span-3">
                                    <label for="monthly_rent" class="block text-sm font-medium leading-6 text-gray-900">Monthly rent (Rs)</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="monthly_rent" id="monthly_rent" value="{{old('monthly_rent')}}" step="1000" min="10000" max="1000000000" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add a realistic and reasonable rent">
                                        </div>
                                    </div>

                                    @error('monthly_rent')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Bedrooms --}}
                                <div class="sm:col-span-3">
                                    <label for="bedrooms" class="block text-sm font-medium leading-6 text-gray-900">Bedrooms</label>
                                    <div class="mt-2">
                                      <select id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}" autocomplete="bedrooms-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option>Studio</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>3+</option>    
                                      </select>
                                    </div>

                                    @error('bedrooms')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                {{-- Bathrooms --}}
                                <div class="sm:col-span-3">
                                    <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Bathrooms</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="bathrooms" id="bathrooms" min="1" max="10" value="{{ old('bathrooms') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Number of bathrooms">
                                        </div> 
                                    </div>

                                    @error('bathrooms')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="/dashboard" class="rounded-md bg-gray-300/[0.7] py-2 px-3 text-sm font-semibold text-black">Cancel</a>
                        <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </form>
            </div>
        </main>        
    </section>
</x-agent.layout>
