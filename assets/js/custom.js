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

$("#id_supplier").change(function () {

	let id_supplier = $(this).val()

	$.ajax({
		url: '/product/get_supplier',
		data: 'id_supplier=' + id_supplier,
		type: 'post',
		dataType: 'html',
		success: function (result) {
			$("#data_supplier").html(result)
		}
	});
});

// Get detail product in transaction
$('#transaction #product').click(function () {
	$val = $(this).val();
	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_product/' + $val,
		cache: false,
		dataType: 'json',
		success: function (result) {
			$('#transaction #productDetail').html(`
			Nama : ` + result.product_name + `<br>
			Supplier : ` + result.supplier_name + `<br>
			Harga : ` + result.product_price + `
			`)
			$("#transaction #qty").attr('max', result.stock)
			$("#transaction #qty").removeAttr('disabled')
		}
	})
})

// Calculate transaction price
$('#transaction #qty').keyup(function () {
	$val = $(this).val();
	$productId = $('#transaction #product').val();

	if ($val == '') {
		$('#transaction #showQty').html(0)
	} else {
		$('#transaction #showQty').html($val)
	}

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/calculate_price/' + $productId + '/' + $val,
		cache: false,
		dataType: 'json',
		success: function (result) {
			$("#transaction #total").html(result)
		}
	})
})

// Open select product on change customer
$('#transaction #user').change(function () {
	$('#transaction #product').removeAttr('disabled')
})

// Get detail payment method
$('#transaction #paymentMethod').change(function () {
	$val = $(this).val()

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_payment_method/' + $val,
		cache: false,
		dataType: 'json',
		success: function (result) {
			if (result.type == 'transfer') {
				$("#transaction #showPaymentMethod").html(`
					Metode : ` + result.name + `<br>
					Nomer Rekening : ` + result.acc_number + `<br>
					Atas Nama : ` + result.atas_nama + `
				`)
			} else {
				$("#transaction #showPaymentMethod").html(`
					Metode : ` + result.name + `
				`)
			}
		}
	})
})

// Show delivery method
$("#transaction #deliveryMethod").change(function () {
	$('#transaction #showDeliveryMethod').html($(this).val())
})
