<x-agent.layout title="Add a new Property">
    <section class="min-h-full">
        @include('dashboard/_header', ['heading' => 'Send offer for rent'])
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <form action="{{route('store-offer', [ 'username' => $username, 'id' => $property['id'] ])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-4">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">A quick tip</h2>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Add a convincing message for a successful deal</p>
        
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="offer_amount" class="block text-sm font-medium leading-6 text-gray-900">Offer Amount</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="number" name="offer_amount" id="offer_amount" value="{{ old('offer_amount') ?? $property['monthly_rent'] }}" step="1000" min="10000" max="{{$property['monthly_rent']}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Add a realistic and reasonable rent">
                                        </div>
                                    </div>

                                    @error('offer_amount')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="sm:col-span-4">
                                    <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Message</label>
                                    <div class="mt-2">
                                        <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                            <input type="text" name="message" id="message" value="{{old('message')}}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="for ex: 3rd floor apartment at a reasonable price">
                                        </div>
                                    </div>
                                    @error('message')
                                        <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-12">
                                <h2 class="text-sm font-semibold leading-3 text-gray-900">Disclaimer</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">You can not update your offer. Make sure to double check.</p>
                            </div>
                        </div>
                    </div>

        
                    <div class="mt-6 flex items-center justify-star gap-x-3">
                        <button type="submit" class="rounded-md bg-indigo-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        <a href="/{{$username}}/properties/{{$property['id']}}" class="rounded-md bg-gray-300/[0.7] py-2 px-3 text-sm font-semibold text-black">Cancel</a>
                    </div>
                </form>
            </div>
        </main>        
    </section>
</x-agent.layout>
