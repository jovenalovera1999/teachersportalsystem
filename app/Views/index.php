<!-- Master Page -->
<?= $this->extend('layout/main') ?>

<!-- Content -->
<?= $this->section('content') ?>

<title>Teacher's Portal | User Authentication</title>

<div class="container">
    <div class="card mt-5 p-1 mx-auto col-xl-7 col-sm-12">
        <div class="card-body">
            <h3 class="card-title">Teacher's Portal</h3>
            <h5 class="card-subtitle mb-2 text-muted">User authentication</h5>
            <!-- Form login -->
            <form class="mt-5">
                <div class="mb-3">
                    <label for="email_address" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email_address" name="email_address">
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