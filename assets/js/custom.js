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
	let $id_supplier = $(this).val();

	$.ajax({
		type: "POST",
		url: BASE_URL + '/product/get_supplier/' + $id_supplier,
		cache: false,
		dataType: 'json',
		success: function (result) {
			$("#data_supplier").html(`
			Nama : ` + result.name + `<br>
			Supplier : ` + result.address + `<br>
			Harga : ` + result.price + `
			`)
		}
	});
});

// get user in transaction
$('#transaction #type').change(function () {
	$type = $(this).val();

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_user/' + $type,
		cache: false,
		beforeSend: () => {
			$('#transaction #user').attr('disabled', 'disabled')
			$('#transaction #user').html(`<option>Sedang mengambil data...</option>`)
		},
		dataType: 'html',
		success: function (result) {
			$('#transaction #product>option:eq(0)').prop('selected', true)
			$('#transaction #product').attr('disabled', 'disabled')

			$('#transaction #qty').attr('disabled', 'disabled').val('')

			$('#transaction #productDetail').html('-')
			$('#transaction #showQty').html(0)
			$('#transaction #total').html(0)

			$('#transaction #user').removeAttr('disabled')
			$('#transaction #user').html(result)
		}
	})
})

// Get products
$('#transaction #user').change(function () {
	$type = $("#transaction #type").val();
	$userId = $("#transaction #user").val();

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_supplier_product/' + $userId + '/' + $type,
		cache: false,
		beforeSend: () => {
			$('#transaction #product').attr('disabled', 'disabled')
			$('#transaction #product').html(`<option>Sedang mengambil data...</option>`)
		},
		dataType: 'html',
		success: function (result) {
			console.log(result)
			$('#transaction #product').html(result)
			$('#transaction #product').removeAttr('disabled')
		}
	})
})

// Get detail product in transaction
$('#transaction #product').change(function () {
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
			console.log('ok');
		}
	})
})
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
					Atas Nama : ` + result.acc_name + `
				`)
			} else {
				$("#transaction #showPaymentMethod").html(`
					Metode : ` + result.name + `
				`)
			}

			if ($val == '') {
				$('#transaction #showQty').html(0)
			} else {
				$('#transaction #showQty').html($val)
			}

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

// Show delivery method
$("#transaction #deliveryMethod").change(function () {
	$('#transaction #showDeliveryMethod').html($(this).val())
})
