
////////////////// ADD RECORD /////////////////////////////////////////////
const addUser = document.getElementById('addRecord');
addUser.addEventListener('click', function() {
    Swal.fire({
        title: 'Add a new demo record',
        html:
            '<form id="addRecordForm">' +
            '<input id="name" type="text" class="swal2-input" placeholder="Name">' +
            '<input id="street" type="text" class="swal2-input" placeholder="Street">' +
            '<input id="number" type="number" class="swal2-input" placeholder="Number">' +
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
const delAll = document.getElementById('deleteAll');
delAll.addEventListener('click', async function () {


    axios.delete('/api/delete-all-records')
        .then(function (response) {
            reloadTable()
        })
        .catch(function (error) {

        });
})


///////////////  seed //////////////////////////////////////////////
const seed = document.getElementById('seedRecord');
seed.addEventListener('click', function() {


    axios.get('/api/seed-records')
        .then(function(response) {
            reloadTable()
        })
        .catch(function(error) {

        });
})


//////////////////// delete record //////////////////////////////
const deleteRecord = document.getElementById('deleteRecord');
deleteRecord.addEventListener('click', function() {
    const recordId = deleteRecord.dataset.recordId;

    console.log(recordId)

    axios.delete(`/api/delete-record/${recordId}`)
        .then(function(response) {
            reloadTable()
        })
        .catch(function(error) {

        });
})


///////////////// edit record ////////////////////////////////////
const editRecord = document.getElementById('editRecord');
editRecord.addEventListener('click', function () {
    const recordId = editRecord.dataset.recordId;


    fetch(`/api/get-record/${recordId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
        }

    })
        .then(response => response.json()) // convert response to JSON
        .then(data => {
            // extract values and assign to variables
            const name = data.record.name;
            const street = data.record.street;
            const number = data.record.number;
            const code = data.record.code;
            // do something with the variables, such as fill the update form


        Swal.fire({
            title: 'Edit demo record',
            html:
                '<form id="editRecordForm">' +
                '<input id="name" type="text" class="swal2-input" placeholder="Name" value="' + name + '">' +
                '<input id="street" type="text" class="swal2-input" placeholder="Street" value="' + street + '">' +
                '<input id="number" type="number" class="swal2-input" placeholder="Number" value="' + number + '">' +
                '<input id="code" type="text" class="swal2-input" placeholder="Code" value="' + code + '">' +
                '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                '</form>',
            showCancelButton: true,
            confirmButtonText: 'Update',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const name = Swal.getPopup().querySelector('#name').value;
                const street = Swal.getPopup().querySelector('#street').value;
                const number = Swal.getPopup().querySelector('#number').value;
                const code = Swal.getPopup().querySelector('#code').value;
                const csrfToken = Swal.getPopup().querySelector('[name="_token"]').value;
                const data = {name: name, street: street, number: number, code: code};
                return fetch(`/api/edit-record/${recordId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                })
                    .then(response => {
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
                    title: 'Record updated',
                    icon: 'success'
                })
                window.location.href = '/projects/my-horizon';

            }
        })
    }).catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

});

/////////////////// reload table funtion ////////////////////////////////////////////////////

// Attach event listener to parent element of delete button
document.querySelector('#usersTable').addEventListener('click', async (event) => {

    if (event.target.matches('#deleteRecord')) {
        // Call delete API endpoint and reload table after deletion
        const recordId = event.target.dataset.recordId;
        await axios.delete(`/api/delete-record/${recordId}`);
        await reloadTable();
    }

});


async function reloadTable() {
    try {
        await Swal.showLoading();
        const response = await axios.get(`/api/get-records`);
        const tableBody = document.querySelector('#usersTable tbody');
        tableBody.innerHTML = '';

        response.data.data.data.forEach(user => {
            const row = `<tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">${user.name}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.street}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.number}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">${user.code}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <button  data-record-id=${user.id}  id="editRecord" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Edit</button>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <button data-record-id=${user.id} id="deleteRecord" type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Delete</button>
                </td>
            </tr>`;
            tableBody.insertAdjacentHTML('beforeend', row);
        });
        const paginationLinks = document.getElementById('paginateLinks');

        paginationLinks.innerHTML = response.data.links;

    } catch (error) {
        console.error(error);
    } finally {
        await Swal.fire({
            title: 'Done',
        });
    }
}
