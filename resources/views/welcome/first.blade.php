
    <div class="">
        <dl class="">
            <div class="flex flex-col p-8 ">
                <dt class="sm:text-2xl text-lg font-semibold leading-6 text-gray-300 mb-2">

                    <div id="quote">
                        {{$quote ?? ""}}
                    </div>



                </dt>






            </div>

        </dl>
    </div>



<script>


    const container = document.getElementById('quote');

    function reloadQuote() {
        // Send an AJAX request to reload the component's data
        axios.get('/inspire')
            .then(function(response) {
                // Update the component's data by replacing the container's HTML
                container.innerHTML = response.data.quote.trim();
            })
            .catch(function(error) {
                console.log(error);
            });
    }
    // // Reload the component's data every 5 seconds
    // setInterval(reloadQuote, 5000);

    if (window.location.pathname === '/') {
        // Reload the component's data every 5 seconds
        setInterval(reloadQuote, 5000);
    }
</script>

