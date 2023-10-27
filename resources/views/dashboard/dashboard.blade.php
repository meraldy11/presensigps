@extends('layouts.presensi')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<style>
    .menu-icon {
    margin-top: 10px;
    display: inline-block;
    vertical-align: middle;
    color: #120C37;
    margin-right: 10px; /* Jarak antara ikon dan teks jam */
}

.menu-details {
    display: inline-block;
    vertical-align: middle;
}

</style>

<script>
    function updateTime() {
        const now = new Date();
        const clockElement = document.getElementById("clock");
        const dateElement = document.getElementById("date");

        const hours = String(now.getHours()).padStart(2, "0");
        const minutes = String(now.getMinutes()).padStart(2, "0");
        const seconds = String(now.getSeconds()).padStart(2, "0");
        const day = now.getDate();
        const month = now.getMonth() + 1; // Months are 0-based
        const year = now.getFullYear();

        const timeString = hours + ":" + minutes + ":" + seconds;
        const dateString = day + " " + getMonthName(month) + " " + year;

        clockElement.textContent = timeString;
        dateElement.textContent = dateString;
    }

    function getMonthName(month) {
        const monthNames = [
            "Januari", "Februari", "Maret", "April",
            "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "November", "Desember"
        ];
        return monthNames[month - 1];
    }

    setInterval(updateTime, 1000); // Update time every second
    updateTime(); // Initial update
    </script>
<style>
    .logout{
        position: absolute;
        color: red;
        font-size: 35px;
        text-decoration: none;
        right: 6%;
        top: 7%
    }
    .logout:hover{
        color: red;
    }
</style>

<div class="section" id="user-section" style="background-color:#120C37">
    <a href="/proseslogout" class="logout"><ion-icon name="exit-outline"></ion-icon></a>
    <div id="user-detail">
        <div class="avatar">
            @if (!empty (Auth::guard('karyawan')->user()->foto))
            @php
                $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
            @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height: 60px">
                @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif

        </div>
        <div id="user-info">
            <h2 id="user-name">{{Auth::guard('karyawan')->user()->nama_lengkap}}</h2>
            <span id="user-role">{{Auth::guard('karyawan')->user()->jabatan}}</span>
        </div>
    </div>
</div>

<div class="section" id="menu-section">
    <div class="card" style="height: 100px">
        <div class="list-menu">
            <div class="item-menu text-center">
                <div class="menu-icon">
                    <i class="fas fa-clock fa-4x"></i>
                </div>
                <div class="menu-details">
                    <h2 id="clock" class="clock mt-2"></h2>
                    <span id="date" class="date" style="font-weight: bold"></span>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="section " id="presence-section">
    <div class="todaypresence">
        <div class="row">
            <div class="col-6">
                <div class="card gradasigreen">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                               @if ($presensihariini != null)
                                   @php
                                       $path = Storage::url('uploads/absensi/'.$presensihariini->foto_in);
                                   @endphp
                                   <img src="{{ url($path) }}" alt="" class="imaged w48">
                                   @else
                                   <ion-icon name="camera"></ion-icon>
                               @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Masuk</h4>
                                <span>{{$presensihariini != null ? $presensihariini->jam_in : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card gradasired">
                    <div class="card-body">
                        <div class="presencecontent">
                            <div class="iconpresence">
                                @if ($presensihariini != null && $presensihariini->jam_out != null)
                                @php
                                    $path = Storage::url('uploads/absensi/'.$presensihariini->foto_out);
                                @endphp
                                <img src="{{ url($path) }}" alt="" class="imaged w48">
                                @else
                                <ion-icon name="camera"></ion-icon>
                            @endif
                            </div>
                            <div class="presencedetail">
                                <h4 class="presencetitle">Pulang</h4>
                                <span>{{$presensihariini != null && $presensihariini->jam_out != null ? $presensihariini->jam_out : 'Belum Absen'}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="rekappresensi">
        <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important ; line-height:0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{$rekappresensi->jmlhadir}}</span>
                        <ion-icon name="accessibility-outline" style="font-size: 1.6rem;" class="text-primary mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{ $rekapizin->jmlizin }}</span>
                        <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Ijin</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{ $rekapizin->jmlsakit }}</span>
                        <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                        <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{$rekappresensi->jmlterlambat}}</span>
                        <ion-icon name="alarm-outline" style="font-size: 1.6rem;" class="text-danger mb-1"></ion-icon>
                        <br>
                        <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="presencetab mt-2">
        <div class="tab-pane fade show active" id="pilled" role="tabpanel">
            <ul class="nav nav-tabs style1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                        Bulan Ini
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                        Leaderboard
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content mt-2" style="margin-bottom:100px;">
            <div class="tab-pane fade show active" id="home" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($historybulanini as $d)
                    @php
                        $path = Storage::url('uploads/absensi/'.$d->foto_in);
                    @endphp
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="finger-print-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</div>
                                <span class="badge badge-success">{{ $d->jam_in }}</span>
                                <span class="badge badge-danger">{{ $presensihariini != null &&  $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}</span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <ul class="listview image-listview">
                    @foreach ($leaderboard as $d)
                    <li>
                        <div class="item">
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                            <div class="in">
                                <div>
                                    <b>{{ $d->nama_lengkap }}<br></b>
                                    <small class="text-muted">{{ $d->jabatan }}</small>
                                </div>
                                <span class="badge {{ $d->jam_in < "08:00" ? "bg-success" : "bg-danger"}}">
                                    {{$d->jam_in}}
                                </span>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>

@endsection
