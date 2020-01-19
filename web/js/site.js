$(document).ready(function () {
    $('#form').on('beforeSubmit', function () {
        alert('send');
        return false;
    })
})