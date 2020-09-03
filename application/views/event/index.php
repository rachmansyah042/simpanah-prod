<section class="bg-1 text-center overly"> 
	<div class="container"> 
		<div class="row"> 
			<div class="col-md-12"> 
				<h1 class="tittle-home"> Event BPN Kota Bogor </h1>
				<p class="tittle-sub-home"> Portal Informasi Resmi Seputar Event yang</p>
				<p class="tittle-sub-home"> diselenggarakan oleh BPN Kota BOGOR </p>
			</div>
		</div>
	</div>
</section>


<section class="client-slider-03">
	<!-- Container Start -->
	<div class="container-fluid">
		<div class="row">
			<!-- Client Slider -->
			<div class="col-md-12 col-sm-4">
				<!-- Client Slider -->
				<div class="category-slider none">
					<!-- Client 01 -->					
					<?php foreach ($event as $event) { ?>

					<div class="item">
						<img src="<?= $event->photo_event ?>" class="img-event" >
						<div class="wrap-slider-event"> 
							<p class="date-event"> <?= date("D, d F Y", strtotime($event->photo_event)); ?> </p>
							<div class="tittle-event"> <?= $event->event_name ?> </div>
							<form action="<?= base_url('Event/detail_event') ;?>" method="post">
								<input name="id_event" value="<?= $event->_id ?>" hidden>
								<button type="submit" class="event-selanjutnya"> Lihat Selengkapnya </button>
							</form>
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
					</div> -->

					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!-- <div class="margin-bottom"> </div> -->

