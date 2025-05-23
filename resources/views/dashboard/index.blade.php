<div class="row m-0 p-0">
    <div class="mb-3 col-md-6 col-lg-5 col-xxl-3 m-0 p-0 pe-0 pe-md-2">
        <div class="card border-none shadow-l-2 rounded-s overflow-hidden m-0 p-0">
            <div class="bg-clr2 text-light d-flex align-items-end">
                <h5 class="m-0 my-4 ms-4">Presensi Kehadiran</h5>
                <img src="{{ asset('assets/images/static/elements/dashboard-yeay.png') }}" class="he-60 ms-auto me-4">
            </div>
            <div class="bg-light row m-0">
                <div class="col-6 m-0 p-0">
                    @if($issetPresensi == true)
                        <div class="card hover cursor-pointer rounded-xs m-0 ms-3 me-1 my-3 p-0 {{ ($masuk == null) ? 'bg-clr4' : 'bg-secondary' }}" data-bs-toggle="modal" data-bs-target="{{ ($masuk == null) ? '#modalMasuk' : '#modalWarningMasuk' }}">
                            <div class="row text-light m-0 p-0">
                                <div class="col-3 m-0 p-0 py-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/static/icons/dashboard-masuk.png') }}" class="w-75">
                                </div>
                                <div class="col-9 m-0 p-0 py-2 d-flex flex-column justify-content-center align-items-center">
                                    <p class="text-center m-0">MASUK</p>
                                    @if($masuk !== null)
                                        <p class="text-center m-0 fw-bold">{{ $masuk }}</p>
                                    @else
                                        <p class="text-center m-0 fw-bold clock-now"></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="card hover cursor-pointer rounded-xs m-0 ms-3 me-1 my-3 p-0 bg-secondary" data-bs-toggle="modal" data-bs-target="#modalWarningMasuk">
                            <div class="row text-light m-0 p-0">
                                <div class="col-3 m-0 p-0 py-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/static/icons/dashboard-masuk.png') }}" class="w-75">
                                </div>
                                <div class="col-9 m-0 p-0 py-2 d-flex flex-column justify-content-center align-items-center">
                                    <p class="text-center m-0">MASUK</p>
                                    <p class="text-center m-0 fw-bold">***</p>
                                </div>
                            </div>
                        </div>
                    @endif 
                </div>
                <div class="col-6 m-0 p-0">
                    @if($issetPresensi == true)
                        <div class="card hover cursor-pointer rounded-xs m-0 me-3 ms-1 my-3 p-0 {{ ($pulang == null) ? 'bg-clr5' : 'bg-secondary' }}" data-bs-toggle="modal" data-bs-target="{{ $pulang == false && $pulang_active == true ? '#modalPulang' : '#modalWarningPulang' }}">
                            <div class="row text-light m-0 p-0">
                                <div class="col-3 m-0 p-0 py-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/static/icons/dashboard-masuk.png') }}" class="w-75">
                                </div>
                                <div class="col-9 m-0 p-0 py-2 d-flex flex-column justify-content-center align-items-center">
                                    <p class="text-center m-0">PULANG</p>
                                    @if($pulang == false)
                                        <p class="text-center m-0 fw-bold clock-now"></p>
                                    @elseif($pulang !== null)
                                        <p class="text-center m-0 fw-bold">{{ $pulang }}</p>
                                    @else 
                                        <p class="text-center m-0 fw-bold clock-now"></p>
                                    @endif                            
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="card hover cursor-pointer rounded-xs m-0 me-3 ms-1 my-3 p-0 bg-secondary" data-bs-toggle="modal" data-bs-target="#modalWarningPulang">
                            <div class="row text-light m-0 p-0">
                                <div class="col-3 m-0 p-0 py-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ url('assets/images/static/icons/dashboard-masuk.png') }}" class="w-75">
                                </div>
                                <div class="col-9 m-0 p-0 py-2 d-flex flex-column justify-content-center align-items-center">
                                    <p class="text-center m-0">PULANG</p>
                                    <p class="text-center m-0 fw-bold">***</p>
                                </div>
                            </div>
                        </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="mb-1 col-6 col-md-3 col-lg-2 col-xxl-1 m-0 p-0 pe-0 pe-md-1">
        <div class="card border-none shadow-l-2 rounded-s overflow-hidden m-0 p-0">
            <div class="bg-clr2 py-2 text-light">
                <p class="text-center m-0">Total Shift</p>
            </div>
            <div class="bg-light d-flex justify-content-center py-5 px-3">
                <div class="d-flex align-items-end">
                    <h3 class="text-clr2 m-0 fw-bold">{{ $accumulative['total_shift'] }}</h3>
                    <p class="m-0 mb-1 fsz-10 ms-1 text-clr3">Kali</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-2 col-6 col-md-3 col-lg-2 col-xxl-1 m-0 p-0 ps-1">
        <div class="card border-none shadow-l-2 rounded-s overflow-hidden m-0 p-0">
            <div class="bg-clr2 py-2 text-light">
                <p class="text-center m-0">Total Izin</p>
            </div>
            <div class="bg-light d-flex justify-content-center py-5 px-3">
                <div class="d-flex align-items-end">
                    <h3 class="text-clr2 m-0 fw-bold">{{ $accumulative['total_izin'] }}</h3>
                    <p class="m-0 mb-1 fsz-10 ms-1 text-clr3">Kali</p>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-2 col-12 col-md-4 col-lg-3 col-xxl-2 m-0 p-0 ps-0 ps-md-2">
        <div class="card border-none shadow-l-2 rounded-s overflow-hidden m-0 p-0">
            <div class="bg-clr2 py-2 text-light">
                <p class="text-center m-0">Total Telat</p>
            </div>
            <div class="bg-light d-flex justify-content-center py-5 px-3">
                <div class="d-flex align-items-end gap-2">
                    <div class="d-flex align-items-end">
                        <h3 class="text-clr2 m-0 fw-bold">{{ $accumulative['total_telat']['jam'] }}</h3>
                        <p class="m-0 mb-1 fsz-10 ms-1 text-clr3">Jam</p>
                    </div>
                    <div class="d-flex align-items-end">
                        <h3 class="text-clr2 m-0 fw-bold">{{ $accumulative['total_telat']['menit'] }}</h3>
                        <p class="m-0 mb-1 fsz-10 ms-1 text-clr3">Menit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mt-4">
    <div class="card border-none shadow-l-2 rounded-s m-0 p-0">
        <div class="bg-clr2 rounded-s text-light d-flex align-items-end position-relative pe-5">
            <h5 class="m-0 my-4 ms-4 me-5 position-relative">Riwayat Shift <br class="d-block d-md-none">Bulan Ini</h5>
            <img src="{{ asset('assets/images/static/elements/dashboard-that.png') }}" class="ms-auto me-4 position-absolute" style="height:90px;right:-45px;">
        </div>
        <div class="p-3 w-100 overflow-scroll scrollbar-hidden">
            <table class="table table-striped text-clr2">
                <thead class="table-secondary">
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Pukul</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
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

