<section class="dashboard section">
  <!-- Container Start -->
  <div class="container">
    <!-- Row Start -->
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
              <li class="active"><a href="<?= base_url();?>reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
              <li><a href="<?= base_url();?>profile"><i class="fa fa-user"></i> Ubah Profil </a></li>
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
        <!-- Recently Favorited -->
        <div class="widget dashboard-container my-adslist">
          <p class="tittle-report">Balasan Pengaduan</p>
            <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Subjek Pengaduan</th>
                  <th class="text-center"> Kepuasan </th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($reply as $reply) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"><?=  date("d-F-Y", strtotime($reply->created_at))?></div>
                  </td>
                  <td class="product-details-history">
                    <div class="text-table-info text-overflow"><?= $reply->title ?></div>
                  </td>
                  <td class="action-reply">

                  <?php if ( $reply->rating == 1) : ?>

                  <img class="img-rating" src=" <?= base_url();?>assets/images/rating/sad.png">

                  <?php elseif ($reply->rating == 2) : ?>

                  <img class="img-rating" src=" <?= base_url();?>assets/images/rating/happy.png">

                  <?php else : ?>

                   <img class="img-rating" src=" <?= base_url();?>assets/images/rating/very_happy.png">

                  <?php endif; ?>

                  </td>
                   <td class="action-reply"> 
                    <button type="submit" data-id="<?= $reply->_id ?>" class="btn-history-view id-reply-list-user" value="<?= $token; ?>"  data-toggle="modal" data-target="#lihat-reply"> Lihat</button>
                    <button type="button" class="btn-history-delete id-hapus-reply" data-id="<?= $reply->_id ?>" value="<?= $token; ?>" data-toggle="modal" data-target="#hapus-reply"> hapus</button>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="lihat-reply" tabindex="-1" role="dialog" aria-labelledby="reply" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header" id="reply-tittle-user">
                          <h5 class="modal-title">Pengaduan Tanah Orang</h5>
                        </div>
                        <div id="lihat-isi">
                          <div class="modal-body overlay" id="isi-pengaduan-user">
                            <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Ditujukan Kepada : Subsie A </h6> 
                            <h6>Dibuat : 13 Maret 2019 | 10.00 WIB </h6>
                            <br>

                            
                          </div>
                          <p id="btn-view-reply" class="toggle-modal-hide"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Lihat Balasan Pengaduan</p>
                          
                            <div id="id-rating" class="rating-score hidden-popup"> Penilaian Anda : <span> Puas <span> </div>

                          <div class="tittle-balasan-pengaduan rating">Beri Tanggapan terhadap Balasan Pengaduan :</div>
                         
                            <div class="form-check form-check-inline rating">
                              <label class="customradio"> Kurang Puas
                                
                                <input type="radio" class="form-check-input" checked="checked" value="1" name="radio">
                                
                                <span class="checkmark"></span>
                              </label>        
                              <label class="customradio">Puas
                                <input type="radio" class="form-check-input" name="radio" value="2">
                                
                                <span class="checkmark"></span>
                              </label>
                              <label class="customradio">Sangat Puas
                                <input type="radio" class="form-check-input" value="3" name="radio">
                                
                                <span class="checkmark"></span>
                              </label>
                            </div>
                          
                          <div class="wrap-footer-close text-center">
                            <button type="submit" value="<?= $token ?>" id="send-rating" data-dismiss="modal" class="btn-close-modal-rating rating">Kirim Tanggapan</button>
                            <button type="submit" data-dismiss="modal" class="btn-close-modal tutup">Tutup</button>
                          </div>
                          
                        </div>

                        <!-- balasan isi -->
                        <div id="lihat-balasan"> 
                          <div class="modal-body overlay" id="isi-balasan-user">
                            <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Dibalas oleh : Subsie A</h6> 
                            <h6>Dibalas pada : 14 Maret 2019 | 14.00 WIB</h6>
                            <br>
                            <div class="tittle-balasan-pengaduan">Balasan Pengaduan </div>
                           
                          </div>

                          <p id="btn-view-msg" class="toggle-modal-hide"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Lihat Isi Pengaduan Saya</p>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="bg-popup exit-rating hidden-rating"> </div>
                <div class="popup-coba-rating exit-rating hidden-rating"> 
                  <p class="tittle-modal-rating"> Terimakasih ! </p>
                  <div class="text-modal-aduan"> Anda sudah menggunakan layanan <span> Simpanah </span> dan memberi tanggapan
                        terhadap balasan pengaduan dari kami. Apabila balasan kurang
                        memuaskan, Anda dapat melanjutkan bahasan pengaduan 
                        dengan membuat Pengaduan Baru.
                  </div>
                  <button class="btn-modal-aduan close-modal-rating">Oke</button>
                </div>

                <!-- modal hapus -->

                <div class="modal fade" id="hapus-reply" tabindex="-1" role="dialog" aria-labelledby="hapus-reply" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <!-- <h5 class="modal-title" id="hapus-history">Anda yakin menghapus pengaduan ini?</h5> -->
                      </div>
                      <div class="modal-body">
                        <h4 class="modal-title" id="hapus-history">Anda yakin menghapus pengaduan ini?</h4>
                      </div>
                      <div class="wrap-footer-delete">
                        <button type="button" class="btn-cancel" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn-close-modal toggle-del-reply">Ya</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <?php } ?>

              </tbody>
            </table>

              <!-- pagination -->

              <?= $pagination ?>
              
              <!-- pagination -->


        </div>

      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</section>