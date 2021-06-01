// Datatables
$(".datatables").DataTable();

// Hide and Show Account Number in Payment Method
$('#type').change(function () {
	var type = $('#type').val()
	if (type == 'transfer') {
		$('#account_number').show()
		$('#account_name').show()
	}

	if (type == 'cod') {
		$('#account_number').hide()
		$('#account_name').hide()
	}
})

$('#account_number').hide()
$('#account_name').hide()

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})

// Get data supplier in product
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

// Get products
$('#transaction #supplier').change(function () {
	$supplier_id = $("#transaction #supplier").val();

	console.log($supplier_id);

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_supplier_product/' + $supplier_id,
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

	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/get_product/' + $val,
		cache: false,
		dataType: 'json',
		success: function (result) {
			$("#transaction #showQty").html(result.liter + ` Liter -> ` + result.supplier_stock + ` Galon`)

			$("#transaction #total").html(result.supplier_price)

			$('#transaction #productDetail').html(`
				Nama : ` + result.product_name + `<br>
				Supplier : ` + result.supplier_name + `<br>
				Harga satuan : Rp ` + result.product_price + `<br>
				Stok tersisa : ` + result.product_stock + `<br>
				<img src="` + BASE_URL + `assets/img/product/` + result.image + `" class="img-80">
			`)
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

// Show delivery method
$("#transaction #deliveryMethod").change(function () {
	$('#transaction #showDeliveryMethod').html($(this).val())
})

// Print
function print($noInvoice) {
	$.ajax({
		type: "GET",
		url: BASE_URL + '/transaction/print/' + $noInvoice,
		dataType: 'html',
		success: function (result) {
			var params = [
				'height=' + screen.height,
				'width=' + screen.width,
				'fullscreen=yes' // only works in IE, but here for completeness
			].join(',');

			var myWindow = window.open('', 'popup_window', params);
			myWindow.moveTo(0, 0);
			myWindow.document.write(result);
			myWindow.document.close();
			myWindow.focus();
			myWindow.print();
			myWindow.close();
		}
	})
}
