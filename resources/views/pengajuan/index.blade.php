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
                <div class="page-inner mt--5">
                    @if (!Auth::guard('admin')->check() && !Auth::guard('lead')->check())
                    <!-- Button -->
                    @if($count == 0)
                    <br>
                    <br>
                    <div class="col-md-4">
                        <div class="col-md-10 justify-content-center" style="background-color:red;color:white;padding:10px;border-radius:15px;">
                            <h3 style="margin-left: 3%; margin-bottom:3%"> Sisa Cuti Anda Tahun Ini : <b>{{$count}}</b> </h3>
                        </div>
                    </div>
                    @else
                    <div class="d-flex">
                        <a class="btn btn-primary btn-round ml-auto mb-3" @if($count == 0) href="#" disabled  @else  href="{{ route('user.pengajuan.create') }}" @endif>
                            <i class="fa fa-plus"></i>
                            Tambah Pengajuan
                        </a>
                    </div>
                    <div class="col-md-4">
                        <div class="col-md-10 justify-content-center" style="background-color:rgb(13, 156, 13);color:white;padding:10px;border-radius:15px;">
                            <h3 style="margin-left: 3%; margin-bottom:3%"> Sisa Cuti Anda Tahun Ini : <b>{{$count}}</b> </h3>
                        </div>

                    </div>
                    @endif
                    <br>
                    @else
                    <br>
                    <br>
                    @endif
                    <!-- Table -->
                    <div class="table-responsive">
                        <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="add-row_length"></div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div id="add-row_filter"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="add-row" class="display table table-striped table-hover dataTable"
                                        cellspacing="0" width="100%" role="grid" aria-describedby="add-row_info"
                                        style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending">
                                                    <center>No</center>
                                                </th>
                                                <th width="25%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Pemohon</center>
                                                </th>
                                                <th width="25%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 15%; font-weight:900;">
                                                    <center>Tanggal</center>
                                                </th>
                                                <th width="25%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 15%; font-weight:900;">
                                                    <center>Keterangan</center>
                                                </th>
                                                <th width="25%" class="sorting" tabindex="0" aria-controls="add-row"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Status</center>
                                                </th>
                                                <th width="15%" class="sorting" tabindex="0"
                                                    aria-controls="add-row" rowspan="1" colspan="1"
                                                    aria-label="Action: activate to sort column ascending"
                                                    style="font-weight:900;">
                                                    <center>Action</center>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $num = 0; ?>
                                        @foreach($pengajuan as $user)
                                            <tr role="row" class="odd">
                                                <td>
                                                    <center>{{$num=$num+1}}</center>
                                                </td>
                                                <td class="sorting_1">
                                                    <center>{{$user->user->nama}}</center>
                                                </td>
                                                <td class="sorting_1">
                                                    <center>{{$user->tgl_cuti}}</center>
                                                </td>
                                                <td class="sorting_1">
                                                    <center>{{$user->keterangan}}</center>
                                                </td>
                                                <td class="sorting_1">
                                                    <center>{{$user->status == 1 ? "Disetujui" : ($user->status == 0 ? "Belum Disetujui" : "Ditolak"  ) }}</center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <div class="form-button-action">
                                                            @if($user->status != 0)
                                                            <a @if(Auth::guard('lead')->check())
                                                                href="{{route('lead.pengajuan.detail', $user->id) }}"
                                                                @elseif(Auth::guard('admin')->check())
                                                                href="{{route('admin.pengajuan.detail', $user->id) }}"
                                                                @else
                                                                href="{{route('user.pengajuan.detail', $user->id) }}"
                                                                @endif
                                                                data-toggle="tooltip" title="Detail"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Detail" control-id="ControlID-16">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            @if($user->status != 2)
                                                            @if(Auth::user()->id == $user->pemohon_id)
                                                            <a target="_blank" href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ route('user.pengajuan.downloadPDF',['id'=> $user->id, 'file'=>$user->lampiran_persetujuan]) }}" data-toggle="tooltip" title="QR Lampiran"
                                                                class="btn btn-link btn-simple-danger btn-lg"
                                                                data-original-title="approve via qr" control-id="ControlID-16">
                                                                <i class="fa fa-qrcode" style="color:blue;"></i>
                                                            </a>
                                                            @else
                                                            <a target="_blank" href="{{ asset('Uploads/Persetujuan/'.$user->lampiran_persetujuan.'') }}" data-toggle="tooltip" title="Lampiran Persetujuan"
                                                                class="btn btn-link btn-simple-danger btn-lg"
                                                                data-original-title="approve via qr" control-id="ControlID-16">
                                                                <i class="fa fa-file"></i>
                                                            </a>
                                                            @endif
                                                            @endif
                                                            @endif
                                                            @if(Auth::user()->id == $user->pemohon_id)
                                                            @if($user->status == 0)
                                                            <a href="{{route('user.pengajuan.edit', $user->id) }}" data-toggle="tooltip" title="Edit"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="Edit" control-id="ControlID-16">
                                                                <i class="fa fa-edit" style="color:grey;"></i>
                                                            </a>
                                                            <button type="submit" onclick="destroy({{$user->id}})" data-toggle="tooltip" title="Delete"
                                                                class="btn btn-link btn-simple-danger"
                                                                data-original-title="Delete" control-id="ControlID-17">
                                                                <i class="fa fa-trash" style="color:red;"></i>
                                                            </button>
                                                            @endif
                                                            @elseif (Auth::guard('admin')->check())
                                                            @if($user->status == 0)
                                                            <a data-toggle="modal" data-target="#approveModal" onclick="approve_modal('{{route('admin.pengajuan.approval') }}', '{{ $user->id }}')" title="Approve"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="approve" control-id="ControlID-16">
                                                                <i class="fa fa-check" style="color:green;"></i>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#disapproveModal" onclick="disapprove_modal('{{route('admin.pengajuan.disapprove', $user->id) }}')" title="Disapprove"
                                                                class="btn btn-link btn-simple-danger btn-lg"
                                                                data-original-title="disapprove" control-id="ControlID-16">
                                                                <i class="fa fa-times" style="color:red;"></i>
                                                            </a>
                                                            @endif
                                                            @elseif (Auth::guard('lead')->check() )
                                                            @if($user->status == 0)
                                                            <a data-toggle="modal" data-target="#approveModal" onclick="approve_modal('{{route('lead.pengajuan.approval') }}', '{{ $user->id }}')" title="Approve"
                                                                class="btn btn-link btn-simple-primary btn-lg"
                                                                data-original-title="approve" control-id="ControlID-16">
                                                                <i class="fa fa-check" style="color:green;"></i>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#disapproveModal" onclick="disapprove_modal('{{route('lead.pengajuan.disapprove', $user->id) }}')" title="Disapprove"
                                                                class="btn btn-link btn-simple-danger btn-lg"
                                                                data-original-title="Disapprove" control-id="ControlID-16">
                                                                <i class="fa fa-times" style="color:red;"></i>
                                                            </a>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="add-row_info"></div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="approveModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><b>Persetujuan Pengajuan</b></h4>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" id="url_approve">
                            <input type="hidden" id="id_approval">
                            <div class="form-group">
                                <label>Lampiran Persetujuan <span style="color: red;">*</span></label>
                                <input type="file" accept="application/pdf" name="upload_lampiran" class="form-control" id="upload_lampiran">
                            </div>
                            <div id="pdfContainer" class="form-control" style="display:none;"></div>

                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan_pimpinan" class="form-control" id="keterangan_pimpinan" cols="10" rows="5"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button onclick="approve()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="disapproveModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><b>Penolakan Pengajuan</b></h4>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <input type="hidden" id="url_disapprove">
                                <label>Keterangan <span style="color: red;">*</span></label>
                                <textarea name="keterangan_pimpinan_disapprove" class="form-control" id="keterangan_pimpinan_disapprove" cols="10" rows="5"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button onclick="disapprove()" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            @include('layouts.footer')
            <script src="{{ asset('js/app/table.js') }}"></script>
            <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
        </div>
    </div>
