<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card" style="margin: 20px 0px 20px 0px; ">
            <div class="card-header">
                <h3>Login
                    <a href="<?= base_url('/') ?>" class="btn btn-danger float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= base_url('loginuser') ?>">
                    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                    <?php endif ?>
                    <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                    <?php endif ?>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= set_value('email') ?>">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="<?= set_value('password') ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <p>Didn't have an account? <a href="<?= site_url('register') ?>"> Create a new account </a></p>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>