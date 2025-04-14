<div class="card rounded-m overflow-hidden m-0 p-0 mb-3">
    <div class="bg-clr2 text-light p-3">
        <p class="m-0 fw-bold">Formulir Pengajuan Lembur</p>
    </div>
    <div class="p-3">
        <form action="{{ url('lembur/request') }}" method="post">
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
                <p class="text-clr2 fw-bold mb-1">Catatan / Deskripsi Tugas Lembur</p>
                <input name="lembur_catatan" type="text" class="form-control border-clr2 rounded-s" placeholder="..." autocomplete="off"
                value="{{ old('lembur_catatan') }}">
                @error('lembur_catatan')
                    <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-clr2 rounded-s mt-4"><img src="{{ asset('assets/images/static/icons/submit.png') }}" class="he-15 me-2">Ajukan Lembur</button>
            </div>
        </form>
    </div>
</div>

@include('templates/flashmessage')

<div class="card overflow-hidden rounded-m"></div>