<div>
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Scrap Information</h3>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">TODO</p>
    </div>
    <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Web site Title</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$message->title}}</dd>
            </div>
            <hr>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">page_links</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @foreach($message->links->page_links as $link)
                    {{$link}}&nbsp;&nbsp;
                    @endforeach
                </dd>
            </div>

            <hr>


            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">external_links</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @foreach($message->links->external_links as $link)
                        {{$link}}&nbsp;&nbsp;
                    @endforeach
                </dd>
            </div>

            <hr>


            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">attributes</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @foreach($message->div_attributes->attributes as $att)

                        {{$att->value}}&nbsp;&nbsp;
                    @endforeach
                </dd>
            </div>


            <hr>


            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">class_names</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @foreach($message->div_attributes->class_names as $att)
                        {{$att}}&nbsp;&nbsp;
                    @endforeach
                </dd>
            </div>

            <hr>


            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">ids_names</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    @foreach($message->div_attributes->ids_names as $att)
                        {{$att}}&nbsp;&nbsp;
                    @endforeach
                </dd>
            </div>



        </dl>
    </div>
</div>




{{--<div class="alert alert-success">--}}
{{--    {{dd($message->links->page_links)}}--}}
{{--    {{ $message }}--}}
{{--    <div class="">--}}

{{--        <div class="mt-8 flow-root">--}}
{{--            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">--}}
{{--                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">--}}
{{--                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">--}}
{{--                        <table class="min-w-full divide-y divide-gray-300">--}}
{{--                            <thead class="bg-gray-50">--}}
{{--                            <tr>--}}

{{--                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>--}}
{{--                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">page links</th>--}}
{{--                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">external links</th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody class="divide-y divide-gray-200 bg-white">--}}
{{--                            <tr>--}}
{{--                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">--}}
{{--                                    {{$message->title}}</td>--}}

{{--                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">--}}
{{--                                        @foreach($message->links->page_links as $link)--}}
{{--                                            {{$link}}<br>--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}


{{--                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">lindsay.walton@example.com</td>--}}
{{--                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Member</td>--}}
{{--                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">--}}
{{--                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}

{{--                            <!-- More people... -->--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}
