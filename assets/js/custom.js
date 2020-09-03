var sub_id_list;
var sub_token;
var id_del_user;
var id_reply_user;
var id_del_reply;

$(document).ready(function() {

    // user

    $('#lihat-balasan').hide();
    // $('.modal-exit-sub').hide();


    $('#btn-view-reply').on('click', function() {
        $('#lihat-isi').hide()
        $('#lihat-balasan').show();
    });

    $('#btn-view-msg').on('click', function() {
        $('#lihat-isi').show()
        $('#lihat-balasan').hide();
    });

    // subsie

    $('#balas').hide();
    $('#toggle-balas').show();

    $('#btn-balas').on('click', function() {
        $('#lihat').hide()
        $('#balas').show();
        $('#toggle-balas').hide();

    });

    $('#sub-toogle-reply').on('click', function() {
        $('#lihat').show()
        $('#balas').hide();
        $('#toggle-balas').show();
    });


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // user

    // get complaint wait modal user by id

    $('.id-modal').on('click', function() {

        var id = $(this).data('id');
        // console.log(id);
        var token = $(this).val();


        $.ajax({

            url: 'https://simpanah.com:3000/v1/complaint/detail/' + id,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);
                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                $('#lihat-aduan').html(`

                <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="wrap-modal"> 
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">` + result.data.title + `</h5>
                    </div>
                    <div class="modal-body overlay">
                      <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6> <span class="status-modal"> ` + result.data.status + `</span>
                      <h6>Ditujukan Kepada : Subsie </h6> 
                      <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                      <br>

                      ` + result.data.complaint + `

                      </div>
                      <div class="wrap-footer-close text-center">
                        <button type="button" class="btn-close-modal" data-dismiss="modal">Tutup</button>
                      </div>
                    </div>
                  </div>
              </div>

                `);
            }
        });

    });


    // get reply history user modal by id 

    $('.id-reply-list-user').on('click', function() {
        var id_reply = $(this).data('id');
        id_reply_user = id_reply;
        // console.log(id_reply);

        var token = $(this).val();

        $.ajax({

            url: 'https://simpanah.com:3000/v1/complaint/detail_history/' + id_reply,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);

                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                var rating = '';

                if (result.data.complaint.rating == 1) {
                    rating = 'Kurang Puas';
                } else if (result.data.complaint.rating == 2) {
                    rating = 'Puas';
                } else {
                    rating = 'Sangat Puas';
                }


                $('#reply-tittle-user').html(`
                
                <h5 class="modal-title" >` + result.data.complaint.title + `</h5>


                `);

                $('#isi-pengaduan-user').html(`
                    <h6>ID Pengaduan : ` + result.data.complaint.no_aduan + ` </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                    <h6>Ditujukan Kepada : Subsie ` + result.data.complaint.type_subsie.subsie_name + ` </h6> 
                    <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                    <br>
                    ` + result.data.complaint.complaint + `

                `)

                $('#isi-balasan-user').html(`
                <h6>ID Pengaduan : 12345xxx </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Dibalas oleh : ` + result.data.subsie.subsie + `</h6> 
                            <h6>Dibalas pada : ` + tgl + ` | ` + time + ` WIB</h6>
                            <br>
                            <div class="tittle-balasan-pengaduan">Balasan Pengaduan </div>
                            ` + result.data.response + `

                 `)

                $('#id-rating').html(`
                    <div class="rating-score hidden-popup"> Penilaian Anda : <span> ` + rating + ` <span> 
                    </div>
                `)

                if (result.data.complaint.flag_rating == true) {
                    $("div").removeClass("hidden-popup")
                    $('.rating').hide();
                    $('.tutup').show();

                } else {
                    $('.rating').show();
                    $('.tutup').hide();
                }
            }
        });
    });



    // get complaint history modal user by id
    $('.id-history-modal').on('click', function() {

        var id_history = $(this).data('id');
        // console.log(id_history);

        var token = $(this).val();


        $.ajax({


            url: 'https://simpanah.com:3000/v1/complaint/detail/' + id_history,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);
                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                $('#tittle-history-by-id').html(`
                <h5 class="modal-title"> ` + result.data.title + `</h5>
                `);

                $('#isi-history-by-id').html(`
                <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6> <span class="status-modal-history"> ` + result.data.status + `</span>
                <h6>Ditujukan Kepada : ` + result.data.type_subsie.subsie_name + ` </h6> 
                <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                <br>

                ` + result.data.complaint + `

                `);


            }
        });

    });


    // delete history user by id

    $('.id-hapus-modal').on('click', function() {

        var id_delete = $(this).data('id');
        id_del_user = id_delete;

        var token = $(this).val();
        sub_token = token;
    });

    $('.toggle-del').on('click', function() {

        $.ajax({


            url: 'https://simpanah.com:3000/v1/complaint/delete/' + id_del_user,
            type: 'PUT',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + sub_token); },
            success: function(result) {

                // console.log(result);

                location.reload(true);

            }
        });

    });


    // delete reply user by id

    $('.id-hapus-reply').on('click', function() {

        var id_delete = $(this).data('id');
        id_del_reply = id_delete;

        var token = $(this).val();
        sub_token = token;

        // console.log(id_delete, token);
    });

    $('.toggle-del-reply').on('click', function() {

        $.ajax({


            url: 'https://simpanah.com:3000/v1/complaint/delete/' + id_del_reply,
            type: 'PUT',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + sub_token); },
            success: function(result) {

                // console.log(result);

                location.reload(true);

            }
        });

    });


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////



    // subsie

    // get list unanswered complaint modal subsie by id

    $('.id-list-subsie').on('click', function() {
        var id_list = $(this).data('id');
        sub_id_list = id_list;

        var token = $(this).val();
        sub_token = token;

        $.ajax({

            url: 'https://simpanah.com:3000/v1/subsie/complaint_detail/' + id_list,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);

                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                if (result.data.complaint_from == 0 || result.data.complaint_from == 1) {


                    $('#lihat').html(`

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">` + result.data.title + `</h5>
                    </div>

                    <div class="modal-body overlay">
                      <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6>
                      <h6>Pengirim : ` + result.data.user.name + ` </h6> 
                      <h6>Dikirim : ` + tgl + ` | ` + time + ` WIB </h6>
                      <br>

                      ` + result.data.complaint + `

                    </div>
                    `);

                    $('#tittle-for-reply').html(`
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Untuk : ` + result.data.user.name + `</h5> 
                    `);

                    $('#tittle-list-reply').html(`
                    <h6 class="font-weight-bold"> ` + result.data.title + `</h6> 
                    `);


                } else {

                    $('#lihat').html(`

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalScrollableTitle">` + result.data.title + `</h5>
                    </div>

                    <div class="modal-body overlay">
                      <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6>
                      <h6>Pengirim : ` + result.data.from_name + ` </h6> 
                      <h6>Dikirim : ` + tgl + ` | ` + time + ` WIB </h6>
                      <br>

                      ` + result.data.complaint + `

                    </div>
                    `);

                    $('#tittle-for-reply').html(`
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Untuk : ` + result.data.from_name + `</h5> 
                    `);

                    $('#tittle-list-reply').html(`
                    <h6 class="font-weight-bold"> ` + result.data.title + `</h6> 
                    `);

                };
            }
        });
    });


    // get list answered complaint modal subsie by id

    $('.id-answered-subsie').on('click', function() {
        var id_answer = $(this).data('id');

        var token = $(this).val();

        $.ajax({

            url: 'https://simpanah.com:3000/v1/subsie/complaint_detail/' + id_answer,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);

                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                if (result.data.complaint_from == 0 || result.data.complaint_from == 1) {

                    $('#lihat-history').html(`

                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header">
                          <h5 class="modal-title" id="history">` + result.data.title + `</h5>
                        </div>
                        <div class="modal-body overlay">
                          <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6> <span class="status-modal-history"> ` + result.data.status + `</span>
                          <h6>Pengirim : ` + result.data.user.name + ` </h6> 
                          <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                          <br>

                            ` + result.data.complaint + `

                          </div>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-sub-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                  </div>

                `);
                } else {

                    $('#lihat-history').html(`

                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                      <div class="wrap-modal"> 
                        <div class="modal-header">
                          <h5 class="modal-title" id="history">` + result.data.title + `</h5>
                        </div>
                        <div class="modal-body overlay">
                          <h6>ID Pengaduan : ` + result.data.no_aduan + ` </h6> <span class="status-modal-history"> ` + result.data.status + `</span>
                          <h6>Pengirim : ` + result.data.from_name + ` </h6> 
                          <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                          <br>

                            ` + result.data.complaint + `

                          </div>
                          <div class="wrap-footer-close text-center">
                            <button type="button" class="btn-sub-close-modal" data-dismiss="modal">Tutup</button>
                          </div>
                        </div>
                      </div>
                  </div>

                `);
                }

            }
        });
    });



    //get reply list answered complaint modal subsie by id

    $('.id-reply-list-subsie').on('click', function() {
        var id_answer = $(this).data('id');

        var token = $(this).val();

        $.ajax({

            url: 'https://simpanah.com:3000/v1/subsie/response_detail/' + id_answer,
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);

                var date = new Date(result.data.created_at);
                var month = date.getMonth() + 1;
                var day = date.getDate();
                var year = date.getFullYear();
                var hour = date.getHours();
                var minute = date.getMinutes();

                if (day < 10) { day = '0' + day };
                if (month < 10) { month = '0' + month };
                if (hour < 10) { hour = '0' + hour };
                if (minute < 10) { minute = '0' + minute };

                var tgl = day + "-" + month + "-" + year;
                var time = hour + "." + minute;

                $('#reply-tittle').html(`
                
                <h5 class="modal-title" >` + result.data.complaint.title + `</h5>


                `);

                $('#isi-pengaduan').html(`
                    <h6>ID Pengaduan : ` + result.data.complaint.no_aduan + ` </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                    <h6>Ditujukan Kepada : ` + result.data.complaint.type_subsie.subsie_name + ` </h6> 
                    <h6>Dibuat : ` + tgl + ` | ` + time + ` WIB </h6>
                    <br>
                    ` + result.data.complaint.complaint + `

                `)

                $('#isi-balasan').html(`
                <h6>ID Pengaduan : ` + result.data.complaint.no_aduan + ` </h6> <span class="status-modal-history"> Sudah Ditanggapi</span>
                            <h6>Dibalas oleh : ` + result.data.subsie.subsie + `</h6> 
                            <h6>Dibalas pada : ` + tgl + ` | ` + time + ` WIB</h6>
                            <br>
                            <div class="tittle-balasan-pengaduan">Balasan Pengaduan </div>
                            ` + result.data.response + `

                 `)
            }
        });
    });



    // post reply complaint modal subsie

    $('#kirim-balasan-subsie').on('click', function() {

        $.ajax({

            url: 'https://simpanah.com:3000/v1/subsie/reply',
            type: 'POST',
            data: {
                'id_complaint': sub_id_list,
                'response': $("#response").val()

            },
            crossDomain: true,
            dataType: 'json',

            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + sub_token); },
            success: function(result) {

                // console.log(result.iserror);

                if (result.iserror == false) {
                    $("div").removeClass("hidden-popup");
                    $('.modal-exit-sub').show();

                }

            }

        });

    });

    // put ratiing

    $('.btn-close-modal-rating').on('click', function() {

        var token = $(this).val();
        sub_token = token;

        $.ajax({

            url: 'https://simpanah.com:3000/v1/complaint/rating',
            type: 'PUT',
            data: {
                'id_complaint': id_reply_user,
                'rating': $("input[name='radio']:checked").val()

            },
            crossDomain: true,
            dataType: 'json',

            beforeSend: function(xhr) { xhr.setRequestHeader('Authorization', 'Bearer ' + token); },
            success: function(result) {

                // console.log(result);

                if (result.status == 200) {

                    $("div").removeClass("hidden-rating");


                }

            }

        });

    });


    // popup feedback modal


    $('#close-modal-aduan').on('click', function() {
        $('.modal-exit').hide();
    });

    $('.close-modal-rating').on('click', function() {
        $('.exit-rating').hide();
    });

    $('.btn-sub-close-modal').on('click', function() {
        $('.modal-exit-sub').hide();
    });

    $('.close-modal-success').on('click', function() {
        location.reload(true);
    });


});
