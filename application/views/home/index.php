<section class="bg-1 text-center overly"> 
	<div class="container"> 
		<div class="row"> 
			<div class="col-md-12"> 
				<h1 class="tittle-home"> Selamat datang di SIMPANAH </h1>
				<p class="tittle-sub-home"> Ayo Ajukan Pengaduan Jika Anda Mempunyai Persoalan Tanah !</p>
			</div>
		</div>
	</div>
</section>

<div class="container text-center">
	<div class="toggle-complaint" data-toggle="modal" data-target="#complaint-modal"> Ketik Pengaduan Anda ... </div>						
</div>

<!-- modal content -->

<div class="modal modal-complaint fade" id="complaint-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-complaint" role="document">
  	<div class="modal-content">
	 	<div class="wrap-report"> 
			<div class="container"> 
				<div class="row justify-content-center"> 
					<div class="col-lg-12 col-md-12 align-content-center">
						<form method="post" action="<?= base_url('Home/post_complaint') ;?>">
							<div class="row-form"> 
								<div class="form-group col-md-12">
									<textarea type="text" class="form-control field-tittle" name="title" placeholder="Judul Pengaduan"></textarea>
									<textarea name="complaint" type="text" class="form-control field-report" placeholder="Ketik Pengaduan Anda ..."></textarea>
								</div>

								<!-- <div class="form-group col-md-4 col-sm-4 float-left">
									<select name="category" class="w-100 form-control mt-lg-1 mt-md-2">
									<?php foreach($category as $category) { ?>
										<option value="<?= $category->_id ?>"><?= $category->category_name ?></option>
										<?php } ?>
									</select>
								</div> -->

								<div class="float-right">
									<button type="submit" class="btn-simpanah">Ajukan Pengaduan</button>
								</div>
							</div>
						</form>	
					</div>	
				</div>
			</div>
		</div>
	</div>
  </div>
</div>


<!-- popup berhasil aduan -->

<?= $this->session->flashdata('success'); ?>

<!-- <div class="bg-popup modal-exit" hidden> </div>
<div class="popup-coba modal-exit" hidden> 
	<p class="tittle-modal-aduan"> Pengaduan Terkirim ! </p>
	<div class="text-modal-aduan"> Silahkan pantau selalu perkembangan pengaduan melalui menu
			akun Anda pada bagian “Balasan Pengaduan” 
	</div>
	<button class="btn-modal-aduan" id="close-modal-aduan">Oke</button>
</div> -->


<div class="container-fluid">
	<p class="tittle-success"> Pengaduan Sudah Ditanggapi </p>
</div>

<section class="client-slider-03">
	<!-- Container Start -->
	<div class="container-fluid">
		<div class="row">
			<!-- Client Slider -->
			<div class="col-md-12 col-sm-4">
				<!-- Client Slider -->
				<div class="category-slider">
					<!-- Client 01 -->					
					<?php foreach ($timeline as $timeline) { ?>

					<div class="item">
						<div class="wrap-slider">  
							<p class="tittle-timeline"> <?= $timeline->title ?> </p>
							<?= $timeline->complaint ?>
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>

						<?php if ( $timeline->complaint_from == 0 || $timeline->complaint_from == 1 ) : ?> 

							<img src="<?= $timeline->user->photo ?>" class="img-slide-bottom">
							<div class="name-timeline"> <?= $timeline->user->name ?> </div>
							<p class="time-timeline"> <?= date("d-F-Y", strtotime($timeline->created_at)); ?> | <?= date("H.i", strtotime($timeline->created_at)); ?> WIB</p>

						<?php else : ?>

							<img src="<?= base_url(); ?>assets/images/user/user-thumb.jpg" class="img-slide-bottom">
							<div class="name-timeline"> <?= $timeline->from_name ?> </div>
							<p class="time-timeline"> <?= date("d-F-Y", strtotime($timeline->created_at)); ?> | <?= date("H.i", strtotime($timeline->created_at)); ?> WIB</p>
						
						<?php endif; ?>
						
						</div>
					</div>

					<?php } ?>

					<!-- <div class="item">
						<div class="wrap-slider"> Is simply dummy text of the printing
							and typesetting industry. Lorem
							Ipsum has been the industry's
							standard dummy text ever since the
							1500s, when an unknown printer
							took a galley of type and ... 
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>
						<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-slide-bottom">
						Nama 
						</div>
					</div>

					<div class="item">
						<div class="wrap-slider"> Is simply dummy text of the printing
							and typesetting industry. Lorem
							Ipsum has been the industry's
							standard dummy text ever since the
							1500s, when an unknown printer
							took a galley of type and ... 
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>
						<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-slide-bottom">
						Nama 
						</div>
					</div>

					<div class="item">
						<div class="wrap-slider"> Is simply dummy text of the printing
							and typesetting industry. Lorem
							Ipsum has been the industry's
							standard dummy text ever since the
							1500s, when an unknown printer
							took a galley of type and ... 
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>
						<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-slide-bottom">
						Nama 
						</div>
					</div>

					<div class="item">
						<div class="wrap-slider"> Is simply dummy text of the printing
							and typesetting industry. Lorem
							Ipsum has been the industry's
							standard dummy text ever since the
							1500s, when an unknown printer
							took a galley of type and ... 
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>
						<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-slide-bottom">
						Nama 
						</div>
					</div>

					<div class="item">
						<div class="wrap-slider"> Is simply dummy text of the printing
							and typesetting industry. Lorem
							Ipsum has been the industry's
							standard dummy text ever since the
							1500s, when an unknown printer
							took a galley of type and ... 
						</div>
						<div class="wrap-slider-bottom"> 
						<span class="arrow-down"> </span>
						<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-slide-bottom">
						Nama 
						</div>
					</div> -->

					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!-- <div class="margin-bottom"> </div> -->

