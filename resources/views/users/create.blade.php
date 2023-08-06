<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
<body>
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
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('admin.users.' . $url) }}" method="post" enctype="multipart/form-data" >
                                    {{ csrf_field() }}
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Name <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" id="name" class="form-control"  step="1" @if (isset($users)) value="{{ $users->nama }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">NIP <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="nip" id="nip" class="form-control"  step="1" @if (isset($users)) value="{{ $users->nip }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Email <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" id="email" class="form-control"  step="1" @if (isset($users)) value="{{ $users->email }}" @else value="{{ old('email') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Password <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" id="password" class="form-control"  step="1" autocomplete="off" @if($title != "Edit User") required @endif {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Re-Password <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="password" name="repassword" id="repassword" class="form-control"  step="1" autocomplete="off" @if($title != "Edit User") required @endif {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Phone <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" id="phone" class="form-control"  step="1" @if (isset($users)) value="{{ $users->telpon }}" @else value="{{ old('phone') }}"  @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Role <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="role" id="role"  @if (isset($users)) @endisset autocomplete="off" required {{ $disabled_ }}>
                                                    <option value="" selected disabled hidden>- Select Role -</option>
                                                    @foreach($roles as $role)
                                                        <option  @if(isset($users)) <?php if($users->role_id == $role->id){echo 'selected';}?> @endisset value="{{$role->id}}">{{$role->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Address <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="address" id="address" rows="5" cols="10"  autocomplete="off" required {{ $disabled_ }} style="width:100%">@if (isset($users)) {{ $users->alamat }} @endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            @if ($title == 'Add User')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.dashboard.index')}}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                        Save
                                                    </button>
                                                </div>
                                            @elseif ($title == 'Edit User')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.dashboard.index')}}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                        Save
                                                    </button>
                                                </div>
                                            @else
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a href="{{ route('admin.dashboard.index')}}" type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </section>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</body>
@include('layouts.swal')
</html>
