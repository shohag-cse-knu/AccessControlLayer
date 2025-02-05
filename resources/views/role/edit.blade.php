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
                                    <h4>Role Management</h4>
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
                                    <li class="breadcrumb-item"><a href="#!">Role List</a>
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
                            <form method="POST" action="{{ route('role.update', $roleInfo->id)}}">
                                @method('PUT') <!-- Specifies the HTTP method as PUT -->
                                <div class="card">
                                    <div class="card-block">
                                        <h4 class="sub-title">Basic Inputs</h4>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Role Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="name"  name="name" value="{{ old('name', $roleInfo->name)  }}" placeholder="Role Name" maxlength="255" required=""> 
                                                    <input type="hidden" class="form-control required" id="role_id" value="{{ $roleInfo->id  }}"  name="role_id" maxlength="255">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Role Description</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control required" id="description"  name="description" value="{{ old('description', $roleInfo->description)}}"placeholder="Role Description" maxlength="255" required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Active</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control required" id="role" name="active" required>
                                                        <option value="1" @if(old('active', $roleInfo->active) == 1) checked="checked" @endif>Yes</option>
                                                        <option value="0" @if(old('active', $roleInfo->active) == 0) checked="checked" @endif>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Menu List</label>
                                                <div class="col-sm-10">
                                                	<hr>
                                                    <label><input type="checkbox" id="checkAll"> All</label>
                                                    @php
													createTreeView(menu_tree(), 0);
													@endphp
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
<script>
$(function () {
     $("#checkAll").click(function () {
		 $('input:checkbox').not(this).prop('checked', this.checked);
	 });

     // Array of values to check
    var valuesToCheck = @php echo json_encode($roleMenuInfo); @endphp;

    // Check checkboxes with matching values
    $('input[name="chk[]"]').each(function() {
        if (valuesToCheck.includes(parseInt($(this).val()))) {
            $(this).prop('checked', true);
        }
    });
});
</script>
@include('includes.footer')