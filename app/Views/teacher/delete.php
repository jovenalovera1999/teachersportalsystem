<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | Register a Teacher</title>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <!-- Sidebar icon none -->
                </button>
            </div>
            <div class="p-4">
                <h1><a href="#" class="logo">Teacher's Portal<span class="text-white mt-4" style="font-size: 17px;">User Logged In:<br><?=session()->get('myFullName')?></span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="<?=base_url()?>teacher/list">Teachers</a>
                    </li>
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
                <div class="card-body w-75 mx-auto">
                    <h3 class="card-title">Are you sure you want to delete this teacher?</h3>
                    <!-- Form login -->
                    <form class="mt-5" action="<?=base_url()?>teacher/delete/<?=$user->user_id?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control bg-white" id="first_name" name="first_name" value="<?=$user->first_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control bg-white" id="middle_name" name="middle_name" value="<?=$user->middle_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control bg-white" id="last_name" name="last_name" value="<?=$user->last_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Last Name</label>
                                    <input type="text" class="form-control bg-white" id="gender" name="gender" value="<?=$user->gender?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="text" class="form-control bg-white" id="age" name="age" value="<?=$user->age?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control bg-white" id="address" name="address" value="<?=$user->address?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control bg-white" id="contact_number" name="contact_number" value="<?=$user->contact_number?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label">Email Address</label>
                                    <input type="text" class="form-control bg-white" id="email_address" name="email_address" value="<?=$user->email_address?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control bg-white" id="password" name="password" value="<?=$user->password?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="position" class="form-label">Position</label>
                                    <input type="text" class="form-control bg-white" id="position" name="position" value="<?=$user->position?>" disabled>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                        <a href="<?=base_url()?>teacher/list" class=" btn w-100 mt-3" id="custom-button-color">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>