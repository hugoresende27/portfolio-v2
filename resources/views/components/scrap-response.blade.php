<div>
    <div class="px-4 sm:px-0">
        <h3 class="text-base font-semibold leading-7 text-gray-900">Scrap Information</h3>

    </div>

        <div class="mt-6 border-t border-gray-100">
        <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                <dt class="text-sm font-medium leading-6 text-gray-900">Web site Title</dt>
                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$message->title}}</dd>
            </div>

            @if ($message->specs !== null)
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">search link</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$message->original_link}}</dd>
                </div>

                <hr>

                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Domain</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$message->domain}}</dd>
                </div>

                <hr>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Server Specs</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">

                        @foreach($message->specs as $k => $spec)

                            <p class="text-sm font-semibold leading-6 text-indigo-600 flex-lg-wrap">{{$spec}}</p>

                        @endforeach
                    </dd>
                </div>

                <hr>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">images</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @foreach($message->images as $k => $image)
                            <a href="{{$image}}" target="_blank">
                                <img class="h-16 w-16 rounded-full" src="{{$image}}"
                                     alt="image{{$k}}">

                                <p class="text-sm font-semibold leading-6 text-indigo-600 flex-lg-wrap">{{$image}}</p>
                            </a>

                        @endforeach
                    </dd>
                </div>

                <hr>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">page_links</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @foreach($message->links->page_links as $link)
                            <li>
                                <a href="{{$link}}" target="_blank">{{$link}}</a>
                            </li>
                        @endforeach
                    </dd>
                </div>

                <hr>


                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">external_links</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        @foreach($message->links->external_links as $link)
                           <li>
                               <a href="{{$link}}" target="_blank">{{$link}}</a>
                           </li>
                        @endforeach
                    </dd>
                </div>

                <hr>


                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Text</dt>
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
            @endif


        </dl>
    </div>


</div>


