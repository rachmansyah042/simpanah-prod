<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                <div class="sidebar">
                <!-- Dashboard Links -->
                <div class="widget user-dashboard-menu">
                <!-- User Image -->
                    <div class="profile-thumb">
                    <img src="../assets/images/user/user-thumb.jpg" alt="" class="rounded-circle">
                    </div>
                    <!-- User Name -->
                    <h5 class="text-center margin-name-user"><?= $name ?></h5>
                    <ul>
                    <li class="sub"><a href="<?= base_url();?>subsie"><i class="fa fa-file-text"></i> Pengaduan Masuk</a></li>
                    <li class="sub"><a href="<?= base_url();?>subsie/reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
                    <li class="sub active"><a href="<?= base_url();?>subsie/profile"><i class="fa fa-user"></i> Edit Profil </a></li>
                    <li class="sub"><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                    
                    <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h5 class="modal-title" id="hapus-history">Anda yakin menghapus pengaduan ini?</h5> -->
                        </div>
                        <div class="modal-body">
                            <h4 class="modal-title" id="logout">Apakah anda yakin ingin keluar?</h4>
                        </div>
                        <div class="wrap-footer-delete">
                            <button type="button" class="btn-sub-cancel" data-dismiss="modal">Batal</button>
							<a href="<?= base_url();?>Auth/logout"><button type="button" class="btn-sub-close-modal">Ya</button></a>
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
							<form action="<?= base_url('Subsie/changeProfileSubsie') ;?>" method="post">
								<div class="row"> 
									<div class="col-6"> 
										<!-- Nama Pengguna -->
										<div class="form-group">
											<label class="tittle-form-profile" for="name">Nama Pengguna</label>
											<input type="text" name="name" value="<?= $name ?>" class="form-control" id="name">
										</div>
										<!-- Email -->
										<div class="form-group">
											<label class="tittle-form-profile" for="email">Email</label>
											<input type="text" name="email" value="<?= $email ?>" class="form-control" id="email">
										</div>
										<!-- UserName -->
										<div class="form-group">
											<label class="tittle-form-profile" for="username">Username</label>
											<input type="text" name="username" value="<?= $username ?>" class="form-control" id="username">
										</div>
										
										<!-- Submit button -->
										<button class="btn-sub-close-modal" type="submit">Simpan</button>
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