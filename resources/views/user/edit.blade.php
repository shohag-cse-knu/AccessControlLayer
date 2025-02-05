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
                                    <h4>Add User</h4>
                                    <!-- <span>Lorem ipsum dolor sit <code>amet</code>, consectetur adipisicing elit</span> -->
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
                                    <li class="breadcrumb-item"><a href="#!">Add User</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <form id="form" method="POST" action="{{ route('user.update', $userInfo->id)}}">
                                @method('PUT') <!-- Specifies the HTTP method as PUT -->
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Basic Inputs</h4>
                                        @if ($errors->any())
                                            <div>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Full Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="name" name="name" value="{{ old('name', $userInfo->name) }}" maxlength="128" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">User Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="username"  name="username" value="{{ old('username', $userInfo->username) }}" maxlength="20" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Designation</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="designation" name="designation" value="{{ old('designation', $userInfo->designation) }}" maxlength="30" required="">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required email" id="email"  name="email" value="{{ old('email', $userInfo->email) }}" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Mobile Number</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required digits" id="mobile" name="mobile" value="{{ old('mobile', $userInfo->mobile) }}" maxlength="20" required="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Role</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" id="role_id" name="role_id" required="">
                                                        <option value="0">Select Role</option>
                                                        @if(!empty($roles))
                                                            @foreach ($roles as $object)
                                                                <option value="{{ $object->id }}" @if($object->id == old('role_id', $userInfo->role_id)) selected @endif>{{ $object->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control required" id="password"  name="password" maxlength="32">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Confirm Password</label>
                                                <div class="col-sm-10">
                                                    <input type="password" class="form-control required equalTo" id="password_confirmation" name="password_confirmation" maxlength="32">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-10">
                                                        <!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Save Patient</button> -->
                                                        <input type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Update">
                                                </div>
                                            </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.footer')