<div class="row m-0 p-0">
    <div class="col-md-12 m-0 p-3">
        <p class="fsz-12 text-secondary m-0">ID Sesi</p>
        <p class="">{{ $sesi['sesi_id'] }}</p>
        <hr>
        <div class="row m-0 p-0">
            <div class="m-0 p-0">
                <p class="m-0 fsz-12 text-secondary">Masuk</p>
                <p class="m-0">{{ $sesi['sesi_masuk_tgl'] }}</p>
                <p class="m-0">{{ $sesi['sesi_masuk_jam'] }} - {{ $sesi['sesi_pulang_jam'] }} WIB</p>
            </div>
            <div class="overflow-scroll w-100 mt-5">
                <table class="table">
                    <thead class="table-secondary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach($sesiusers as $x)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $x['user_nama'] }}</td>
                                <td>{{ $x['status'] }}</td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#modalKeterangan-{{ $x['presensi_id'] }}" class="btn btn-sm btn-info fsz-10">Keterangan <i class="fas fa-info-circle"></i></a></td>
                            </tr>
                        <?php $i++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($sesiusers as $x)
<!-- Modal -->
<div class="modal fade" id="modalKeterangan-{{ $x['presensi_id'] }}" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-lg">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-info text-light">
                <h1 class="modal-title fs-5"><i class="fas fa-info-circle me-2"></i>Keterangan</h1>
                <button type="button" class="ms-auto hover bg-info border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="row m-0 p-0">
                    <div class="col-4">Nama</div>
                    <div class="col-1">:</div>
                    <div class="col-6">{{ $x['user_nama'] }}</div>
                    <!--  -->
                    <div class="col-4">Status</div>
                    <div class="col-1">:</div>
                    <div class="col-6">{{ $x['status'] }}</div>
                    <!--  -->
                    <div class="col-4">Keterangan</div>
                    <div class="col-1">:</div>
                    <div class="col-6">{{ $x['presensi_keterangan'] }}</div>
                </div>
                <form action="{{ url('root/presensi/ubah') }}" method="post">
                    @csrf 
                    <input type="hidden" name="presensi_id" value="{{ $x['presensi_id'] }}">
                    <div class="mt-3 row">
                        <div class="col-7">
                            <select name="presensi_status" class="form-select" aria-label="Default select example">
                                <option {{ $x['status'] === 'Alpha' ? 'selected' : '' }} value="4">Alpha</option>
                                <option {{ $x['status'] === 'Hadir' ? 'selected' : '' }} value="1">Hadir</option>
                                <option {{ $x['status'] === 'Izin' ? 'selected' : '' }} value="3">Izin</option>
                                <option {{ $x['status'] === 'Cuti' ? 'selected' : '' }} value="5">Cuti</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
@endforeach