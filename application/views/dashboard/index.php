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
              <li class="active"><a href="<?= base_url();?>dashboard"><i class="fa fa-file-text"></i> Pengaduan Saya</a></li>
              <li><a href="<?= base_url();?>reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
              <li><a href="<?= base_url();?>profile"><i class="fa fa-user"></i> Ubah Profil </a></li>
              <li><a href="<?= base_url();?>auth/change_password"><i class="fa fa-lock"></i> Ubah Password </a></li>
              <li><a href="" data-toggle="modal" data-target="#logout"><i class="fa fa-sign-out"></i> Logout</a></li>
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
          <p class="tittle-report">Pengaduan Saya</p>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="proses-tab" data-toggle="tab" href="#proses" role="tab" aria-controls="proses" aria-selected="true">Dalam Proses</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="riwayat-tab" data-toggle="tab" href="#riwayat" role="tab" aria-controls="riwayat" aria-selected="false">Riwayat</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="proses" role="tabpanel" aria-labelledby="proses-tab">

            <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Subjek Pengaduan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($wait as $wait) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"> <?=  date("d-F-Y", strtotime($wait->created_at))?> </div>
                  </td>
                  <td class="product-details">
                    <div class="text-table-info text-overflow"><?= $wait->title ?></div>
                  </td>
                  <td class="product-category"><span class="text-table-status"><?= $wait->status ?></span></td>
                  <td class="action">
                      <button type="submit" id="lihat-modal-aduan" value="<?= $token; ?>" class="btn-act-view id-modal" data-id="<?= $wait->_id ?>" data-toggle="modal" data-target="#lihat-aduan"> Lihat</button>
                  </td>
                </tr>

                 <!-- Modal -->
                 <div class="modal fade" id="lihat-aduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalScrollableTitle">Pengaduan Tanah Orang</h5>
                        </div>
                        <div class="modal-body overlay">
                          <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal"> Menunggu Tanggapan</span>
                          <h6>Ditujukan Kepada : Subsie A </h6> 
                          <h6>Dibuat : 13 Maret 2019 | 10.00 WIB </h6>
                          <br>
                          
                          </div>

                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

              <?php } ?>

              </tbody>
            </table>

               <?= $pagination ?>
            </div>

            <div class="tab-pane fade" id="riwayat" role="tabpanel" aria-labelledby="riwayat-tab">

              <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Subjek Pengaduan</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php
              foreach ($history as $history) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"><?=  date("d-F-Y", strtotime($history->created_at))?></div>
                  </td>
                  <td class="product-details-history">
                    <div class="text-table-info text-overflow"><?= $history->title ?></div>
                  </td>
                  <td class="product-category"><span class="text-table-status-history"><?= $history->status ?></span></td>
                  <td class="action"> 
                    <button type="button" class="btn-history-view id-history-modal" value="<?= $token; ?>" data-id="<?= $history->_id ?>" data-toggle="modal" data-target="#lihat-history"> Lihat</button>
                    <button type="button" class="btn-history-delete id-hapus-modal" value="<?= $token; ?>" data-id="<?= $history->_id ?>" data-toggle="modal" data-target="#hapus-history"> hapus</button>
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="lihat-history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header" id="tittle-history-by-id">
                          <h5 class="modal-title">Pengaduan Tanah Orang</h5>
                        </div>
                        <div class="modal-body overlay" id="isi-history-by-id">
                          <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                          <h6>Ditujukan Kepada : Subsie A </h6> 
                          <h6>Dibuat : 13 Maret 2019 | 10.00 WIB </h6>
                          <br>

                         
                          </div>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>

                <!-- modal hapus -->

                <div class="modal fade" id="hapus-history" tabindex="-1" role="dialog" aria-labelledby="hapus-history" aria-hidden="true">
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
                        <button type="button" class="btn-close-modal toggle-del" data-dismiss="modal">Ya</button>
                      </div>
                    </div>
                  </div>
                </div>

                <?php } ?>

              </tbody>
            </table>

            <?= $pagination_history ?>

              <!-- pagination -->
              <!-- <div class="pagination justify-content-end">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active" ><a class="page-link" href="#">1</a></li>
                    <li class="page-item "><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
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

      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</section>