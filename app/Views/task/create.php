<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="card" style="margin: 20px 0px 20px 0px; ">
    <div class="card-header">
        <h3>Create New Task
            <a href="<?= base_url('/') ?>" class="btn btn-danger float-end">Back</a>
        </h3>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= base_url('add-task') ?>">
            <?= csrf_field() ?>
            <input type="hidden" name="users_id" id="users_id" value="<?= $userid ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" >
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'description') : '' ?></span>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>