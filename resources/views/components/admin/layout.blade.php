<!DOCTYPE html>
<html lang="en">
<head class="h-full bg-gray-100">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <title>{{ $title }}</title>
</head>
<body class="h-full">
    @php 
        $user=Auth::guard('admins')->user();
    @endphp
    
    @auth('admins')
        <x-admin.sidebar :user="$user" />
    @endauth
    <x-admin.nav :user="$user" />
        
    {{ $slot }}

    <script type="text/javascript" src="{{asset('assets/js/main.js')}}"></script>
</body>
</html>