<div class="row m-0 p-0">
    <div class="col-md-6 m-0 p-0">
        <p class="text-clr2 fw-bold">Filter Data Presensi</p>
        <div class="card m-0 p-3 shadow-m rounded-s">
            <form action="{{ url('riwayat-presensi') }}" method="get">
                @csrf 
                <div class="mb-3">
                    <label for="" class="text-clr2">Tanggal</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control"
                    value="{{ $tgl['tgl_mulai'] }}">
                </div>
                <div class="mb-3">
                    <label for="" class="text-clr2">Tanggal</label>
                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control"
                    value="{{ $tgl['tgl_selesai'] }}">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-clr2 px-4"><img src="{{ asset('assets/images/static/icons/filter.png') }}" class="he-14">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6 m-0 p-0 d-flex justify-content-center align-items-end">
        <img src="{{ asset('assets/images/static/elements/dashboard-that.png') }}" style="height:200px;">
    </div>
</div>
<div class="row m-0 p-0">
    <div class="card m-0 p-0 shadow-m rounded-s overflow-hidden">
        <div class="bg-clr2 m-0 p-3">
            <p class="text-light fw-bold m-0">Riwayat shift</p>
        </div>
        <div class="p-3">
            <table class="table">
                <thead class="table-secondary">
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
                            <td>{{ $x['presensi_keterangan_masuk'] }}</td>
                            <td>{{ $x['presensi_keterangan_pulang'] }}</td>
                        </tr>
                    <?php $i++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>