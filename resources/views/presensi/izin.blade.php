@extends('layouts.presensi')
@section('header')
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">data izin / sakit</div>
    <div class="right"></div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col" style="margin-top:70px">
        @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
        @endphp
        @if(session::get('success'))
        <div class="alert alert-success">
            {{ $messagesuccess }}
        </div>
        @endif
        @if(session::get('error'))
        <div class="alert alert-danger">
            {{ $messageerror }}
        </div>
        @endif
    </div>
</div>
<div class="row">
   <div class="col">
    @foreach ( $dataizin as $d )
    <ul class="listview image-listview">
        <li>
            <div class="item">
                    <div class="in">
                    <div>
                        <b>{{ date("d-m-Y",strtotime($d->tgl_izin))  }} ({{ $d->status== "s" ? "Sakit" : "Izin" }})</b>
                        <br>
                        <small class="text-muted"> {{ $d->keterangan }}</small>
                    </div>
                    @if ($d->status_approved == 0)
                    <span class="badge badge-warning">Menunggu Persetujuan</span>
                    @elseif($d->status_approved == 1)
                    <span class="badge badge-success">Disetujui</span>
                    @elseif($d->status_approved == 2)
                    <span class="badge badge-danger">Ditolak</span>
                    @endif
                </div>
            </div>
        </li>
    </ul>
    @endforeach
   </div>
</div>
<div class="fab-button bottom-right" style="margin-bottom: 70px">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>
@endsection