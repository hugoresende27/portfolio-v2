<div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3" id="all-news">
    @foreach($allNews as $new)

        <article class="flex max-w-xl flex-col items-start justify-between">
            <div class="flex items-center gap-x-4 text-xs">
                <time datetime="2020-03-16" class="text-gray-500">{{$new['pubDate']}}</time>
                <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                    {{$new['creator'][0] ?? 'HR News'}}
                </a>
            </div>
            <div class="group relative">
                <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                    <a href="{{$new['link']}}" target="_blank">
                        <span class="absolute inset-0"></span>
                        {{$new['title']}}
                    </a>
                </h3>
                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                    {{$new['description']}}
                </p>
            </div>
            <div class="relative mt-8 flex items-center gap-x-4">
                <img src=
                         "{{$new['image_url'] ?? asset('my_images/projects/news.png')}}"
                     alt="" class="h-20 w-20 rounded-full bg-gray-50">
                <div class="text-sm leading-6">
                    <p class="font-semibold text-gray-900">
                        <a href="#">
                            <span class="absolute inset-0"></span>
                            {{$new['creator'][0] ?? 'HR News'}}
                        </a>
                    </p>
                    <p class="text-gray-600">{{$new['country'][0] ?? 'HR News'}}</p>
                </div>
            </div>
        </article>

    @endforeach

    <!-- More posts... -->
</div>
