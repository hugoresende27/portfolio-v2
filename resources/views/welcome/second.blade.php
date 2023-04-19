<div class="mx-auto max-w-7xl px-6 lg:px-8 mb-5 ">
    <div class="mx-auto max-w-2xl lg:max-w-none">
        <dl class="mt-5 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-col bg-white/5 p-0 sm:max-w-xs md:max-w-sm">
                <img src="{{asset("/my_images/h.png")}}" alt="myLogo" class="max-h-50px w-full h-auto">
            </div>



            <div class="flex flex-col bg-white/5 p-8 justify-center items-center ">

                <a href="{{route('projects')}}" class="hero-btn" style="font-family: 'Caveat', cursive;">
                    <dt class="text-5xl m-5 font-semibold leading-6 text-gray-300 my-font">Projects</dt>
                </a>
                <a href="https://github.com/hugoresende27/" target="_blank" class="hero-btn" style="font-family: 'Caveat', cursive;">
                    <dt class="text-5xl m-5 font-semibold leading-6 text-gray-300">Github</dt>
                </a>
                <a href="https://www.linkedin.com/in/hugo-resende-781ab1111/" target="_blank" class="hero-btn" style="font-family: 'Caveat', cursive;">
                    <dt class="text-5xl m-5 font-semibold leading-6 text-gray-300">Linkedin</dt>
                </a>

            </div>



            <div class="flex flex-col bg-white/5 p-8">
                <a href="{{asset('cv/cv.pdf')}}" target="_blank" class="hero-btn">
{{--                    <dt class="text-4xl font-semibold leading-6 text-gray-300">CV</dt>--}}
                    <img src="{{asset('/my_images/ctt.png')}}" alt="cv">
                </a>
            </div>

            <div class="flex flex-col bg-white/5 p-8">
                <a href="{{route('contact-me')}}" class="hero-btn">
{{--                    <dt class="text-4xl font-semibold leading-6 text-gray-300">Contacts</dt>--}}
                    <img src="{{asset('/my_images/contact.png')}}" alt="contact" class="mt-10">
                </a>
            </div>
        </dl>
    </div>
</div>


<style>

    .hero-btn:hover{
        transform: scale(1.2);
    }
</style>