</body>

<script>
    function approve_modal(url, id) {
        $('#url_approve').val(url);
        $('#id_approval').val(id);
	}

    function disapprove_modal(url) {
        $('#url_disapprove').val(url);
	}

    function approve(){
        let url = $('#url_approve').val();
        let id = $('#id_approval').val();
        let ket = $('#keterangan_pimpinan').val();
        let fileUpload = $('#upload_lampiran').prop('files')[0];

        if(typeof fileUpload != "undefined"){
            let formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('id', id);
            formData.append('keterangan_pimpinan', ket);
            formData.append('file_upload', fileUpload);

            $.ajax({
                url: url,
                type: 'POST',
                processData: false,
            	contentType: false,
                data: formData,
                success: function(res) {
                    location.reload();
                }
            })
        }else{
            swal({
                icon: 'warning',
                title: 'Harap Lengkapi Data!',
                button: false,
                text: 'Harap melengkapi data terlebih dahulu!',
                timer: 1500
            });
        }

    }

    function disapprove(){
        let url = $('#url_disapprove').val();
        let ket = $('#keterangan_pimpinan_disapprove').val();

        if(ket != ""){
            $.ajax({
                url: url,
                data: {
                    'keterangan_pimpinan': ket
                },
                type: 'get',
                success: function(res) {
                    location.reload();
                }
            })
        }else{
            swal({
                icon: 'warning',
                title: 'Harap Lengkapi Data!',
                button: false,
                text: 'Harap melengkapi data terlebih dahulu!',
                timer: 1500
            });
        }

    }

    function destroy(id) {
        var token = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "",
            text: "Are you sure want to delete this record?",
            icon: "warning",
            buttons: ['Cancel', 'OK'],
            // dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.post("{{route('user.pengajuan.delete')}}",{ id:id,_token:token},function(data){
                    location.reload();
                })
            } else {
                return false;
            }
        });
    }

    $(document).ready(function() {
        $('#upload_lampiran').change(function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileReader = new FileReader();
                fileReader.onload = function() {
                    const typedArray = new Uint8Array(this.result);
                    renderPDF(typedArray);
                };
                fileReader.readAsArrayBuffer(file);
            }
        });

        function renderPDF(data) {
            const pdfUrl = URL.createObjectURL(new Blob([data], { type: 'application/pdf' }));
            const pdfContainer = $('#pdfContainer');
            pdfContainer.css('display', 'block');

            const iframe = $('<iframe>', {
                src: pdfUrl,
                width: '100%',
                height: '500px'
            });
            pdfContainer.empty().append(iframe);
        }
    });
</script>

@include('layouts.swal')

</html>