<!-- Modal -->
<div class="modal fade" id="modalWarningMasuk" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-warning text-dark">
                <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                <button type="button" class="ms-auto hover bg-warning border-secondary text-dark rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Tidak dapat mengisi data.
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalMasuk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-clr2 text-light">
                <h1 class="modal-title fw-bold">Rekap Masuk</h1>
                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <p class="m-0">Presensi (masuk) terekap pada :</p>
                    <div class="d-flex fw-bold">
                        <p class="m-0 hari-now"></p>, <p class="ms-1 m-0 tanggal-now"></p>
                    </div>
                    <div class="d-flex fw-bold">
                        <p class="m-0 clock-now"></p>
                        <p class="ms-1 m-0">WIB</p>
                    </div>
                </div>
                <form action="{{ url('presensi-masuk') }}" method="post" class="text-clr2" id="formMasuk">
                    @csrf
                    <div class="mb-3">
                        <label for="presensi_keterangan">Tambah keterangan <i class="fst-normal text-secondary ms-2">Opsional</i></label>
                        <input name="presensi_keterangan" type="text" class="rounded-s border-clr2 bg-clrsec he-35 w-100 px-3 fsz-11" autocomplete="off" placeholder="...">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="presensi_status" class="form-label">Status Presensi</label>
                        <select class="form-select rounded-s border-clr2 m-0" id="presensi_status" name="presensi_status" required>
                            <option value="1" selected>Hadir</option>
                            <option value="3">Izin</option>
                        </select>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr2" id="btnFormMasuk">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalWarningPulang" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-warning text-dark">
                <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                <button type="button" class="ms-auto hover bg-warning border-secondary text-dark rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Tidak dapat mengisi data.
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPulang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-light rounded-m">
                <div class="modal-header bg-clr2 text-light">
                    <h1 class="modal-title fw-bold">Rekap Pulang</h1>
                    <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <p class="m-0">Presensi (pulang) terekap pada :</p>
                        <div class="d-flex fw-bold">
                            <p class="m-0 hari-now"></p>, <p class="ms-1 m-0 tanggal-now"></p>
                        </div>
                        <div class="d-flex fw-bold">
                            <p class="m-0 clock-now"></p>
                            <p class="ms-1 m-0">WIB</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ url('presensi-pulang') }}" method="post" class="text-clr2">
                        @csrf
                        <button type="submit" class="btn btn-clr2">Simpan</button>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>
    document.getElementById('btnFormMasuk').addEventListener('click', function() {
        document.getElementById('formMasuk').submit();
    });
</script>
