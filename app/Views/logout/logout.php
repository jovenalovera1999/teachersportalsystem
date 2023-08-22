<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | Student's Information</title>

    <div class="container">
        <h3 class="mt-5">Are you sure you want to logout?</h3>
        <div class="row mt-3">
            <div class="col">
                <a href="<?=base_url()?>logout" class="btn btn-danger w-100">Yes</a>
            </div>
            <div class="col">
                <?php if(session()->get('myPosition') == 'Dean'): ?>
                    <a href="dean/dashboard" class="btn w-100" id="custom-button-color">No</a>
                <?php else: ?>
                    <a href="teacher/dashboard" class="btn w-100" id="custom-button-color">No</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?=$this->endSection('content')?>