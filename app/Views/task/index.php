<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card w-50" style="margin: 20px 0px 20px 0px; ">
    <div class="card-header">
        <h3>My Profile</h3>
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= ucfirst($userinfo['first_name']) . " " . ucfirst($userinfo['last_name']) ?></h5>
        <p class="card-text"><?= $userinfo['email'] ?></p>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item"><?= $userinfo['phone'] ?></li>
        <li class="list-group-item"><?= $userinfo['address'] ?></li>
    </ul>
</div>
<div class="card" style="margin: 20px 0px 20px 0px; ">
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
    <div class="card-header">
        <h3>To Do List
            <a href="<?= base_url('/task/create') ?>" class="btn btn-primary float-end">Add New</a>
        </h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col" style="text-align:center;">S.No</th>
                    <th scope="col" style="text-align:center;">Title</th>
                    <th scope="col" style="text-align:center;">Description</th>
                    <th scope="col" style="text-align:center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tasks)) :
                    foreach ($tasks as $key => $value) :
                ?>
                        <tr>
                            <th scope="row" style="text-align:center;"><?= $value['id'] ?></th>
                            <td style="text-align:center;"><?= $value['title'] ?></td>
                            <td style="text-align:center;"><?= $value['description'] ?></td>
                            <td style="text-align:center;">
                                <a href="<?= base_url('task/edit/' . $value['id']) ?>" class="btn btn-outline-success">Edit</a>
                                <a href="<?= base_url('task/delete/' . $value['id']) ?>" class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                else :
                    ?>
                    <p>No Tasks Found</p>
                <?php
                endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>