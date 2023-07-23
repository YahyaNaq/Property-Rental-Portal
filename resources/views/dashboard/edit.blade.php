<x-layout title="Edit a Property">
    <section class="min-h-full">
        @include('dashboard/_nav')
        @include('dashboard/_header', ['heading' => 'Edit a Property'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form action="{{route('update', ['id' => $property['id'] ])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">A quick tip</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Add HD images and a good description to stand out.</p>
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                    <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="text" name="title" id="title" value="{{ old('title') ?? $property['title'] }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="for ex: 3rd floor apartment at a reasonable price">
                                        </div>
                                    </div>

                                    @error('title')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-full">
                                    <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                    <div class="mt-2">
                                        <textarea id="description" name="description" value="{{ old('description') ?? $property['description'] }}" rows="8" class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:py-1.5 sm:text-sm sm:leading-6"
                                        placeholder="Share your ideas on a topic."
                                        >{{ old('description') ?? $property['description'] }}</textarea>
                                    </div>

                                    @error('description')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- category --}}
                                <div class="sm:col-span-3">
                                    <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
                                    <div class="mt-2">
                                        <select id="category" name="category" value="{{ old('category') ?? $property['category'] }}" autocomplete="category-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                            @foreach($categories as $category)
                                            <option {{ old('category') ?? $property->category->name == $category ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>  
                                        @endforeach
                                      </select>
                                    </div>

                                    @error('category')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- city --}}
                                <div class="sm:col-span-3">
                                    <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                    <div class="mt-2">
                                      <select id="city" name="city" value="{{ old('city') ?? $property['city'] }}" autocomplete="city-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option {{ old('city') ?? $property['city']=="Karachi" ? 'selected' : '' }}>Karachi</option>
                                        <option {{ old('city') ?? $property['city']=="Lahore" ? 'selected' : '' }}>Lahore</option>
                                        <option {{ old('city') ?? $property['city']=="Islamabad" ? 'selected' : '' }}>Islamabad</option>
                                        <option {{ old('city') ?? $property['city']=="Peshawar" ? 'selected' : '' }}>Peshawar</option>
                                        <option {{ old('city') ?? $property['city']=="Quetta" ? 'selected' : '' }}>Quetta</option>    
                                      </select>
                                    </div>

                                    @error('city')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- location --}}
                                <div class="sm:col-span-3">
                                    <label for="location" class="block text-sm font-medium leading-6 text-gray-900">Location</label>
                                    <div class="mt-2">
                                      <select id="location" name="location" value="{{ old('location') ?? $property['location'] }}" autocomplete="location-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option {{ old('location') ?? $property['location']=="North Nazimabad" ? 'selected' : '' }}>North Nazimabad</option>
                                        <option {{ old('location') ?? $property['location']=="Gulshan-e-Iqbal" ? 'selected' : '' }}>Gulshan-e-Iqbal</option>
                                        <option {{ old('location') ?? $property['location']=="Gulshan-e-Maymar" ? 'selected' : '' }}>Gulshan-e-Maymar</option>
                                        <option {{ old('location') ?? $property['location']=="Fb-area" ? 'selected' : '' }}>Fb-area</option>
                                        <option {{ old('location') ?? $property['location']=="Gulistan-e-Johar" ? 'selected' : '' }}>Gulistan-e-Johar</option>    
                                      </select>
                                    </div>

                                    @error('location')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- area --}}
                                <div class="sm:col-span-3">
                                    <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Area (sq yards)</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="area" id="area" value="{{ old('area') ?? $property['area'] }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Total area of your property">
                                        </div>
                                    </div>

                                    @error('area')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- monthly rent --}}
                                <div class="sm:col-span-3">
                                    <label for="monthly_rent" class="block text-sm font-medium leading-6 text-gray-900">Monthly rent (Rs)</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="monthly_rent" id="monthly_rent" value="{{ old('monthly_rent') ?? $property['monthly_rent'] }}" step="1000" min="10000" max="1000000000" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add a realistic and reasonable rent">
                                        </div>
                                    </div>

                                    @error('monthly_rent')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- bedrooms --}}
                                <div class="sm:col-span-3">
                                    <label for="bedrooms" class="block text-sm font-medium leading-6 text-gray-900">Bedrooms</label>
                                    <div class="mt-2">
                                      <select id="bedrooms" name="bedrooms" value="{{ old('bedrooms') ?? $property['bedrooms'] }}" autocomplete="bedrooms-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                        <option {{ old('bedrooms') ?? $property['bedrooms']=="Studio" ? 'selected' : '' }}>Studio</option>
                                        <option {{ old('bedrooms') ?? $property['bedrooms']=="1" ? 'selected' : '' }}>1</option>
                                        <option {{ old('bedrooms') ?? $property['bedrooms']=="2" ? 'selected' : '' }}>2</option>
                                        <option {{ old('bedrooms') ?? $property['bedrooms']=="3" ? 'selected' : '' }}>3</option>
                                        <option {{ old('bedrooms') ?? $property['bedrooms']=="3+" ? 'selected' : '' }}>3+</option>    
                                      </select>
                                    </div>

                                    @error('bedrooms')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- bathrooms --}}
                                <div class="sm:col-span-3">
                                    <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Bathrooms</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="bathrooms" id="bathrooms" min="1" max="10" value="{{ old('bedrooms') ?? $property['bathrooms'] }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Number of bathrooms">
                                        </div> 
                                    </div>

                                    @error('bathrooms')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- images --}}
                                <div>
                                    <input type="file" multiple="multiple" accept="image/jpeg, image/png, image/jpg">
                                    <output></output>
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
</x-layout>
