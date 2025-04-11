<div class="row m-0 p-0">
    <div class="col-md-6 m-0 p-0">
        <p class="text-clr2 fw-bold">Filter Data Presensi</p>
        <div class="card m-0 p-3 shadow-m rounded-s">
            <form action="{{ url('riwayat-presensi') }}" method="post">
                @csrf 
                <div class="mb-3">
                    <label for="" class="text-clr2">Tanggal</label>
                    <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-clr2 px-4">
                        <img src="{{ asset('assets/images/static/icons/filter.png') }}" class="he-14">Filter</button>
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
                    <tr>
                        <td>Senin, 28 AGustus 2020</td>
                        <td>12:00 WIB</td>
                        <td>Hadir</td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>