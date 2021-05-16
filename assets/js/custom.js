// Datatables

$(".datatables").DataTable();

// Hide and Show Account Number in Payment Method

$('#type').change(function () {
	var type = $('#type').val()
	if (type == 'transfer') {
		$('#account_number').show()
	}

	if (type == 'cod') {
		$('#account_number').hide()
	}
})

$('#account_number').hide()

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

$("#id_supplier").change(function() {

	let id_supplier = $(this).val()

	$.ajax({
		url: '/product/get_supplier',
		data: 'id_supplier=' + id_supplier,
		type: 'post',
		dataType: 'html',
		success: function(result) {
			$("#data_supplier").html(result)
		}
	});
});