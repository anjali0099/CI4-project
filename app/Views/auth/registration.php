<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card" style="margin: 20px 0px 20px 0px; ">
            <div class="card-header">
                <h3>Registration
                    <a href="<?= base_url('/') ?>" class="btn btn-danger float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('register') ?>">
                    <?= csrf_field() ?>
                    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= set_value('first_name'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'first_name') : '' ?></span>
                        </div>
                        <div class="col">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= set_value('last_name'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'last_name') : '' ?></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= set_value('email'); ?>">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="passconf" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="passconf" name="passconf" value="<?= set_value('passconf'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'passconf') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="<?= set_value('phone'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?= set_value('address'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <p>Already have an account? <a href="<?= site_url('login') ?>"> Sign In </a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>