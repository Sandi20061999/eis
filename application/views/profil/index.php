<div class="row">
    <div class="col-xl-12 order-xl-6">
        <div class="card card-profile">
            <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                    <div class="card-profile-image">
                        <a href="#">
                            <img src="<?= isset($user['image']) ? base_url('assets/img/profil/' . $user['image']) : base_url('assets/img/profil/default.png') ?> " class="rounded-circle bg-white" width="150" height="150">
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
            </div>
            <div class="card-body pt-5">
                <div class="text-center ">
                    <?= $this->session->flashdata('message'); ?>
                    <h5 class="h3">
                        <?= $user['nama']; ?><span class="font-weight-light">, <?= $user['role'] ?> </span>
                    </h5>
                    <div class="h5 font-weight-300">
                        <i class="ni ni-email-83 mr-2"></i><?= $user['email']; ?>
                    </div>
                </div>
                <hr>
                <p class="bg-secondary col-md-2 text-center rounded ">Action Button</p>
                <div class="d-flex mt-2">
                    <button type="button" class="btn btn-secondary text-blue" data-toggle="modal" data-target="#exampleModal1">
                        Edit Akun
                    </button>
                    <button type="button" class="btn btn-secondary text-green" data-toggle="modal" data-target="#exampleModal3">
                        Ganti foto
                    </button>
                    <button type="button" class="btn btn-secondary text-orange" data-toggle="modal" data-target="#exampleModal2">
                        Ubah Password
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal1 -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <?php echo form_open('user/profil/', array("role" => "form")); ?>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>
                        <input class="form-control" placeholder="Name" type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $user['nama']); ?>">
                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                        </div>
                        <input class="form-control" placeholder="Email" type="email" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>">
                        <span class="text-danger"><?php echo form_error('email'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                        </div>
                        <input class="form-control" placeholder="Phone Number" type="text" name="phone" value="<?php if (isset($user['phonenumber'])) {
                                                                                                                    echo ($this->input->post('phone') ? $this->input->post('phone') : $user['phonenumber']);
                                                                                                                } ?>">
                        <span class="text-danger"><?php echo form_error('phone'); ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="bprofil" class="btn btn-primary">Save changes</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('user/profil/', array("role" => "form")); ?>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>
                        <input class="form-control" placeholder="New Password" type="password" name="newpass" id="newpass" minlength="6">
                        <span class="text-danger"><?php echo form_error('newpass'); ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                        </div>
                        <input class="form-control" placeholder="Confirm Password" type="password" name="confirmpass" id="confirmpass" minlength="6">
                        <span class="text-danger"><?php echo form_error('confirmpass'); ?></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btncpass" name="bpassword" class="btn btn-primary">Save changes</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- Modal3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('user/profil/', array("role" => "form",)); ?>
                <div class="input-group">
                    <div class=" custom-file">
                        <input type="file" name="photo" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" accept="image/*" required>
                        <label class="custom-file-label" for="inputGroupFile04">Ganti Foto</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="bfoto" class="btn btn-primary">Save changes</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>