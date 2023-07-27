<div
x-data="{ show: true }"
x-init="setTimeout(()=> show = false, 4000)"
x-show="show"
{{-- x-transition:leave.duration.2000ms --}}
class="fixed bottom-3 right-3 bg-indigo-600 text-white text-sm py-3 px-5 rounded-xl"
>
    <p>{{ session('success') }}</p>
</div>