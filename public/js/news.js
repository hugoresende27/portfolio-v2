
window.onload = function() {
    handleCategories();
}




async function handleSubmit(event) {


    event.preventDefault();
    const newsComponent = document.querySelector('#all-news');
    const subject = document.querySelector('#subject').value;
    const language = document.querySelector('#language').value;
    const country = document.querySelector('#country').value;
    const categories = document.querySelector('#categories'); // select the element with id "categories"
    const inputs = categories.querySelectorAll('input'); // select all input elements inside the "categories" element
    const selectedCategories = []; // create an empty array to store selected categories

    inputs.forEach(input => {
        if (input.checked) { // check if the input is checked
            selectedCategories.push(input.labels[0].textContent); // push the label of the input into the array
        }
    });

    const categoryString = selectedCategories.join(','); // join the array elements into a string with a comma separator
// log the selected categories string to the console



    newsComponent.innerHTML = "";
    // Get the form data
    // const formData = new FormData(event.target);

    await Swal.showLoading();
    // Make an AJAX request to the backend
    axios.post('/projects/news', {
            language: language || null,
            subject: subject || null,
            country: country || null,
            category: categoryString || null,
    })
        .then(async response => {

            if (response.data.length === 0) {

                await Swal.fire({
                    title: 'Oh Oh',
                    html: 'No news ...',
                    color: 'white',
                    background: '#f55426',
                    confirmButtonColor: '#030303',
                    confirmButtonText: 'OK',
                });
            }


            // Update the bottom component with the response data
            // const newsComponent = document.querySelector('#all-news');
            // newsComponent.setAttribute('allNews', JSON.stringify(response.data));

            let newsHtml = '';
            response.data.forEach(newItem => {

                newsHtml += `
                                    <article class="flex max-w-xl flex-col items-start justify-between">
                                      <div class="flex items-center gap-x-4 text-xs">
                                        <time datetime="${newItem.pubDate}" class="text-gray-500">${newItem.pubDate}</time>
                                        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">
                                            ${newItem.creator && newItem.creator.length > 0 ? newItem.creator[0] : 'HR News'}
                                        </a>

                                      </div>
                                      <div class="group relative">
                                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                          <a href="${newItem.link}" target="_blank">
                                            <span class="absolute inset-0"></span>
                                            ${newItem.title}
                                          </a>
                                        </h3>
                                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                          ${newItem.description}
                                        </p>
                                      </div>
                                      <div class="relative mt-8 flex items-center gap-x-4">
                                        <img src="${newItem.image_url ?? '../my_images/projects/news.png'}"
                                          alt="" class="h-20 w-20 rounded-full bg-gray-50">
                                        <div class="text-sm leading-6">
                                          <p class="font-semibold text-gray-900">
                                            <a href="#">
                                              <span class="absolute inset-0"></span>
                                                ${newItem.creator && newItem.creator.length > 0 ? newItem.creator[0] : 'HR News'}
                                            </a>
                                          </p>
                                          <p class="text-gray-600">${newItem.country[0] ?? 'HR News'}</p>
                                        </div>
                                      </div>
                                    </article>
                                  `;
            });

            newsComponent.innerHTML = newsHtml;


        })
        .catch(async error => {

            console.log(error)
            await Swal.fire({
                title: 'Error',
                html: error,
                color: 'white',
                background: '#f55426',
                confirmButtonColor: '#030303',
                confirmButtonText: 'OK',
            });
        }) .finally(() => {
        Swal.close(); // Close the loading spinner
        });
}


/*****************************************************************/

function handleCategories() {
    const container = document.querySelector("#categories");
    const maxInputs = 5;
    let selectedInputs = 0;

    container.addEventListener("click", (event) => {
        const input = event.target.closest('input[type="radio"]');
        if (input) {
            const checkedInputs = container.querySelectorAll('input:checked');
            selectedInputs = checkedInputs.length;

            if (selectedInputs >= maxInputs) {
                container.querySelectorAll('input:not(:checked)').forEach((input) => {
                    input.disabled = true;
                });
            } else {
                container.querySelectorAll('input').forEach((input) => {
                    input.disabled = false;
                });
            }

            if (selectedInputs > maxInputs) {
                input.checked = false;
                selectedInputs--;
            }
        }
    });
}

/**************************************************************/

function clearCategories() {
    const container = document.querySelector("#categories");
    container.querySelectorAll('input:checked').forEach((input) => {
        input.checked = false;
    });
    container.querySelectorAll('input').forEach((input) => {
        input.disabled = false;
    });
}

document.querySelector("#clear-btn").addEventListener("click", clearCategories);

/******************************************************************/
