<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center margin-forgot">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <h3 class="bg-gray text-white p-4">Lupa Password</h3>
                    <form action="<?= base_url('Auth/lupa_password/'.$params) ;?>" method="post">
                        <fieldset class="p-4">
                            <input type="password" placeholder="Password Baru" name="password" class="border p-3 w-100 my-2">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                            
                            <?= $this->session->flashdata('message'); ?>

                            <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3 text-center">Kirim</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>