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
              <img src="<?= base_url();?>assets/images/user/user-thumb.jpg" alt="" class="rounded-circle">
            </div>
            <!-- User Name -->
            <h5 class="text-center margin-name-user"><?= $name ?></h5>
            <ul>
              <li class="sub"><a href="<?= base_url();?>subsie"><i class="fa fa-file-text"></i> Pengaduan Masuk</a></li>
              <li class="sub active"><a href="<?= base_url();?>subsie/reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
              <li class="sub"><a href="<?= base_url();?>subsie/profile"><i class="fa fa-user"></i> Edit Profil </a></li>
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
        <!-- Recently Favorited --> 
        <div class="widget dashboard-container my-adslist">
          <p class="tittle-report">Balasan Pengaduan</p>
            <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal Balas</th>
                  <th>Untuk</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($subsie_reply_answered as $reply) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"><?=  date("d-F-Y", strtotime($reply->created_at))?></div>
                  </td>
                  <td class="product-details-history">


                  <?php if ($reply->complaint_from == 0 || $reply->complaint_from == 1) : ?> 

                    <p class="text-table-info text-overflow"><?= $reply->user->name ?></p>

                  <?php else : ?>

                    <p class="text-table-info text-overflow"><?= $reply->from_name ?></p>

                  <?php endif; ?> 


                  </td>
                   <td class="action-reply"> 
                    <button type="submit" data-id="<?= $reply->_id ?>" class="btn-history-view id-reply-list-subsie" value="<?= $token; ?>" data-toggle="modal" data-target="#lihat-reply"> Lihat</button>
                    <!-- <button type="button" class="btn-history-delete"  data-toggle="modal" data-target="#hapus-reply"> hapus</button> -->
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="lihat-reply" tabindex="-1" role="dialog" aria-labelledby="reply" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header" id="reply-tittle">
                          <h5 class="modal-title" ></h5>
                        </div>
                        <div id="lihat-isi">
                          <div class="modal-body overlay" id="isi-pengaduan">
                            <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Ditujukan Kepada : Subsie A </h6> 
                            <h6>Dibuat : 13 Maret 2019 | 10.00 WIB </h6>
                            <br>

                            is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum. is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum.is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum.
                          </div>
                          <p id="btn-view-reply" class="toggle-sub-modal-hide"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Lihat Balasan Pengaduan</p>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-sub-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>

                        <!-- balasan isi -->
                        <div id="lihat-balasan"> 
                          <div class="modal-body overlay" id="isi-balasan">
                            <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Dibalas oleh : Subsie A</h6> 
                            <h6>Dibalas pada : 14 Maret 2019 | 14.00 WIB</h6>
                            <br>
                            <div class="tittle-balasan-pengaduan">Balasan Pengaduan </div>
                            is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum. is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum.is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                            has been the industry's standard dummy text ever since the 1500s, when an
                            unknown printer took a galley of type and  crambled it to make a type
                            specimen book. It has survived not only five centuries, but also the leap into
                            electronic type setting, remaining essentially unchanged. It was popularised
                            in the 1 960s with the release of Letraset sheets containing Lorem Ipsum
                            pass ages, and more recently with desktop publishi ng software like Aldus
                            PageMaker including versions of Lorem Ipsum.
                          </div>
                          <p id="btn-view-msg" class="toggle-sub-modal-hide"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Lihat Isi Pengaduan Saya</p>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-sub-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
                        <button type="button" class="btn-sub-cancel" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn-sub-close-modal">Ya</button>
                      </div>
                    </div>
                  </div>
                </div>

                <?php } ?>

              </tbody>
            </table>

              <!-- pagination -->

              <?= $pagination ?>
              <!-- <div class="pagination justify-content-end mt-reply-pag">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item sub active" ><a class="page-link" href="#">1</a></li>
                    <li class="page-item sub "><a class="page-link" href="#">2</a></li>
                    <li class="page-item sub"><a class="page-link" href="#">3</a></li>
                    <li class="page-item sub">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div> -->
              <!-- pagination -->


        </div>

      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</section>