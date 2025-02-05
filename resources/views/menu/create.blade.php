@include('includes.header')

@php 
    $tree = buildTree($menuListDropdown);
@endphp

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
                                    <h4>Add Menu</h4>
                                    <!-- <span>Add, Edit, Delete</span> -->
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
                                    <li class="breadcrumb-item"><a href="#!">Add Menu</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <form id="form" method="POST" action="{{ route('menu.store') }}">
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Basic Inputs</h4>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="name"  name="name" value="{{ old('name')}}" maxlength="255" placeholder="Menu Name" required="reuired">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu Key</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="key"  name="key" value="{{ old('key')}}" maxlength="55" placeholder="Menu Key" required="reuired">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu Description</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="description"  name="description" value="{{ old('description') }}" placeholder="Menu Description" maxlength="255">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Parent Name</label>
                                                <div class="col-sm-10">
                                                    <select class='form-control required' id='parent_id' name='parent_id'>
                                                    <option value='0'>Select Parent Menu</option>
                                                        @php 
                                                            printTree($tree); 
                                                        @endphp
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu URL</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="url"  name="url" value="{{ old('url') }}" maxlength="255" placeholder="Menu URL" required="reuired">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu Icon</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="icon"  name="icon" value="{{ old('icon') }}" placeholder="Menu Icon" maxlength="255">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Active</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" id="active" name="active">
                                                        <option value="1" @if(old('active') == 1) selected @endif>Yes</option>
                                                        <option value="0" @if(old('active') == 0) selected @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Link Rights</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" id="link_rights" name="link_rights">
                                                        <option value="1">Yes</option>
                                                        <option value="0" selected>No</option>
                                                    </select>
                                                    <span>Note: Shown in Sub Menu Or defined as link rights</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"></div>
                                                <div class="col-sm-10">
                                                        <!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Save Patient</button> -->
                                                        <input type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Save">
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