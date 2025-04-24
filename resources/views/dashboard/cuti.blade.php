<div class="row m-0 p-0">
    <div class="card m-0 p-0 overflow-hidden rounded-m">
        <div class="bg-clr2 p-3">
            <p class="m-0 text-light fw-bold">Formulir Pengajuan Cuti</p>
        </div>
        <div class="">
            <form action="{{ url('izin-cuti/request') }}" method="post" class="m-3">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="cuti_status" class="text-clr2 fw-bold">Jenis Cuti</label>
                    <select name="cuti_status" id="cuti_status" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3">
                        <option value="" disabled selected>Pilih Jenis Cuti</option>
                        <option value="1" {{ old('cuti_status') == '1' ? 'selected' : '' }}>Cuti Tahunan</option>
                        <option value="2" {{ old('cuti_status') == '2' ? 'selected' : '' }}>Cuti Sakit atau Melahirkan</option>
                        <option value="3" {{ old('cuti_status') == '3' ? 'selected' : '' }}>Cuti Keluarga atau Cuti Duka</option>
                    </select>
                    @error('cuti_status')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cuti_mulai" class="text-clr2 fw-bold">Mulai Cuti</label>
                    <input name="cuti_mulai" type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" value="{{ old('cuti_mulai') }}">
                    @error('cuti_mulai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cuti_selesai" class="text-clr2 fw-bold">Akhir Cuti</label>
                    <input name="cuti_selesai" type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" value="{{ old('cuti_selesai') }}">
                    @error('cuti_selesai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cuti_alasan" class="text-clr2 fw-bold">Alasan Cuti</label>
                    <input name="cuti_alasan" type="text" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" placeholder="..." autocomplete="off" value="{{ old('cuti_alasan') }}">
                    @error('cuti_alasan')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-clr2">
                        <img src="{{ asset('assets/images/static/icons/submit.png') }}" class="he-15 me-2">
                        Ajukan Cuti
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>