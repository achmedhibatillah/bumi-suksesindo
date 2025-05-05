<div class="card rounded-m overflow-hidden m-0 p-0 mb-3">
    <div class="bg-clr2 text-light p-3">
        <p class="m-0 fw-bold">Formulir Pengajuan Lembur</p>
    </div>
    <div class="p-3">
        <form action="{{ url('lembur/request') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
            <div class="row m-0 p-0">
                <div class="col-md-4 m-0 p-1">
                    <p class="text-clr2 fw-bold text-center mb-1">Tanggal Lembur</p>
                    <input type="date" name="lembur_tgl" id="lembur_tgl" class="form-control border-clr2 text-clr2 rounded-s"
                    value="{{ old('lembur_tgl') }}">
                    @error('lembur_tgl')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6 col-md-4 m-0 p-1 pt-4 pt-md-1">
                    <p class="text-clr2 fw-bold text-center mb-1">Jam Mulai Lembur</p>
                    <input type="time" name="lembur_mulai" id="lembur_mulai" class="form-control border-clr2 text-clr2 rounded-s text-center"
                    value="{{ old('lembur_mulai') }}">
                    @error('lembur_mulai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6 col-md-4 m-0 p-1 pt-4 pt-md-1">
                    <p class="text-clr2 fw-bold text-center mb-1">Jam Selesai Lembur</p>
                    <input type="time" name="lembur_selesai" id="lembur_selesai" class="form-control border-clr2 text-clr2 rounded-s text-center"
                    value="{{ old('lembur_selesai') }}">
                    @error('lembur_selesai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row m-0 p-0 pt-4">
                <div class="col-md-12 m-0 p-1">
                    <p class="text-clr2 fw-bold mb-1">Catatan / Deskripsi Tugas Lembur</p>
                    <input name="lembur_catatan" type="text" class="form-control border-clr2 rounded-s" placeholder="..." autocomplete="off"
                    value="{{ old('lembur_catatan') }}">
                    @error('lembur_catatan')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-clr2 rounded-s mt-4"><img src="{{ asset('assets/images/static/icons/submit.png') }}" class="he-15 me-2">Ajukan Lembur</button>
            </div>
        </form>
    </div>
</div>

@include('templates/flashmessage')

<div class="card overflow-hidden rounded-m">
    <div class="bg-clr2 text-light p-3">
        <p class="m-0 fw-bold">Riwayat Lembur</p>
    </div>
    <div class="p-3 w-100 overflow-x-scroll">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Tanggal pelaksanaan</th>
                <th>Jam mulai</th>
                <th>Jam selesai</th>
                <th>Durasi</th>
                <th>Status</th>
                <th></th>
            </thead>
            <?php $i = $lembur->firstItem() ?>
            @foreach($lembur as $x)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $x['lembur_tgl'] }}</td>
                    <td>{{ $x['lembur_mulai'] }}</td>
                    <td>{{ $x['lembur_selesai'] }}</td>
                    <td>{{ $x['lembur_durasi'] }}</td>
                    <td>{{ $x['lembur_status'] }}</td>
                    <td><a href="#" class="btn btn-clr2 lh-1 fsz-10" data-bs-toggle="modal" data-bs-target="#modalInfo{{ $x['lembur_id'] }}">Lihat</a></td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="modalInfo{{ $x['lembur_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-light rounded-m">
                            <div class="modal-header bg-clr2 text-light">
                                <h3 class="modal-title fw-bold">Pengajuan Lembur</h3>
                                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                            </div>
                            <div class="modal-body">
                                {{-- <h5>{{ $x['user_nama'] }}</h5> --}}
                                <p class="m-0">{{ $x['lembur_tgl'] }}</p>
                                <p class="m-0">{{ $x['lembur_mulai'] }} - {{ $x['lembur_selesai'] }}</p>
                                <p class="m-0">Durasi : {{ $x['lembur_durasi'] }}</p>
                                <p class="m-0">Status : {{ $x['lembur_status'] }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++ ?>
            @endforeach
        </table>
    </div>
    <div class="d-flex justify-content-end m-3">
        @include('templates/pagination', ['xxx' => $lembur])
    </div>
</div>