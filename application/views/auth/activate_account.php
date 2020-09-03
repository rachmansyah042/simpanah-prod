<section class="login py-5 border-top-1"> 
    <div class="container">
        <div class="row justify-content-center margin-login">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border">
                    <?= $this->session->flashdata('aktivasi'); ?>
                    <?= $this->session->flashdata('active_account'); ?>
                    <?= $this->session->flashdata('expired'); ?>
                    <h3 class="bg-gray text-white p-4">Masuk Sekarang</h3>
                    <form action="<?= base_url('Auth/activate_account/'.$params) ;?>" method="post">
                        <fieldset class="p-4">
                            <input type="text" placeholder="Email" name="email" class="border p-3 w-100 my-2" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                            
                            <input type="password" placeholder="Password" name="password" class="border p-3 w-100 my-2">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                            <?= $this->session->flashdata('message'); ?>

                            <button type="submit" class="d-block py-3 px-5 bg-primary text-white border-0 rounded font-weight-bold mt-3 text-center">Masuk</button>
                            <a class="mt-3 d-inline-block text-primary" href="<?= base_url();?>auth/forgot_password">Lupa Password ? Klik Disini!</a>
                            <a class="mt-3 d-inline-block text-primary" href="<?= base_url();?>auth/register">Belum Punya Akun ? Daftar Disini!</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>