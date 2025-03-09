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
            font-size: 10px;
            
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
<body class="A4 landscape">

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
                    REKAP PRESENSI KARYAWAN<br>
                    PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
                    HOTEL GRAND MUTIARA PANGANDARAN
                </h3>
                <span style="font-style: italic; font-size: 15px;">
                    Jl. Pamugaran No. 145 Bulak Laut Pantai Barat Pangandaran
                </span>
            </td>
        </tr>
    </table>
    <table class="tabelpresensi">
        <tr>
            <th rowspan="2">Nik</th>
            <th rowspan="2">Nama Karyawan</th>
            <th colspan="31">Tanggal</th>
            <th rowspan="2">TH</th>
            <th rowspan="2">TT</th>
        </tr>
        <tr>
            <?php
            for($i=1; $i<=31; $i++){
            ?>
                <th>{{ $i }}</th>
            <?php
            }
            ?>
        </tr>
        @foreach ($rekap as $d )
        <tr>
            <td>{{ $d->nik}}</td>
            <td>{{ $d->nama_lengkap}}</td>

            <?php
            $totalhadir = 0;
            $totalterlambat = 0;
            for($i=1; $i<=31; $i++){
                $tgl = "tgl_".$i;
                if(empty($d->$tgl)){
                    $hadir = ['',''];
                    $totalhadir += 0;
                } else {
                    $hadir = explode("-", $d->$tgl);
                    $totalhadir += 1;
                    if($hadir[0] > "07:00:00"){
                        $totalterlambat +=1;
                    }
                }
            ?>
                {{-- <td>{{ $d->$tgl }}</td> --}}
                <td>
                   <span style="color:{{ $hadir[0] > "07:00:00" ? "red" : "" }}"> {{ $hadir[0] }}</span><br>
                   <span style="color:{{ $hadir[1] < "16:00:00" ? "red" : "" }}"> {{ $hadir[0] }}</span><br>
                </td>
                
            <?php
            }
            ?>
            <td>{{  $totalhadir }}</td>
            <td>{{  $totalterlambat }}</td>
        </tr>
        @endforeach
    </table>
    
    <table width="100%" style="margin-top: 100px" >
        <tr>
            <td></td>
            <td style="text-align: center">
                Pangandaran, {{ date('d-m-Y')}}
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