@extends('layouts.admin.tabler')
@section('content')
<br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="page-header d-print-none ">
    <div class="container-xl">
        <div class="row">
            <div class="row align-items-center">
                <div class="col">
                  <h2 class="page-title">
                    Data Departemen
                  </h2>
                </div>
              </div>
        </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="vol-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}}
                                    </div>
                                @endif
                                @if (Session::get('warning'))
                                    <div class="alert alert-warning">
                                        {{Session::get('warning')}} 
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" id="btnTambahDepartemen">  
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                                    stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" /></svg>Tambah Data
                                </button>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/departemen" method="GET">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <input type="text" name="nama_dept" id="nama_dept" class="form-control" placeholder="Departemen" value="{{ Request('nama_dept') }}">
                                            </div>
                                        </div> 
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                                    stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                    <path d="M21 21l-6 -6" />
                                                    </svg> Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Dept</th>
                                            <th>Nama Dept</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $departemen as $d )
                                        <tr>
                                            <td> {{ $loop->iteration }} </td>
                                            <td> {{ $d->kode_dept }} </td>
                                            <td> {{ $d->nama_dept }} </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="#" class="edit btn btn-info btn-sm" kode_dept="{{ $d->kode_dept }}">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                                                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                        </svg>
                                                    </a>
                                                    <form action="/departemen/{{ $d->kode_dept }}/delete" method="POST" style="margin-left: 5px">
                                                    @csrf
                                                    <a class="btn btn-danger btn-sm delete-confirm">
                                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  
                                                        class="icon icon-tabler icons-tabler-filled icon-tabler-trash">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" />
                                                        <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" />
                                                        </svg>
                                                    </a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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
</div>
<div class="modal modal-blur fade" id="modal_inputdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Departemen</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/departemen/store" method="post" id="frmDepartemen">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor" 
                            stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                            class="icon icon-tabler icons-tabler-outline icon-tabler-barcode">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                            <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                            <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                            <path d="M5 11h1v2h-1z" />
                            <path d="M10 11l0 2" />
                            <path d="M14 11h1v2h-1z" />
                            <path d="M19 11l0 2" />
                        </svg>
                        </span>
                    <input type="text" value="" id="kode_dept" class="form-control" name="kode_dept" placeholder="Kode Dept">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler.io/icons/icon/user -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none" 
                            stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                            class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                    <input type="text" value="" id="nama_dept" class="form-control" name="nama_dept" placeholder="Nama Departemen">
                </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="from-group">
                        <button class="btn btn-primary w-100">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                            stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                            class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 14l11 -11" />
                            <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                            </svg>Simpan
                        </button>
                    </div>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>  
{{-- modal edit --}}
<div class="modal modal-blur fade" id="modal_editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data Departemen</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">
          
        </div>
      </div>
    </div>
</div> 
@endsection

@push('myscript')

<script>

$(function() {
    $("#btnTambahDepartemen").click(function(){
        $("#modal_inputdepartemen").modal("show");
    });

    $(".edit").click(function(){
        var kode_dept = $(this).attr('kode_dept');
        $.ajax({
            type:"POST",
            url: '/departemen/edit',
            cache: false,
            data: {
                _token:"{{ csrf_token() }}",
                kode_dept: kode_dept
            },
            success:function(respond){
                $("#loadeditform").html(respond);
            }
        });
        $("#modal_editdepartemen").modal("show");
    });

    $(".delete-confirm").click(function(e){
        var form = $(this).closest('form');
        e.preventDefault();
        Swal.fire({
            title: "Apakah Anda Yakin Data ini Mau Di Hapus?",
            text: "Jika Ya Maka Data Akan Terhapus Permanen",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "YA, Hapus AJa!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire({
                    title: "Deleted!",
                    text: "Data Berhasil Di Hapus.",
                    icon: "success"
                });
            }
        });
    });


    $("#frmkaryawan").submit(function(){
            var nik = $('#nik').val();
            var nama_lengkap = $('#nama_lengkap').val();
            var jabatan = $('#jabatan').val();
            var no_hp = $('#no_hp').val();
            var kode_dept = $("frmKaryawan").find('#kode_dept').val();
            if(nik == ""){
                // alert('Nik Harus Diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nik Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((results)=>{
                    $("nik").focus();
                })
                
                return false;
            } else if (nama_lengkap == ""){
                // alert('Nik Harus Diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((results)=>{
                    $("nama_lengkap").focus();
                })
                
                return false;
            } else if (no_hp == ""){
                // alert('Nik Harus Diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'No. Hp Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((results)=>{
                    $("no_hp").focus();
                })
                
                return false;
            } else if (jabatan == ""){
                // alert('Nik Harus Diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((results)=>{
                    $("jabtan").focus();
                })
                
                return false;
            } else if (kode_dept == ""){
                // alert('Nik Harus Diisi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'Departemen Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then((results)=>{
                    $("kode_dept").focus();
                })
                
                return false;
            }
        });
});

    


        
    
</script>
@endpush