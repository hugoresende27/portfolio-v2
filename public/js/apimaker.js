const addButton = document.getElementById("add-button");
const fieldsContainer = document.getElementById("fields-container");

let fieldsCount = 2; // the number of input fields already present

addButton.addEventListener("click", function() {
    // create a new div element
    const newFieldDiv = document.createElement("div");
    newFieldDiv.className = "sm:col-span-3";

    // create a new label element for column name
    const newFieldNameLabel = document.createElement("label");
    newFieldNameLabel.for = `colName${fieldsCount}`;
    newFieldNameLabel.className = "block text-sm font-medium leading-6 text-gray-900";
    newFieldNameLabel.textContent = "Column Name";

    // create a new input element for column name
    const newFieldNameInput = document.createElement("input");
    newFieldNameInput.type = "text";
    newFieldNameInput.name = `colName${fieldsCount}`;
    newFieldNameInput.id = `colName${fieldsCount}`;
    newFieldNameInput.className = "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6";

    // create a new label element for column type
    const newFieldTypeLabel = document.createElement("label");
    newFieldTypeLabel.for = `colType${fieldsCount}`;
    newFieldTypeLabel.className = "block text-sm font-medium leading-6 text-gray-900 mt-4";
    newFieldTypeLabel.textContent = "Column Type";

    // create a new select element for column type
    const newFieldTypeSelect = document.createElement("select");
    newFieldTypeSelect.id = `colType${fieldsCount}`;
    newFieldTypeSelect.name = `colType${fieldsCount}`;
    newFieldTypeSelect.className = "block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6";

    // create options for the select element
    const option1 = document.createElement("option");
    option1.value = "integer";
    option1.textContent = "Integer";

    const option2 = document.createElement("option");
    option2.value = "float";
    option2.textContent = "Decimal";

    const option3 = document.createElement("option");
    option3.value = "text";
    option3.textContent = "Text";

    const option4 = document.createElement("option");
    option4.value = "data";
    option4.textContent = "Data";

    const option5 = document.createElement("option");
    option5.value = "boolean";
    option5.textContent = "Boolean";

    // add the options to the select element
    newFieldTypeSelect.appendChild(option1);
    newFieldTypeSelect.appendChild(option2);
    newFieldTypeSelect.appendChild(option3);
    newFieldTypeSelect.appendChild(option4);
    newFieldTypeSelect.appendChild(option5);

    // append the label and input element for column name to the new div
    newFieldDiv.appendChild(newFieldNameLabel);
    newFieldDiv.appendChild(newFieldNameInput);

    // append the label and select element for column type to the new div
    newFieldDiv.appendChild(newFieldTypeLabel);
    newFieldDiv.appendChild(newFieldTypeSelect);

    // append the new div to the fields container
    fieldsContainer.appendChild(newFieldDiv);

    // increment the fields count
    fieldsCount++;
});

////////////////////////////////////////////////////////////////////////


const minusButton = document.getElementById("minus-button");

minusButton.addEventListener("click", function() {
    // remove the last added input field and select element
    fieldsContainer.removeChild(fieldsContainer.lastChild);

    // decrement the fields count
    fieldsCount--;
});


////////////////////////////////////////////////////////////////////////


function reloadForm() {
    location.reload();
}
