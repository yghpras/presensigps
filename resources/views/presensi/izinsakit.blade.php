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
                    Data Izin / Sakit
                  </h2>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nik</th>
                            <th>Nama Karyawan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Status Approve</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinsakit as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('d-m-Y', strtotime($d->tgl_izin))  }}</td>
                                <td>{{ $d->nik }}</td>
                                <td>{{ $d->nama_lengkap }}</td>
                                <td>{{ $d->jabatan }}</td>
                                <td>{{ $d->status == "i" ? "Izin" : "Sakit" }}</td>
                                <td>{{ $d->keterangan }}</td>
                                <td>
                                    @if ($d->status_approved==1)
                                        <span class="badge bg-success ">Disetujui</span>
                                    @elseif($d->status_approved==2)
                                        <span class="badge bg-danger"> Ditolak</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($d->status_approved==0)
                                    <a href="#" class="btn btn-sm btn-primary" id="approve" id_izinsakit="{{ $d->id }}">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                        <path d="M11 13l9 -9" />
                                        <path d="M15 4h5v5" />
                                        </svg>
                                    </a>    
                                    @else
                                    <a href="/presensi/{{ $d->id }}/batalkanizinsakit" class="btn btn-sm bg-danger text-white">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  
                                        stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-square-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                        <path d="M9 9l6 6m0 -6l-6 6" /> 
                                        </svg>
                                        Batalkan
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal_izinsakit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Izin / Sakit</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/presensi/approveizinsakit" method="POST">
            @csrf
            <input type="hidden" name="id_izinsakit_form" id="id_izinsakit_form">
            <div class="row">
                <div class="col-12">
                    <div class="from-group">
                        <select name="status_approved" id="status_approved" class="form-select">
                            <option value="1">Disetujui</option>
                            <option value="2">Ditolak</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  
                        stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  
                        class="icon icon-tabler icons-tabler-outline icon-tabler-send">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                        </svg>
                    Submit
                    </button>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div> 
@endsection

@push('myscript')
<script>
    $(function() {
        $("#approve").click(function(e){
            e.preventDefault();
            var id_izinsakit = $(this).attr("id_izinsakit");
            $("#id_izinsakit_form").val(id_izinsakit);
            $("#modal_izinsakit").modal("show");
        });
    });
</script>
@endpush