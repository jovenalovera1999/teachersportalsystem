<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | User Authentication</title>
<?=$this->include('include/toast_message')?>
<?php if(isset($validation)): ?>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container top-0 end-0 p-3">
            <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    <svg width="1.25em" height="1.25em" class="bi bi-exclamation-circle-fill" fill="currentColor">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <strong class="me-auto">Failed to login!</strong>
                    <?=$validation->listErrors();?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container">
    <div class="card mt-5 p-1 mx-auto col-xl-7 col-sm-12">
        <div class="card-body">
            <h3 class="card-title">Teacher's Portal</h3>
            <h5 class="card-subtitle mb-2 text-muted">User authentication</h5>
            <!-- Form login -->
            <form class="mt-5" action="<?=base_url()?>" method="post">
                <div class="mb-3">
                    <label for="email_address" class="form-label">Email Address</label>
                    <input type="text" class="form-control" id="email_address" name="email_address" value="<?=set_value('email_address')?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>