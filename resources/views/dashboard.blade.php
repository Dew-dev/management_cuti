<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
    @csrf
    <div class="wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">{{$title}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 v-center" >
                                            <i class="fa fa-list" style="font-size:50px;color:black;"></i>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="card-title">Total Pengajuan</div>
                                            <div class="card-body">
                                                <h2 style="text-align:right;" id="counter_all">{{$total}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 v-center" >
                                            <i class="fas fa-check-circle" style="font-size:50px;color:green;"></i>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="card-title">Total Approval</div>
                                            <div class="card-body">
                                                <h2 style="text-align:right;" id="total_approve">{{$total_approve}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 v-center" >
                                            <i class="fas fa-times-circle" style="font-size:50px;color:red;"></i>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="card-title">Total Disapproval</div>
                                            <div class="card-body">
                                                <h2 style="text-align:right;" id="total_disapprove">{{$total_disapprove}}</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
    <script>
    </script>

</body>
@include('layouts.swal')
</html>
