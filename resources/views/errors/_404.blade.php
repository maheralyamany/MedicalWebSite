<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $message ?? __('Not Found') }}</title>
    @include('includes.404-header')
</head>

<body class="no-skin rtl">
    <main class="h-screen w-full flex flex-col justify-center items-center bg-[#1A2238]">

        @if (isset($exception) || isset($message))
            <div>
                <h1 class="text-9xl font-extrabold text-white tracking-widest">404</h1>
                <div class="bg-[#FF6A3D] px-2   rounded rotate-12 absolute">
                    <div class="relative">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-500 opacity-75"></span>
                        {{ __('Not Found') }}
                    </div>
                </div>
            </div>
            <div class="text-white my-3 pt-3">
                {{ isset($exception)?$exception->getMessage() :$message }}
            </div>
        @else
            <h1 class="grey lighter smaller">
                <span class="blue bigger-125">
                    <i class="ace-icon fa fa-sitemap"></i>
                    404
                </span>
                الصفحة غير موجودة
                <hr>
            </h1>

            <div class="text-white">

                <div class="my-3">
                    <div class="space"></div>
                    <h4 class="smaller">جرّب واحداً من الحلول التالية:</h4>

                    <ul class="list-unstyled spaced inline bigger-110 margin-15">
                        <li>
                            <i class="ace-icon fa fa-hand-o-right blue"></i>
                            أعد التحقق من عنوان URL لمعرفة الأخطاء المطبعية
                        </li>
                        <li>
                            <i class="ace-icon fa fa-hand-o-right blue"></i>
                            أخبر الإدارة عن العطل
                        </li>
                    </ul>
                </div>
            </div>
        @endif



        <div class="space"></div>
        <div class="mt-5 center">
            <a class="relative inline-block   font-medium text-[#FF6A3D] group active:text-orange-500 focus:outline-none focus:ring"
                href="javascript:history.back()">
                <span
                    class="absolute inset-0 transition-transform translate-x-0.5 translate-y-0.5 bg-[#FF6A3D] group-hover:translate-y-0 group-hover:translate-x-0"></span>
                <span class="relative block px-8 py-3 bg-[#1A2238] border border-current">
                    <i class="ace-icon fa fa-arrow-right"></i> {{ trans('m.back') }}
                </span>
            </a>
        </div>
    </main>
</body>

</html>
