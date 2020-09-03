<section class="login py-5 border-top-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8 align-item-center">
                <div class="border border">
                <?= $this->session->flashdata('sudahdaftar'); ?>
                <?= $this->session->flashdata('salah'); ?>
                <?= $this->session->flashdata('done'); ?>
                    <h3 class="bg-gray text-white p-4">Daftar Sekarang</h3>
                    <form method="post" action="<?= base_url('Auth/register') ;?>">
                        <fieldset class="p-4">
                            <input type="text" placeholder="Nama" name="name" class="border p-3 w-100 my-2" value="<?= set_value('name'); ?>"> 
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>

                            <input type="text" placeholder="Email" name="email" class="border p-3 w-100 my-2" value="<?= set_value('email'); ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                            <input type="text" placeholder="Username" name="username" class="border p-3 w-100 my-2" value="<?= set_value('username'); ?>">
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>

                            <input type="password" placeholder="Password" name="password" class="border p-3 w-100 my-2">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                            <!-- <div class="loggedin-forgot d-inline-flex my-3">
                                    <input type="checkbox" id="registering" class="mt-1">
                                    <label for="registering" class="px-2">Menyetujui <a class="text-primary font-weight-bold" href="terms-condition.html">Syarat dan Ketentuan</a></label>
                            </div> -->
                            <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold margin-top-btn text-center">Daftar Sekarang</button>
                            <a class="mt-3 d-inline-block text-primary" href="<?= base_url();?>auth/login">Sudah Punya Akun ? Masuk Disini!</a>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>