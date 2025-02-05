@include('includes.header')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline">
                                        User Management
                                        <!-- <small>Add, Edit, Delete</small> -->
                                </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="icofont icofont-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">User Panel</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">View Users</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <!-- Page body start -->
        <div class="page-body">
            <div class="card">
                <div class="card-header">
                    <h5>User's Table</h5>
                    @if(array_key_exists("ADD", $actions))
                    <a class="btn btn-primary" href="{{ $actions['ADD'][0]->url }}"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                    @endif
                    <!-- <span>use class <code>table</code> inside table element</span> -->
                    <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(!empty($users))
                                @foreach($users as $record)
                                <tr>
                                    <td>{{ $record->id }}</td>
                                    <td>{{ $record->name }}</td>
                                    <td>{{ $record->username  }}</td>
                                    <td>{{ $record->role->name }}</td>
                                    <td style="text-align: center;">
                                      @if(array_key_exists("EDIT", $actions))
                                        <a href="user/{{ $record->id }}/edit"><i class="fa fa-pencil"></i>&nbsp;&nbsp;&nbsp;</a>
                                      @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <th>#</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th style="text-align: center;">Action</th>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
            {{ $users->links() }} 
        </div>
    </div>
</div>
</div>
</div>

@include('includes.footer')