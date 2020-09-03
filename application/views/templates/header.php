<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Simpanah</title>
  
  <!-- FAVICON -->
  <!-- <link href="img/favicon.png" rel="shortcut icon"> -->
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->

  <link rel="shortcut icon" href="<?= base_url('favicon.ico'); ?>"/>
  <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>"/>
  <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap-slider.css'); ?>">
  <!-- Font Awesome -->
  <link href="<?= base_url('assets/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="<?= base_url('assets/plugins/slick-carousel/slick/slick.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/plugins/slick-carousel/slick/slick-theme.css"'); ?>" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="<?= base_url('assets/plugins/fancybox/jquery.fancybox.pack.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/plugins/jquery-nice-select/css/nice-select.css'); ?>" rel="stylesheet">

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

<section class="border-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg navbar-light">

					<?php if ( $role == 1) : ?>

					<a class="navbar-brand" href="<?= base_url();?>subsie">
						<img class="logo-header" src="<?= base_url(); ?>assets/images/logokecil2.png" alt="">
					</a>

					<?php else : ?>

					<a class="navbar-brand" href="<?= base_url();?>">
						<img class="logo-header" src="<?= base_url(); ?>assets/images/logokecil2.png" alt="">
					</a>

					<?php endif; ?>

					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto main-nav ">

							<?php if ( $role == 1) : ?>

							<?php else : ?>
							
							<li class="nav-item">
								<a class="nav-link" href="<?= base_url();?>">Beranda</a>
							</li>

							<?php endif; ?>

							<?php if ( $role == 1) : ?>

							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link" href="<?= base_url();?>subsie"> Pengaduan</a>
							</li>

							<?php else : ?>

							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link" href="<?= base_url();?>dashboard"> Pengaduan</a>
							</li>

							<?php endif; ?>

							
							<?php if ( $name == '' ) : ?> 

							<?php else : ?>

							<li class="nav-item">
								<div class="dropdown"><span> </span>
									<button class="btn dropdown-toggle" type="button" id="notifikasi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										Notifikasi
									<span class="badge badge-notif"> <?= $count_notif ?> </span></button>
									<div class="dropdown-menu notif" aria-labelledby="notifikasi">
										<div class="notif-header"> Notifikasi 
											<form method="post" action="<?= base_url('Home/del_all');?>">
												<button type="submit" class="del-notif"> Hapus Semua </button>
  											</form>
										</div>
										<div class="padding-notif">  
											<?php foreach ($notification as $notif) { ?>

											
											<form method="post" action="<?= base_url('Home/read_notification');?>">
											<input name="id_notif" value="<?= $notif->_id ?>" hidden>
											<input name="direction_notif" value="<?= $notif->direction?>" hidden>
												<button type="submit">
												<div class="margin-notif dropdown-item" >
											
													<img src="<?= base_url('assets/images/user/user-thumb.jpg') ?>" class="img-notif">
													<p class="tittle-notif"> <?= $notif->title ?> </p> 
													
													<?php if ( $notif->is_read ) : ?> 

													<?php else : ?>

													<span class="notif-read"> </span>
													
													<?php endif; ?>
													
													<a class="info-notif"> <?= $notif->body ?></a>
													<p class="time-notif">  <?= date("d-F-Y", strtotime($notif->created_at)) ?> | <?= date("H:i", strtotime($notif->created_at)) ?> </p>
													
												</div>
												</button>
											
											</form>

											<?php } ?>
										</div>
									</div>
								</div>
							</li>
							
							<?php endif; ?>



							<?php if ( $role == 0 && $name != '' ) : ?>

							<li class="nav-item">
								<a class="nav-link" href="<?= base_url();?>event">Event BPN</a>
							</li>

							<?php else : ?>

							<li class="nav-item">
								<a class="nav-link" href="<?= base_url();?>about">Tentang Simpanah</a>
							</li>

							<?php endif; ?>


							
						</ul>
						<ul class="navbar-nav ml-auto mt-10">

							<?php if ( $name == '' ) : ?>

							<li class="nav-item">
								<a class="nav-link login-button" href="<?= base_url();?>auth/login">Masuk</a>
							</li>
							<li class="nav-item">
								<a class="text-white add-button" href="<?= base_url();?>auth/register">Daftar</a>
							</li>

							<?php else : ?>

							<li class="nav-item">
							<div class="dropdown">
								<button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?= $name ?>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">

									<?php if ( $role === 1) : ?>
									
									<a href="<?= base_url();?>Subsie/profile"> <button class="dropdown-item" type="button">Edit Profile</button> </a>

									<?php else : ?>

									<a href="<?= base_url();?>Profile"> <button class="dropdown-item" type="button">Edit Profile</button> </a>

									<?php endif; ?>
									<a href="<?= base_url();?>Auth/logout">	<button class="dropdown-item" type="button"> Logout</button> </a>
								</div>
							</div>
							</li>
							
							<?php endif; ?>
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>


<script src="<?= base_url('assets/plugins/jQuery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/custom.js'); ?>"></script>