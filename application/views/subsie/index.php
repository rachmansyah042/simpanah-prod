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
              <li class="sub active"><a href="<?= base_url();?>subsie"><i class="fa fa-file-text"></i> Pengaduan Masuk</a></li>
              <li class="sub"><a href="<?= base_url();?>subsie/reply"><i class="fa fa-inbox"></i> Balasan Pengaduan</a></li>
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
          <p class="tittle-report">Pengaduan Saya</p>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link tab active" id="belum-tab" data-toggle="tab" href="#belum" role="tab" aria-controls="proses" aria-selected="true">Belum Dibalas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link tab " id="sudah-tab" data-toggle="tab" href="#sudah" role="tab" aria-controls="riwayat" aria-selected="false">Sudah DIbalas</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="belum" role="tabpanel" aria-labelledby="belum-tab">

            <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Judul Pengaduan</th>
                  <th class="text-center">Pengirim</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($subsie_list as $list) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"><?=  date("d-F-Y", strtotime($list->created_at))?></div>
                  </td>
                  <td class="product-details">
                    <div class="text-table-info text-overflow"><?= $list->title ?></div>
                  </td>
                 
                  <?php if ($list->complaint_from == 0 || $list->complaint_from == 1 ) : ?> 
                 
                  <td class="product-category"><span class="text-table-status"><?= $list->user->name ?></span></td>
     
                  <?php else : ?>


                  <td class="product-category"><span class="text-table-status"><?= $list->from_name ?></span></td>
                  
                  <?php endif; ?>

                  <td class="action">
                      <button type="submit" data-id="<?= $list->_id ?>" class="btn-act-view-reply id-list-subsie" value="<?= $token; ?>" data-toggle="modal" data-target="#lihat-balas-aduan"> Lihat & Balas</button>
                  </td>
                </tr>

                    <!-- popup success subsie -->
                    <div id="popup-subsie-success">
                      <div class="bg-popup modal-exit-sub hidden-popup"> </div>
                        <div class="popup-coba-sub modal-exit-sub hidden-popup"> 
                          <p class="tittle-modal-sub"> Berhasil Mengirim Balasan Pengaduan </p>

                        <button class="btn-sub-close-modal close-modal-success" id="close-modal-sub">Oke</button>
                       </div>   
                    </div>

                <!-- Modal -->
                <div class="modal fade" id="lihat-balas-aduan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div id="lihat"> 
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Pengaduan Tanah Orang</h5>
                          </div> 

                          <div class="modal-body overlay">
                            <h6>ID Pengaduan : 44567 </h6>
                            <h6>Pengirim : Anonim </h6> 
                            <h6>Dikirim : 13 Maret 2019 | 10.00 WIB </h6>
                            <br>

                          </div>
                        </div>
                        
                        <div id="toggle-balas">
                          <div class="wrap-footer-close text-center">
                              <button type="button" id="btn-balas" class="btn-sub-close-modal">Balas</button>
                          </div>
                        </div>

                        <div id="balas"> 
                          <div class="modal-header" id="tittle-for-reply">
                            <h5 class="modal-title" id="exampleModalScrollableTitle">Untuk : Baguus Ali Mashar</h5>
                          </div>

                            <div class="modal-body overlay">
                              <h6 class="font-weight-normal">Judul Pengaduan :</h6>
                              <div id="tittle-list-reply">
                                <h6 class="font-weight-bold">Pengaduan Tanah Orang Kepada Pak RT </h6> 
                              </div>
                              <br>
                            
                              <p id="sub-toogle-reply" class="toggle-sub-modal-hide"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Lihat Balasan Pengaduan</p>
                            
                              <textarea id="response" placeholder="Ketik balasan anda ..." class="form-control text-sub-balas"></textarea>
                            
                            </div>

                            <div class="wrap-footer-close text-center">
                              <button type="submit" id="kirim-balasan-subsie" class="btn-sub-close-modal" data-dismiss="modal">Kirim</button>
                            </div>
                       
                        </div>
                        </div>
                      </div>
                  </div>
                </div>

              <?php } ?>

              </tbody>
            </table>

                <?= $pagination_unanswered ?>

              <!-- pagination -->
              <!-- <div class="pagination justify-content-end">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item sub">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item sub active"><a class="page-link" href="#">1</a></li>
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

            <div class="tab-pane fade" id="sudah" role="tabpanel" aria-labelledby="sudah-tab">

              <table class="table table-responsive product-dashboard-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Judul Pengaduan</th>
                  <th class="text-center">Pengirim</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($subsie_list_answered as $answered) { ?>
                <tr>
                  <td class="product-thumb">
                    <div class="text-table-info"><?=  date("d-F-Y", strtotime($answered->created_at))?></div>
                  </td>
                  <td class="product-details-history">
                    <div class="text-table-info text-overflow"><?= $answered->title ?></div>
                  </td>
                  
                  <?php if ($answered->complaint_from == 0 || $answered->complaint_from == 1) : ?> 

                  <td class="product-category"><span class="text-table-status-history"><?= $answered->user->name ?></span></td>

                  <?php else : ?>
   
                  <td class="product-category"><span class="text-table-status-history"><?= $answered->from_name ?></span></td>

                  <?php endif; ?>

                  <td class="action"> 
                    <button type="submit" data-id="<?= $answered->_id ?>" class="btn-history-view id-answered-subsie" value="<?= $token; ?>" data-toggle="modal" data-target="#lihat-history"> Lihat</button>
                    <!-- <button type="button" class="btn-history-delete"  data-toggle="modal" data-target="#hapus-history"> hapus</button> -->
                  </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="lihat-history" tabindex="-1" role="dialog" aria-labelledby="history" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header">
                          <h5 class="modal-title" id="history">Pengaduan Tanah Orang</h5>
                        </div>
                        <div class="modal-body overlay">
                          <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Dijawab</span>
                          <h6>Pengirim : Bagus Ali Mashar </h6> 
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
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-sub-close-modal" data-dismiss="modal">Tutup</button>
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

              <!-- <div class="pagination justify-content-end">
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item sub">
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

      </div>
    </div>
    <!-- Row End -->
  </div>
  <!-- Container End -->
</section>