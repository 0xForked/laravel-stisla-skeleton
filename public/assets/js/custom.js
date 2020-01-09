/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

/**
 *  Show File Upload name to File upload label
 *  file upload id must not equal with file upload label + add -label world
 *  e.g on {input=file id="file-upload" } {label id="file-upload-label"}
 */

$(document).ready(function() {
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        var targetId = '#'+e.target.id + '-label'
        $(targetId).text(fileName);
    });
});

/**
 *  Show Loading Function
 *
 */

function showLoading() {
    $('#loading').show();
}


/**
 *  Delete Function
 *
 */

function deleteData(id, route) {
    let container = document.querySelector('#deleteButtonContainer')
    let strAvailableData = `
        <a
            href="`+route+`/`+id+`/delete"
            onclick="deleteProcess()"
            class="btn btn-danger"
        >
            Hapus
        </a>
    `
    return container.innerHTML = strAvailableData
}

function deleteProcess() {
    $('#deleteModal').modal('hide');
    showLoading()
}

function updateProcess(modal) {
    var id = '#'+modal
    $(id).modal('hide');
    showLoading()
}

function logoutProcess() {
    $('#logoutModal').hide()
    showLoading()
}
