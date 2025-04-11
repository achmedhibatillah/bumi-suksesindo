<div class="row m-0 p-0 text-clr2">
    <div class="order-2 order-md-1 col-md-6 m-0 p-md-3 pe-md-1 pt-5 pt-md-3">
        <h3>Data Sesi</h3>
        @if($sesi->isNotEmpty())
            <table class="table">
                <thead class="table-secondary">
                    <th>ID Sesi</th>
                    <th>Masuk</th>
                    <th>Pulang</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach($sesi as $x)
                        <tr>
                            <td>{{ $x->sesi_id }}</td>
                            <td>{{ $x->sesi_masuk }}</td>
                            <td>{{ $x->sesi_pulang }}</td>
                            <td>
                                @if(now() < $x->sesi_masuk)
                                @elseif(now() >= $x->sesi_masuk || now() <= $x->sesi_pulang)
                                Aktif
                                @else
                                Berlalu
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else 
            <div class="m-0 text-secondary">Belum ada sesi tersedia.</div>
        @endif
    </div>
    <div class="order-1 order-md-2 col-md-6 m-0 p-md-3 ps-md-1 pe-md-1 pt-5 pt-md-3">
        <div class="card bg-clrsec text-clr2">
            <h3 class="m-3">Tambah Sesi</h3>
            <hr>
            <form action="{{ url('root/sesi/add') }}" method="post">
                @csrf 
                <div class="row m-0 p-0 mb-3">
                    <div class="col-6 m-0 pe-1">
                        <label for="">Waktu Masuk</label>
                        <input type="datetime-local" name="sesi_masuk" id="" class="form-control border-clr2 bg-clr4">
                        @error('sesi_mulai')
                            <div class="fsz-10 text-danger ms-2 mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6 m-0 ps-1">
                        <label for="">Waktu Pulang</label>
                        <input type="datetime-local" name="sesi_pulang" id="" class="form-control border-clr2 bg-clr5">
                        @error('sesi_pulang')
                            <div class="fsz-10 text-danger ms-2 mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="m-3">
                    <textarea name="sesi_deskripsi" id="sesi_deskripsi" placeholder="Deskripsi sesi." class="p-3 d-block w-100 rounded border-clr2"></textarea>
                </div>
                <button type="submit" class="btn btn-primary m-3">Simpan</button>
            </form>
        </div>
    </div>
</div>