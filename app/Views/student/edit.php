<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | Edit Student</title>

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
                    <?php if(session()->get('myPosition') == 'Dean'): ?>
                        <li>
                            <a href="<?=base_url()?>teacher/list">Teachers</a>
                        </li>
                        <li class="active">
                            <a href="<?=base_url()?>student/list">Students</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="active">
                            <a href="<?=base_url()?>student/list">Students</a>
                        </li>
                        <li>
                            <a href="<?=base_url()?>confirm_logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <?=$this->include('include/toast_message')?>
            <?php if(isset($validation)): ?>
                <div aria-live="polite" aria-atomic="true" class="position-relative">
                    <div class="toast-container top-0 end-0 p-3">
                        <div class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <svg width="1.25em" height="1.25em" class="bi bi-exclamation-circle-fill" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                </svg>
                                <strong class="me-auto">Failed to save!</strong>
                                <?= $validation->listErrors(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="card-body w-75 mx-auto">
                    <h3 class="card-title">Edit Student</h3>
                    <!-- Form login -->
                    <form class="mt-5" action="<?=base_url()?>student/edit/<?=$student->student_id?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?=set_value('first_name', $student->first_name)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?=set_value('middle_name', $student->middle_name)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?=set_value('last_name', $student->last_name)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" role="button">
                                        <option value="" selected hidden></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                        <option value="<?=set_value('gender', $student->gender)?>" selected hidden><?=set_value('gender', $student->gender)?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="text" class="form-control" id="age" name="age" value="<?=set_value('age', $student->age)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $student->address)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?=set_value('contact_number', $student->contact_number)?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" id="email_address" name="email_address" value="<?=set_value('email_address', $student->email_address)?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn w-100" id="custom-button-color">Save</button>
                        <a href="<?=base_url()?>student/list" class=" btn w-100 mt-3" id="custom-button-color">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>