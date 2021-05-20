<script>
	$(".confirm-delete").click(function() {
		$target = $(this).data('target');
		Swal.fire({
			title: 'Apa kamu yakin?',
			text: "Data yang terhapus tidak dapat dikembalikan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3d63d2',
			cancelButtonColor: '#e74a3b',
			confirmButtonText: 'Ya, Hapus!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = $target
			}
		})
	})
</script>