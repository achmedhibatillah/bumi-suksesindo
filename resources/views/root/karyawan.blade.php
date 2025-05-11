<div class="row mb-5">
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-1.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-2.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-3.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-4.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-5.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
    <div class="col-4 col-lg-3 col-xxl-2 py-2 d-flex justify-content-center">
        <img src="{{ asset('assets/images/dynamic/galeri/gal-6.jpeg') }}" class="rounded shadow-m" style="width:95%" alt="Galeri">
    </div>
</div>


<h3 class="text-clr2 fw-bold mb-3">Data Karyawan</h3>

<div class="overflow-x-scroll overflow-y-hidden w-100">
    <table class="table">
        <thead class="table-secondary">
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Bergabung</th>
            <th>Tindakan</th>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($karyawan as $x)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <p class="m-0"><a href="{{ url('root/karyawan/' . $x['user_id']) }}" class="td-hover text-clr2">{{ $x['user_nama'] }}</a></p>
                        <p class="m-0 text-secondary">{{ $x['user_email'] }}</p>
                    </td>
                    <td>{{ $x['created_at_tgl'] }}</td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalDel-{{ $x['user_id'] }}" class="btn btn-danger btn-sm fsz-10" style="width:100px;">Hapus <i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</div>

@foreach($karyawan as $x)
<!-- Modal -->
<div class="modal fade" id="modalDel-{{ $x['user_id'] }}" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-dialog modal-sm">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-danger text-light">
                <h1 class="modal-title fs-5"><i class="fas fa-exclamation-circle me-2"></i>Peringatan</h1>
                <button type="button" class="ms-auto hover bg-danger border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data karyawan ini?
                <table class="mt-3">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $x['user_nama'] }}</td>
                    </tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>{{ $x['user_email'] }}</td>
                </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ url('root/karyawan/del') }}" method="post">
                    @csrf 
                    <input type="hidden" name="user_id" value="{{ $x['user_id'] }}">
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach