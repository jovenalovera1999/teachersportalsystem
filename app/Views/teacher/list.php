<!-- Master Page -->
<?= $this->extend('layout/main') ?>

<!-- Content -->
<?= $this->section('content') ?>

<title>Teacher's Portal | List of Teachers</title>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <!-- Sidebar icon none -->
                </button>
            </div>
            <div class="p-4">
                <h1><a href="#" class="logo">Dean's Portal<span class="text-white mt-4" style="font-size: 17px;">User Logged In:<br>Dev Jov</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="<?=base_url()?>teacher/list">Teachers</a>
                    </li>
                    <li>
                        <a href="#">Students</a>
                    </li>
                    <li>
                        <a href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="container-fluid">
                <a href="<?=base_url()?>teacher/register" class="btn mt-5 mb-3" id="custom-button-color">Register a Teacher</a>
                <table class="table table-hover mt-3 responsive" id="myTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Contact Number</th>
                            <th>Email Address</th>
                            <th>Position</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($users as $user): ?>
                            <tr>
                                <td><?=$user->first_name?></td>
                                <td><?=$user->middle_name?></td>
                                <td><?=$user->last_name?></td>
                                <td><?=$user->gender?></td>
                                <td><?=$user->address?></td>
                                <td><?=$user->contact_number?></td>
                                <td><?=$user->email_address?></td>
                                <td><?=$user->position?></td>
                                <td><?=$user->created_at?></td>
                                <td><?=$user->updated_at?></td>
                                <td>
                                    <div class="btn-group" role="button">
                                        <a href="#" class="btn btn-primary">View</a>
                                        <a href="#" class="btn btn-warning">Edit</a>
                                        <a href="#" class="btn btn-danger">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>