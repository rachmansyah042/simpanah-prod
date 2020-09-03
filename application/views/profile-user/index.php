<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
					<!-- User Image -->
						<div class="profile-thumb">
						<img src="<?= $photo ?>" alt="" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center margin-name-user"><?= $name ?></h5>
						<ul>
						<li><a href="<?= base_url();?>dashboard"><i class="fa fa-file-text"></i> Pengaduan Saya</a></li>
						<li><a href="<?= base_url();?>reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
						<li class="active"><a href="<?= base_url();?>profile"><i class="fa fa-user"></i> Ubah Profil </a></li>
              <li><a href="<?= base_url();?>auth/change_password"><i class="fa fa-lock"></i> Ubah Password </a></li>
						<li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out"></i> Logout</a></li>
						</ul>
						
						<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="hapus-history" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<!-- <h5 class="modal-title" id="hapus-history">Anda yakin menghapus pengaduan ini?</h5> -->
							</div>
							<div class="modal-body">
								<h4 class="modal-title" id="hapus-history">Apakah anda yakin ingin keluar?</h4>
							</div>
							<div class="wrap-footer-delete">
								<button type="button" class="btn-cancel" data-dismiss="modal">Batal</button>
								<a href="<?= base_url();?>Auth/logout"> <button type="button" class="btn-close-modal">Ya</button> </a>
							</div>
							</div>
						</div>
						</div>

					</div>
					</div>
				</div>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="row">
					<div class="col">
						<div class="widget personal-info">
							<h2 class="tittle-profile">Ubah Profil</h2>
							<p>Ubah profil anda sesuai kebutuhan, pastikan memasukkan informasi yang benar</p>
							<form action="<?= base_url('Profile/changeProfile') ;?>" method="post" enctype="multipart/form-data">
								<div class="row"> 
									<div class="col-6"> 
										<!-- Nama Pengguna -->
										<div class="form-group">
											<label class="tittle-form-profile" for="name">Nama Pengguna</label>
											<input type="text" class="form-control" id="name" name="name" value="<?= $nama ?>">
										</div>
										<!-- Email -->
										<div class="form-group">
											<label class="tittle-form-profile" for="email">Email</label>
											<input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
										</div>
										<!-- UserName -->
										<div class="form-group">
											<label class="tittle-form-profile" for="username">Username</label>
											<input type="text" class="form-control" id="username" name="username" value="<?= $username ?>">
										</div>

										<!-- file photo -->
										<label class="tittle-form-profile" for="username">Photo Profile</label>
										<div class="form-group choose-file d-inline-flex">
											<!-- <i class="fa fa-user text-center px-3"></i> -->
											<input type="file" name="image" class="form-control-file mt-2 pt-1">
										</div>
										
										
										<!-- Submit button -->
										<button type="submit" class="btn-close-modal">Simpan</button>
										
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>