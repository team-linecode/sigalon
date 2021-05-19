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
	let id = $(this).val();

	$.ajax({
		type: "POST",
		url: BASE_URL + '/product/get_supplier/' + id,
		cache: false,
		dataType: 'json',
		success: function (result) {
			$("#nameSupplier").html(result.name)
			$("#addressSupplier").html(result.address)
			$("#contactSupplier").html(result.contact)
			$("#phoneSupplier").html(result.phone)
			$("#priceSupplier").html(`Rp ` + result.price)
			$("#literSupplier").html(result.liter)
			$("#stockSupplier").html(result.stock)
			$("#unitpriceSupplier").html(`Rp ` + result.unit_price)
		}
	});
});

// get user in transaction
$('#transaction #type').change(function () {
	$type = $(this).val();

	if ($type == 'in') {
		$('#transaction #qty').attr('disabled', 'disabled')
		$("#transaction #qty").attr('type', 'text').val('1 Tanki')

		$("#transaction #deliveryMethod>option:eq(2)").prop('selected', true)
		$("#transaction #deliveryMethod>option:eq(1)").attr('hidden', 'hidden')
		$("#transaction #deliveryMethod").attr('readonly', 'on')
	} else {
		$("#transaction #deliveryMethod>option:eq(1)").removeAttr('hidden')
		$("#transaction #qty").attr('type', 'text').val('')
	}

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

			if ($type == 'out') {
				$('#transaction #qty').attr('disabled', 'disabled').val('')
			}

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
			$('#transaction #product').html(result)
			$('#transaction #product').removeAttr('disabled')
		}
	})
})

// Get detail product in transaction
$('#transaction #product').change(function () {
	$val = $(this).val();
	$type = $("#transaction #type").val();

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_product/' + $val,
		cache: false,
		dataType: 'json',
		success: function (result) {
			if ($type == 'in') {
				$("#transaction #showQty").html(
					result.liter + ` Liter => ` + result.supplier_stock + ` Galon`
				)
				$("#transaction #total").html(result.supplier_price)
			}
			$('#transaction #productDetail').html(`
				Nama : ` + result.product_name + `<br>
				Supplier : ` + result.supplier_name + `<br>
				Harga Satuan : Rp ` + result.product_price + `
			`)
			if ($type == 'out') {
				$("#transaction #qty").attr('max', result.stock)
				$("#transaction #qty").removeAttr('disabled')
			}
		}
	})
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
