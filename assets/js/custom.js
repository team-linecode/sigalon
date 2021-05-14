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
