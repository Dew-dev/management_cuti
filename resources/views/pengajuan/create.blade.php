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
                                <h2 class="text-white pb-2 fw-bold">{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="content container-fluid">
                    <section class="content container-fluid">
                        <div class="box box-primary">
                            <div class="box-body">
                                <form id="form_add" action="{{ route('user.pengajuan.' . $url) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <br>
                                    <input type="hidden" name="id" @isset($users) value="{{$users->id}}" @endisset>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Tanggal Cuti <span
                                                    style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <input type="text" name="from" id="from" class="form-control"
                                                    step="1"
                                                    @if (isset($users)) value="{{ $users->tgl_cuti }}" @endisset autocomplete="off" required {{ $disabled_ }} style="width:100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Keterangan <span style="color: red;">*</span></label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="5" cols="10"  autocomplete="off" required {{ $disabled_ }} style="width:100%">@if (isset($users)) {{ $users->keterangan }} @endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    {{-- NEW --}}
                                    @isset($hasil)
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6" for="">Status Pengajuan</label>
                                            <div class="col-md-12">
                                                <input type="text" name="status_result" id="status_result" @if($hasil->status == 1) value="Approve" @else value="Ditolak" @endif class="form-control"
                                                  style="width:100%;" {{ $disabled_ }}>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if($hasil->status == 1)
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Lampiran Persetujuan</span></label>
                                            <div class="col-md-12">
                                                <iframe src="{{ asset('Uploads/Persetujuan/'.$hasil->lampiran_persetujuan.'') }}" style="width:100%; height:700px;" frameborder="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-6">Keterangan Pimpinan</span></label>
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="keterangan" id="keterangan" rows="5" cols="10"  autocomplete="off" required {{ $disabled_ }} style="width:100%">@if (isset($hasil)) {{ $hasil->keterangan_pimpinan }} @endisset</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @if(Auth::guard('user')->check())
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-11">
                                            <label class="col-md-12">
                                                <center>
                                                    <b>
                                                        QR untuk Download Lampiran
                                                    </b>
                                                </center>
                                            </label>
                                            <br>
                                            <br>
                                            <div class="col-md-12">
                                                <center>
                                                    <img class="" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('user.pengajuan.downloadPDF',['id'=> $hasil->id, 'file'=>$hasil->lampiran_persetujuan]) }}" alt="">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif
                                    @endisset
                                    <div class="modal-footer">
                                        <div style="float:right;">
                                            @if ($title == 'Add Pengajuan')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a @if(Auth::guard('lead')->check())
                                                        href="{{ route('lead.pengajuan.index') }}"
                                                        @elseif(Auth::guard('admin')->check())
                                                        href="{{ route('admin.pengajuan.index') }}"
                                                        @else
                                                        href="{{ route('user.pengajuan.index') }}"
                                                        @endif
                                                         type="button" class="btn btn-danger">
                                                        <i class="fa fa-arrow-left"></i>&nbsp;
                                                        Back
                                                    </a>
                                                    <button type="submit" class="btn btn-primary" style="margin-left:10px;">
                                                        <i class="fa fa-check"></i>&nbsp;
                                                        Save
                                                    </button>
                                                </div>
                                            @elseif ($title == 'Edit Pengajuan')
                                                <div class="col-md-10" style="margin-right: 20px;">
                                                    <a @if(Auth::guard('lead')->check())
                                                        href="{{ route('lead.pengajuan.index') }}"
                                                        @elseif(Auth::guard('admin')->check())
                                                        href="{{ route('admin.pengajuan.index') }}"
                                                        @else
                                                        href="{{ route('user.pengajuan.index') }}"
                                                        @endif type="button" class="btn btn-danger">
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
                                                    <a @if(Auth::guard('lead')->check())
                                                        href="{{ route('lead.pengajuan.index') }}"
                                                        @elseif(Auth::guard('admin')->check())
                                                        href="{{ route('admin.pengajuan.index') }}"
                                                        @else
                                                        href="{{ route('user.pengajuan.index') }}"
                                                        @endif type="button" class="btn btn-danger">
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
<script>
    $(document).ready(function() {

        var holidays =[];
        $.get("https://api-harilibur.vercel.app/api", function(data) {
            // console.log(data);
            var arr = [];
            for (let i = 0; i < data.length; i++) {
                // let date = new Date(data[i]['holiday_date'])
                if(data[i]['is_national_holiday'] ==true ){
                    let holidate = data[i]['holiday_date'].split("-");
                    let holiname = data[i]['holiday_name'];
                    holidays.push([holidate[0],holidate[1],holidate[2],holiname]);
                }
                // [2020,12,25,'Christmas Day']
            }

        })
        function setHolidays(date) {
            for (i = 0; i < holidays.length; i++) {
                if (date.getFullYear() == holidays[i][0] &&
                    date.getMonth() == holidays[i][1] - 1 &&
                    date.getDate() == holidays[i][2]) {
                    return [false, 'holiday', holidays[i][3]];
                }
            }
            var noWeekend = $.datepicker.noWeekends(date);
            return !noWeekend[0] ? noWeekend : [true];
        }

        $('#from').multiDatesPicker({
            dateFormat: "dd-mm-yy",
            minDate: new Date,
            beforeShowDay: setHolidays
        });
    });
</script>
