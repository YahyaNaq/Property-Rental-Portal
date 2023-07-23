<x-layout title="Delete a Property">
    <div class="min-h-full">
        @include('dashboard/_nav')
        @include('dashboard/_header', [ 'heading' => 'Delete this post'])
        <main class="relative">
            <div class="text-center mx-16 my-6 p-6 max-w-sm shadow bg-white border border-gray-200 rounded-lg">
                <a href="/dashboard">
                    <img src="{{asset("assets/icons/close.svg")}}" alt="" class="w-2.5 ml-auto">
                </a>
                <h5 class="text-2xl font-bold mb-1 mt-3 text-center">This action is irreversible!</h5>
                <h5 class="mb-2">Are you sure want to delete this property?</h5>
                <form action="/dashboard/confirm-delete-property/{{ $property['id'] }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mx-auto w-80 mx-2 my-6">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">
                            Enter the title of this property below
                        </label>
                        <div class="mt-1">
                            <div class="flex rounded-md shadow-sm bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="block flex-1 border-0 bg-transparent py-1.5 pl-2 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Property title to confirm deletion">
                            </div>
                        </div>

                        @error('title')
                            <p class="mt-1 text-sm leading-6 text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="inline-flex items-center font-medium px-3 py-2 text-center rounded-lg text-sm text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                        Yes, I confirm to delete this property
                    </button>
                </form>
            </div>
        </main>
    </div>
</x-layout>
