@include('includes.header')
<style type="text/css">
    .table > thead > tr > th, .table-bordered > tbody > tr > th, 
    .table > tfoot > tr > th, .table-bordered > thead > tr > td, 
    .table > tbody > tr > td, .table-bordered > tfoot > tr > td {
        border: 1px solid #ccc !important;
    }
    .table th{ vertical-align: middle !important; }
    .ms-choice{border: none !important; height: 0;outline: 0 !important}
    .ms-drop{left: 0;}
</style>
<link href="{!! asset('css/multiple-select.css') !!}" rel="stylesheet" type="text/css" />
<script src="{!! asset('js/jquery.multiple.select.js') !!}"></script>
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
                                        Report Management
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
                                    <li class="breadcrumb-item"><a href="#!">Case Report</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr class="col-md-12">
                    <form id="form" action="{{ route('case')}}" method="post" role="form">
                        <div class="row">
                            <div class="col-md-6">                                
                                <div class="form-group">
                                    <label for="date">From Date</label>
                                    <input type="date" class="form-control required" id="start_date" name="start_date" value="{{ $start_date }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">To Date</label>
                                    <input type="date" class="form-control required" id="end_date"  name="end_date" value="{{ $end_date }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-2">
                                    <!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Save Patient</button> -->
                                    <input type="submit" name="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Sample Report: Case Data</h5>
                            <button id="button-excel">Excel</button>
                            <!-- <span>use class <code>table</code> inside table element</span> -->
                            <div class="card-header-right">    <ul class="list-unstyled card-option">        <li><i class="icofont icofont-simple-left "></i></li>        <li><i class="icofont icofont-maximize full-card"></i></li>        <li><i class="icofont icofont-minus minimize-card"></i></li>        <li><i class="icofont icofont-refresh reload-card"></i></li>        <li><i class="icofont icofont-error close-card"></i></li>    </ul></div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table id="table-data" class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="14">Case Data Report</th>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email ID</th>
                                            <th>Mobile</th>
                                            <th>Designation</th>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                            <th>Created By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1 @endphp
                                        @if(!empty($reportRecords))
                                        @foreach($reportRecords as $record)
                                        <tr>
                                            <td>{{ $counter }}</td>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->username }}</td>
                                            <td>{{ $record->email }}</td>
                                            <td>{{ $record->mobile }}</td>
                                            <td>{{ $record->designation }}</td>
                                            <td>{{ $record->role->name }}</td>
                                            <td>{{ $record->created_at->format('d-m-Y h:i A') }}</td>
                                            <td>{{ $record->createdBy->name }}</td>
                                        </tr>
                                        @php $counter++ @endphp
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src='https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js'></script>
<script>
    let button = document.querySelector("#button-excel");
    button.addEventListener("click", e => {
      TableToExcel.convert(document.getElementById("table-data"), {
              name: "Patients Report.xlsx",
              sheet: {
                name: "Patients Report"
              }
            });
    });
</script>
@include('includes.footer')