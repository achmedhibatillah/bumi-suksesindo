<div class="row bg-clr2 m-0 p-3">
    <div class="d-flex overflow-hidden m-0 p-0" style="width:170px;">
        <img src="{{ asset('assets/images/static/elements/logo-dashboard.png') }}" class="w-100">
    </div>
</div>
<div class="row m-0 p-0 text-clr2">
    <div class="order-2 order-md-1 col-md-6 m-0 p-md-3 pe-md-1 pt-5 pt-md-3">
        <div class="card m-0 p-3">
            <h3 class="fw-bold mb-3 text-clr2">Data Sesi</h3>
            @include('templates/flashmessage')
            @if($sesi->isNotEmpty())
                <div class="w-100 overflow-x-scroll">
                    <table class="table">
                        <thead class="table-secondary">
                            <th>ID Sesi</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                            <th>Tindakan</th>
                        </thead>
                        <tbody>
                            @foreach($sesi as $x)
                                <tr>
                                    <td><a href="{{ url('root/sesi/' . $x['sesi_id']) }}" class="td-hover">{{ $x['sesi_id'] }}</a></td>
                                    <td>{{ $x['sesi_masuk'] }}</td>
                                    <td>{{ $x['sesi_pulang'] }}</td>
                                    <td>{{ $x['status'] }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="btn btn-danger fsz-10" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $x['sesi_id'] }}"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else 
                <div class="m-0 text-secondary">Belum ada sesi tersedia.</div>
            @endif
        </div>
    </div>
    <div class="order-1 order-md-2 col-md-6 m-0 p-md-3 ps-md-1 pe-md-1 pt-5 pt-md-3">
        <div class="card m-0 p-3 bg-clrsec text-clr2">
            <h3 class="">Tambah Sesi</h3>
            <hr>
            <form action="{{ url('root/sesi/add') }}" method="post">
                @csrf 
                <div class="row m-0 p-0 mb-3">
                    <div class="col-md-6 m-0 p-0">
                        <label for="">Tanggal</label>
                        <input type="date" name="tgl" id="tgl" class="form-control border-clr2"
                        value="{{ old('tgl') }}">
                        @error('tgl')
                            <div class="fsz-10 text-danger ms-2 mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row m-0 p-0 mb-3">
                    <div class="col-6 m-0 p-0 pe-1">
                        <label for="">Waktu Masuk</label>
                        <input type="time" name="jam_masuk" id="" class="form-control border-clr2 bg-clr4"
                        value="{{ old('jam_masuk') }}">
                        @error('jam_masuk')
                            <div class="fsz-10 text-danger ms-2 mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 m-0 p-0 ps-1">
                        <label for="">Waktu Pulang</label>
                        <input type="time" name="jam_pulang" id="" class="form-control border-clr2 bg-clr5"
                        value="{{ old('jam_pulang') }}">
                        @error('jam_pulang')
                            <div class="fsz-10 text-danger ms-2 mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="m-0 mb-3">
                    <textarea name="sesi_deskripsi" id="sesi_deskripsi" placeholder="Deskripsi sesi." class="p-3 d-block w-100 rounded border-clr2">{{ old('sesi_deskripsi') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

@foreach($sesi as $x)
<!-- Modal -->
<div class="modal fade" id="modalDelete{{ $x['sesi_id'] }}" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                <button type="button" class="ms-auto hover bg-danger border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus sesi ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ url('root/sesi/del') }}" method="post">
                    @csrf 
                    <input type="hidden" name="sesi_id" value="{{ $x['sesi_id'] }}">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach