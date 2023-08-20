<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | Dean's Dashboard</title>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <!-- Sidebar icon none -->
                </button>
            </div>
            <div class="p-4">
                <h1><a href="#" class="logo">Dean's Portal<span class="text-white mt-4" style="font-size: 17px;">User Logged In:<br><?=session()->get('myFullName')?></span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href="<?=base_url()?>student/list">Students</a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>logout">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container">
                
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>