@if ($histori->isEmpty())
<div class="alert alert-outline-warning">
    <p>Data belum ada</p>
</div>
@endif
@foreach ( $histori as $d )
<ul class="listview image-listview">
    <li>
        <div class="item">
            @php
             $path = Storage::url('uplods/absensi'.$d->foto_in);
            @endphp
                <img src="{{ asset('storage/uploads/absensi/'.$d->foto_in) }}" alt="image" class="image">
                <div class="in">
                <div>
                    <b>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</b>
                    <br>
                    {{-- <small class="text-muted">{{ $d->jabatan }}</small> --}}
                </div>
                <span class="badge {{ $d->jam_in < "07:00:00" ? 'badge-success' : 'badge-danger' }}">
                    {{ $d->jam_in }}
                </span>
                <span class="badge bg-primary">{{ $d->jam_out }}</span>
            </div>
        </div>
    </li>
</ul>
@endforeach