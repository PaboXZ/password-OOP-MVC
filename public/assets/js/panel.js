


//Event listeners
//delete buttons
let deleteButtons = document.getElementsByClassName("action-delete");

for(let item of deleteButtons){
    item.addEventListener('click', openDeletePopup);
}

//copy buttons
let copyButtons = document.getElementsByClassName('action-copy');

for(let item of copyButtons){
    item.addEventListener('click', copyPassword);
}

//show buttons
let showButtons = document.getElementsByClassName("action-view");

for(item of showButtons){
    item.addEventListener('click', openViewPopup);
}
//edit buttons
let editButtons = document.getElementsByClassName("action-edit");

for(item of editButtons){
    item.addEventListener('click', openEditPopup);
}

document.getElementById('color-picker-button').addEventListener('click', openColorPicker);
document.getElementById('color-picker-close-button').addEventListener('click', closeColorPicker);
document.getElementById('color-picker-pick-color').addEventListener('click', updateColorButton);

//rest
document.getElementById('delete-popup-close').addEventListener('click', closeDeletePopup);
document.getElementById('view-popup-close').addEventListener('click', closeViewPopup);
document.getElementById('edit-popup-close').addEventListener('click', closeEditPopup);

document.getElementById('regenerate-password-open').addEventListener('click', openRegeneratePasswordForm);
document.getElementById('regenerate-password-close').addEventListener('click', closeRegeneratePasswordForm);

let counter = 0;
colorPickers = document.getElementsByClassName('color-picker-radio');

for(picker of colorPickers){
    counter++;
    picker.style.cssText = `background-color: var(--password-color-${counter});`;
}

function openColorPicker() {
    document.getElementById('color-picker').style.cssText = 'display: block';
}
function closeColorPicker() {
    document.getElementById('color-picker').style.cssText = 'display: none';
}

function openDeletePopup() {
    let passwordNameField = document.getElementById('delete-popup-name');
    let deleteOverlay = document.getElementById('delete-popup');
    let passwordID = this.id.substr(16);

    let passwordName = document.getElementById('password-name-' + passwordID).innerText;
    let confirmButton = document.getElementById('delete-popup-confirm');

    confirmButton.setAttribute('form', "action-delete-form-" + passwordID);

    passwordNameField.innerText = passwordName;

    deleteOverlay.style.cssText = 'display: block';
}

function openViewPopup(){
    let viewPopup = document.getElementById('view-popup');
    let passwordID = this.id.substr(14);
    let passwordName = document.getElementById('password-name-' + passwordID).innerText;

    let passwordNameBox = document.getElementById('view-popup-name');
    passwordNameBox.innerText = passwordName;

    let passwordBox = document.getElementById('view-popup-password');
    passwordBox.innerText = document.getElementById('password-password-' + passwordID).innerText; 

    viewPopup.style.cssText = "display: block";
}

function openEditPopup(){
    let editPopup = document.getElementById('edit-popup');
    let passwordID = this.id.substr(14);
    let passwordName = document.getElementById('password-name-' + passwordID).innerText;

    document.getElementById('edit-popup-name').setAttribute('placeholder', passwordName);

    document.getElementById('edit-popup-edit-form').setAttribute('action', '/edit-password/' + passwordID);
    document.getElementById('edit-popup-regenerate-form').setAttribute('action', '/regenerate-password/' + passwordID);

    editPopup.style.cssText = "display: block";
}

function copyPassword(){
    let passwordID = this.id.substr(14);

    let password = document.getElementById('password-password-' + passwordID);
    navigator.clipboard.writeText(password.innerText);
}


function closeDeletePopup() {
    document.getElementById('delete-popup').style.cssText = 'display: none';
}

function closeViewPopup() {
    document.getElementById('view-popup').style.cssText = 'display: none';
}

function closeEditPopup() {
    document.getElementById('edit-popup').style.cssText = 'display: none';
}

function openRegeneratePasswordForm(){
    document.getElementById('regenerate-password-form').style.cssText = 'grid-template-rows: 1fr 1fr; gap: 1rem;';
}
function closeRegeneratePasswordForm(){
    document.getElementById('regenerate-password-form').style.cssText = 'grid-template-rows: 0fr 0fr; gap: 0';
}

function updateColorButton () {
    let color = '';

    let colorInputs = document.getElementsByClassName('color-picker-radio');
    let typedInput = document.getElementById('password-color-typed');

    for(input of colorInputs){
        if(input.checked === true)
            color = input.value;
    }

    if(typedInput.value !== ''){
        if(typedInput.value.match('^[a-f0-9]{3}$'))
            color = typedInput.value;
        else
            document.getElementById('password-color-typed-error').innerText = 'Invalid Format. (example: f23)';
    }

    console.log(color);
    
    if(color !== ''){
        document.getElementById('color-picker-button').style.cssText = `background-color: #${color};`;
        closeColorPicker();
    }
}