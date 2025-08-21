<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $exception->getMessage() ?? __('Service Unavailable') }}</title>

    <link rel="stylesheet" href="{{asset('css/errors.css')}}">
</head>

<body>
    <main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">
        <h1 class="text-9xl font-extrabold text-white tracking-widest">503</h1>
        <div class="bg-[#FF6A3D] px-2 text-sm rounded rotate-12 absolute">
            <div class="relative">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-500 opacity-75"></span>
                {{__('Service Unavailable')}}
            </div>
        </div>
        <button class="mt-5">
            <div class="text-white my-3">{{ "Kami akan segera kembali"}}</div>
            <a class="relative inline-block text-sm font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring" href="/">
                <span class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] group-hover:translate-y-0 group-hover:translate-x-0"></span>
                <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                    {{ now()->isoFormat('dddd, D MMMM Y') }}
                </span>
            </a>
        </button>
    </main>
</body>

</html>
