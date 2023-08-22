<!-- Master Page -->
<?=$this->extend('layout/main')?>

<!-- Content -->
<?=$this->section('content')?>

<title>Teacher's Portal | Student's Information</title>

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
                                <strong class="me-auto">Failed to register!</strong>
                                <?=$validation->listErrors();?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="card-body w-75 mx-auto">
                    <h3 class="card-title">Are you sure you want to delete this student?</h3>
                    <!-- Form login -->
                    <form class="mt-5" action="<?=base_url()?>student/delete/<?=$student->student_id?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control bg-white" id="first_name" name="first_name" value="<?=$student->first_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control bg-white" id="middle_name" name="middle_name" value="<?=$student->middle_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control bg-white" id="last_name" name="last_name" value="<?=$student->last_name?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Gender</label>
                                    <input type="text" class="form-control bg-white" id="last_name" name="last_name" value="<?=$student->gender?>" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="text" class="form-control bg-white" id="age" name="age" value="<?=$student->age?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control bg-white" id="address" name="address" value="<?=$student->address?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="contact_number" class="form-label">Contact Number</label>
                                    <input type="text" class="form-control bg-white" id="contact_number" name="contact_number" value="<?=$student->contact_number?>" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="email_address" class="form-label">Email Address</label>
                                    <input type="text" class="form-control bg-white" id="email_address" name="email_address" value="<?=$student->email_address?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="teacher" class="form-label">Teacher</label>
                                <?php if(empty($student->user_middle_name)): ?>
                                    <input type="text" class="form-control bg-white" id="teacher" name="teacher" value="<?=$student->user_first_name . ' ' . $student->user_last_name?>" disabled>
                                <?php else: ?>
                                    <input type="text" class="form-control bg-white" id="teacher" name="teacher" value="<?=$student->user_first_name . ' ' . $student->user_middle_name[0] . '. ' . $student->user_last_name?>" disabled>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Delete</button>
                        <a href="<?=base_url()?>student/list" class=" btn w-100 mt-3" id="custom-button-color">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?=$this->endSection('content')?>