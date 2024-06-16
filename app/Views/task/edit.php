<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card" style="margin: 20px 0px 20px 0px; ">
    <div class="card-header">
        <h3>Edit Task
            <a href="<?= base_url('/dashboard') ?>" class="btn btn-danger float-end">Back</a>
        </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= base_url('task/update/'.$task['id']) ?>">
            <?php if (!empty(session()->getFlashdata('fail'))) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
            <?php endif ?>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
            <?php endif ?>
            <?= csrf_field() ?>
            <input type="hidden" name="users_id" id="users_id" value="<?= $task['users_id'] ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $task['title'] ?? '' ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?= $task['description'] ?? '' ?></textarea>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>