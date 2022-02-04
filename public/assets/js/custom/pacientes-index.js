$(function() {
    $.fn.dataTable.moment('DD/MM/YYYY');
    $('#minhaTabela').DataTable({
        language: {
            url: '/public/assets/localization/pt_br.json'
        },
        "lengthChange": false,
        columnDefs: [
            { orderable: false, targets: [0, 5, 6] }
        ],
        "order": [[ 1, "asc" ]],
        responsive: true
    });
});
$('.modal').modal();