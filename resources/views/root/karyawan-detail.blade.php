<div class="row m-0 p-0">
    <div class="col-md-6 m-0 p-0 pe-0 pe-md-2">
        <div class="card m-0 p-3 shadow-m rounded-s mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex flex-shrink-0 justify-content-center align-items-center position-relative square" style="width:100px">
                    @if($pp !== null)
                        <img src="{{ $pp ? asset($pp) : asset('uploads/default.svg') }}" class="img-cover rounded-circle" alt="Profil">
                    @else 
                        <img src="{{ asset('assets/images/static/icons/blank-profile.png') }}" class="img-cover rounded-circle">
                    @endif
                </div>                <div class="">
                    <h4 class="text-clr2 fw-bold">{{ $karyawan['user_nama'] }}</h4>
                    <p class="fsz-10 text-secondary">{{ $karyawan['user_id'] }}</p>
                </div>
            </div>
            <hr>
            <div class="">
                <p class="m-0 fsz-12">Email :</p>
                <p class="m-0 mb-3">{{ $karyawan['user_email'] }}</p>
                <p class="m-0 fsz-12">Tanggal bergabung :</p>
                <p class="m-0 mb-3">{{ $karyawan['created_at_tgl'] }}</p>
                <p class="m-0 fsz-12">Alamat lengkap :</p>
                <p class="m-0 mb-3">{{ $profil['profil_alamat'] }}</p>
                <p class="m-0 fsz-12">Nomor telepon :</p>
                <p class="m-0 mb-3">{{ $profil['profil_telp'] }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 m-0 p-0 d-flex align-items-end">
        <div class="card m-0 p-3 shadow-m rounded-s mb-4">
        <form action="{{ url('root/karyawan/' . $karyawan['user_id']) }}" method="get">
                @csrf 
                <div class="mb-3">
                    <label for="" class="text-clr2">Dari</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control"
                    value="{{ $tgl['tgl_mulai'] }}">
                </div>
                <div class="mb-3">
                    <label for="" class="text-clr2">Sampai</label>
                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control"
                    value="{{ $tgl['tgl_selesai'] }}">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-clr2 px-4"><img src="{{ asset('assets/images/static/icons/filter.png') }}" class="he-14">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row m-0 p-0">
    <div class="card m-0 p-0 shadow-m rounded-s overflow-hidden">
        <div class="bg-clr2 m-0 p-3">
            <p class="text-light fw-bold m-0">Riwayat shift</p>
        </div>
        <div class="p-3 w-100 overflow-scroll scrollbar-hidden">
            <table class="table">
                <thead class="table-secondary">
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pukul</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach($presensi as $x)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $x['presensi_tanggal'] }}</td>
                            <td>{{ $x['presensi_pukul'] }}</td>
                            <td>{{ $x['presensi_status'] }}</td>
                            <td>{{ $x['presensi_keterangan'] }}</td>
                        </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>