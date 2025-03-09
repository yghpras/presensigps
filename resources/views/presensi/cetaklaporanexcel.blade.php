<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
        @page { 
            size: A4 ;
        }

        h3{
            font-family: Arial, Helvetica, sans-serif;
        }

        .tabeldatakaryawan{
            margin-top:40px;
        }

        .tabeldatakaryawan tr td {
            padding: 5px;
        }

        .tabelpresensi{
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th{
            border: 1px solid hsl(0, 0%, 0%);
            padding: 8px;
            background: hsl(0, 0%, 91%);
            
        }
        .tabelpresensi tr td{
            border: 1px solid hsl(0, 0%, 0%);
            padding: 5px;
            font-size: 12px
            
        }

        .foto{
            width: 40px ;
            height: 30px;
        }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%;">
        <tr>
            <td style="width: 80px; vertical-align: top;">
                <img src="{{ asset('assets/img/logopresensi.png') }}" width="90" height="90" alt="">
            </td>
            <td style="vertical-align: top; padding-left: 15px;">
                <h3 style="margin-bottom: 5px;">
                    LAPORAN PRESENSI KARYWAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                    HOTEL GRAND MUTIARA PANGANDARAN
                </h3>
                <span style="font-style: italic; font-size: 15px;">
                    Jl. Pamugaran No. 145 Bulak Laut Pantai Barat Pangandaran
                </span>
            </td>
        </tr>
    </table>
    <table class="tabeldatakaryawan">
        <tr>
            <td rowspan="6">
                @php
                $path = Storage::url('uploads/karyawan'.$karyawan->foto)
                @endphp
            
                <img src="{{ asset('uploads/karyawan/' . $karyawan->foto) }}" width="120" height="150">
            </td>
        </tr>
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $karyawan->nik }}</td>
        </tr>
        <tr>
            <td>Nama karyawan</td>
            <td>:</td>
            <td>{{ $karyawan->nama_lengkap }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $karyawan->jabatan }}</td>
        </tr>
        <tr>
            <td>Departemen</td>
            <td>:</td>
            <td>{{ $karyawan->nama_dept }}</td>
        </tr>
        <tr>
            <td>No. Hp</td>
            <td>:</td>
            <td>{{ $karyawan->no_hp }}</td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
            <th>Keterangan</th>
        </tr>
        @foreach ( $presensi as $d )
        
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</td>
            <td>{{ $d->jam_in  }}</td>
            
            <td>{{ $d->jam_out != null ? $d->jam_out : 'Belum Absen'}}</td>
            
            </td>
            <td>
                @if ( $d->jam_in > '07:00:00' )
                Absen Terlambat
                @else
                Absen Tepat Waktu
                @endif
            </td>
        </tr>
        
        @endforeach
    </table>
    <table width="100%" style="margin-top: 100px" >
        <tr>
            <td colspan="2" style="text-align: right">Pangandaran, {{ date('d-m-Y')}}

            </td>
        </tr>
        <tr>
            <td style="text-align: center; vertical-align: bottom; height: 100px;">
                <u>Yoghi</u><br>
                <i><b>HRD Manager</b></i>
            </td>
            <td style="text-align: center; vertical-align: bottom; ">
                <u>Yoghi P</u><br>
                <i><b>Direktur</b></i>
            </td>
        </tr>
    </table>

  </section>

</body>

</html>