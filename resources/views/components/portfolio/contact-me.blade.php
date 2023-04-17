<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <!--
   This example requires some changes to your config:

   ```
   // tailwind.config.js
   module.exports = {
     // ...
     plugins: [
       // ...
       require('@tailwindcss/forms'),
     ],
   }
   ```
 -->
    <div class="isolate bg-white px-6 py-5 sm:py-6 lg:px-8 rounded-2xl">
        <div class="mx-auto max-w-2xl text-center flex flex-col items-center">
            <h2 class="text-xl font-bold tracking-tight text-gray-900 sm:text-xl">Contact me</h2>
            <a href="\">
                <img src="{{asset("/my_images/my_logo.png")}}" alt="myLogo">
            </a>
        </div>


        <form action="{{route('store-contact')}}" method="POST" class="mx-auto mt-5 max-w-xl sm:mt-5">
            @csrf
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div>
                    <label for="first_name" class="block text-sm font-semibold leading-6 text-gray-900">First name</label>
                    <div class="mt-2.5">
                        <input required maxlength="10" type="text" name="first_name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="last_name" class="block text-sm font-semibold leading-6 text-gray-900">Last name</label>
                    <div class="mt-2.5">
                        <input required maxlength="10" type="text" name="last_name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Company</label>
                    <div class="mt-2.5">
                        <input  required type="text" name="company" id="company" autocomplete="organization" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                    <div class="mt-2.5">
                        <input required type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="phone_number" class="block text-sm font-semibold leading-6 text-gray-900">Phone number</label>
                    <div class="relative mt-2.5">

                        <input required maxlength="10" type="tel" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Message</label>
                    <div class="mt-2.5">
                        <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>

            </div>
            <div class="mt-10">
                <button type="submit" class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Let's talk</button>
            </div>
        </form>
    </div>

</div>
<script>

    const form = document.querySelector('form');
    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevents the default form submission

        const formData = new FormData(form);
        const url = form.action;

        try {
            await Swal.showLoading();
            const response = await axios.post(url, formData);
            const { success } = response.data;

            if (success) {
                await Swal.fire({
                    title: 'Message send successfully',
                    color: 'white',
                    background: '#000000',
                    confirmButtonColor: '#0047cc',
                    confirmButtonText: 'OK',
                });

            } else {
                await Swal.fire({
                    title: 'Message NOT send',
                    color: 'white',
                    background: '#f55426',
                    confirmButtonColor: '#030303',
                    confirmButtonText: 'OK',
                });
            }
        } catch (error) {
            console.error(error);
        }
    });
</script>
