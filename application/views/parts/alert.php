<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	})

	<?php if ($this->session->flashdata('success')) : ?>
		Toast.fire({
			title: "<?= $this->session->flashdata('success') ?>",
			icon: 'success',
		})
	<?php elseif ($this->session->flashdata('error')) : ?>
		Toast.fire({
			title: "<?= $this->session->flashdata('error') ?>",
			icon: 'error',
		})
	<?php endif ?>
</script>