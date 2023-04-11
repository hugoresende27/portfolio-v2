<div class="w-3/4">
    <div class="">
        <dl class="">
            <div class="flex flex-col p-8">
                <dt class="sm:text-2xl text-sm font-semibold leading-6 text-gray-300 mb-2">
                    <div id="quote">
                        {{$quote}}
                    </div>


                    <button type="button" id="reload" class="float-right rounded-full bg-indigo-600 p-2 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                    </button>

                </dt>

                <dt class="text-sm font-semibold leading-6 text-gray-300">
                    API weather here
                </dt>

            </div>

        </dl>
    </div>
</div>


<script>
    var button = document.getElementById('reload');
    var container = document.getElementById('quote');

    button.addEventListener('click', function() {
        // Send an AJAX request to reload the component's data
        axios.get('/inspire')
            .then(function(response) {
                // Update the component's data by replacing the container's HTML
                container.innerHTML = response.data.quote.trim();
            })
            .catch(function(error) {
                console.log(error);
            });
    });
</script>

