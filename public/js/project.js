
////////////////// ADD RECORD /////////////////////////////////////////////
const addUser = document.getElementById('addRecord');
addUser.addEventListener('click', function() {
    Swal.fire({
        title: 'Add a new demo record',
        html:
            '<form id="addRecordForm">' +
            '<input id="name" type="text" class="swal2-input" placeholder="Name">' +
            '<input id="street" type="text" class="swal2-input" placeholder="Street">' +
            '<input id="number" type="text" class="swal2-input" placeholder="Number">' +
            '<input id="code" type="text" class="swal2-input" placeholder="Code">' +
            '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
            '</form>',
        showCancelButton: true,
        confirmButtonText: 'Add',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const name = Swal.getPopup().querySelector('#name').value;
            const street = Swal.getPopup().querySelector('#street').value;
            const number = Swal.getPopup().querySelector('#number').value;
            const code = Swal.getPopup().querySelector('#code').value;
            const csrfToken = Swal.getPopup().querySelector('[name="_token"]').value;
            const data = {name: name, street: street, number: number, code: code};
            return fetch(`/api/add-record`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
                .then(response => {
                    console.log(response)
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    )
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Record added',
                icon: 'success'
            })
        }
        // reload the table.
        reloadTable()
    })
});

////////////////// delete all  /////////////////////////////////////////////
const seed = document.getElementById('deleteAll');

seed.addEventListener('click', function() {

    axios.delete('/api/delete-all-records')
        .then(function(response) {
            reloadTable()
        })
        .catch(function(error) {

        });
})





function reloadTable()
{
    // reload the table.
    axios.get(`/api/get-records`)
        .then(response => {
            const tableBody = document.querySelector('#usersTable tbody');
            tableBody.innerHTML = '';
            console.log(response);
            response.data.data.forEach(user => {
                const row = `<tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">${user.name}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.street}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.number}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.code}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, ${user.name}</span></a>
                                        </td>
                                    </tr>`;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(error => {
            console.error(error);
        })
}
