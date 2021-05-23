<div class="container">

	<!-- Outer Row -->
	<div class="row justify-content-center">

		<div class="col-xl-10 col-lg-12 col-md-9">

			<div class="card o-hidden border-0 shadow-sm-lg my-5">
				<div class="card-body p-0">
					<!-- Nested Row within Card Body -->
					<div class="row">
						<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
						<div class="col-lg-6">
							<div style="padding: 9rem 3rem">
								<div class="text-center mb-5">
									<h1 class="h4 text-primary font-weight-bold">SIGALON</h1>
									<P>Jual dan isi ulang galon harga termurah.</P>
								</div>
								<form action="<?= base_url('auth') ?>" method="POST" class="user">
									<div class="form-group">
										<input type="text" class="form-control form-control-user" name="username" placeholder="Masukkan Username">
										<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" name="password" placeholder="Password">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>

									<button class="btn btn-primary btn-user btn-block">Masuk</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>

</div>