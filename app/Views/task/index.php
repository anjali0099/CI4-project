<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card w-50" style="margin: 20px 0px 20px 0px; ">
    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>
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
    <div class="card-header">
        <h3>To Do List
            <button type="submit" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createModal">
                Add New
            </button>
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
                <tr>
                    <th scope="row" style="text-align:center;">1</th>
                    <td style="text-align:center;">Lorem Ipsum</td>
                    <td style="text-align:center;">Otto</td>
                    <td style="text-align:center;">
                        <a href="#" class="btn btn-outline-secondary">View</a>
                        <a href="#" class="btn btn-outline-success">Edit</a>
                        <a href="#" class="btn btn-outline-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createModalLabel">Add Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= base_url('add-task') ?>">
                    <?= csrf_field() ?>
                    <input type="hidden" name="users_id" id="users_id" value="<?= $userinfo['id'] ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>