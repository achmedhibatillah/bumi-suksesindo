<div class="">
    <div class="d-flex align-items-start gap-3">
        <div data-bs-toggle="modal" data-bs-target="#modalPicture" class="d-flex flex-shrink-0 justify-content-center align-items-center cursor-pointer position-relative square" style="width:100px">
            <i class="fas fa-pencil position-absolute bg-secondary text-light p-1 fsz-10 rounded-circle" style="right:7px;bottom:7px"></i>
            @if($pp !== null)
                <img src="{{ $pp ? asset($pp) : asset('uploads/default.svg') }}" class="img-cover rounded-circle" alt="Profil">
            @else 
                <img src="{{ asset('assets/images/static/icons/blank-profile.png') }}" class="img-cover rounded-circle">
            @endif
        </div>
        <div class="lh-1 pt-2">
            <h5>{{ $user['user_nama'] }}</h5>
            <p class="text-secondary">{{ $user['user_email'] }}</p>
            <a href="#" class="btn btn-clr2 rounded-pill p-0 px-3 fsz-10" data-bs-toggle="modal" data-bs-target="#modalNama">Ganti nama profil</a>
        </div>
    </div>
    <hr>
    <div class="mt-3">
        <h5>Informasi detail</h5>
        <table>
            <tr>
                <td>Alamat lengkap</td>
                <td>:</td>
                <td>{{ $profil->profil_alamat }}</td>
            </tr>
            <tr>
                <td>Nomor telepon</td>
                <td>:</td>
                <td>{{ $profil->profil_telp }}</td>
            </tr>
        </table>
        <a href="#" class="btn btn-warning lh-1 rounded-pill mt-3 px-3 fsz-10" data-bs-toggle="modal" data-bs-target="#modalInformasi">Ubah</a>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPicture" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-clr2 text-light">
                <h3 class="modal-title fw-bold">Foto Profil</h3>
                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                @if($pp !== null)
                    <div class="d-flex justify-content-center mb-3">
                        <div data-bs-toggle="modal" data-bs-target="#modalPicture" class="d-flex flex-shrink-0 justify-content-center align-items-center cursor-pointer position-relative square" style="width:100px">
                        <img src="{{ $pp ? asset($pp) : asset('uploads/default.svg') }}" class="img-cover rounded-circle" alt="Profil">
                        </div>
                    </div>
                @endif 
                <form action="{{ url('profil/pp') }}" method="post" enctype="multipart/form-data" class="text-clr2" id="formProfil">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                        <input type="file" name="pp" class="form-control border-clr2 rounded-m" accept="image/png" required>
                        @error('pp')
                            <div class="ms-3 fsz-10 mt-1 text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr2" id="btnFormProfil">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalNama" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-clr2 text-light">
                <h3 class="modal-title fw-bold">Profil</h3>
                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profil/nama') }}" method="post" enctype="multipart/form-data" class="text-clr2" id="formNama">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                    <div class="mb-3">
                        <label class="ms-2 fw-bold">Nama :</label>
                        <input type="text" name="user_nama" class="form-control border-clr2 rounded-m" placeholder="..."
                        value="{{ old('user_nama', $user['user_nama']) }}">
                        @error('user_nama')
                            <div class="ms-3 fsz-10 mt-1 text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="ms-2 fw-bold">Email :</label>
                        <input type="text" name="user_email" class="form-control border-clr2 rounded-m" placeholder="..."
                        value="{{ old('user_email', $user['user_email']) }}">
                        @error('user_email')
                            <div class="ms-3 fsz-10 mt-1 text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr2" id="btnFormNama">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalInformasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-clr2 text-light">
                <h3 class="modal-title fw-bold">Informasi Detail</h3>
                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profil/informasi') }}" method="post" enctype="multipart/form-data" class="text-clr2" id="formInformasi">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user['user_id'] }}">
                    <div class="mb-3">
                        <label class="ms-2 fw-bold">Alamat Lengkap :</label>
                        <input type="text" name="profil_alamat" class="form-control border-clr2 rounded-m" placeholder="..."
                        value="{{ old('profil_alamat', $profil['profil_alamat']) }}">
                        @error('profil_alamat')
                            <div class="ms-3 fsz-10 mt-1 text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="ms-2 fw-bold">Nomor Telepon :</label>
                        <input type="number" name="profil_telp" class="form-control border-clr2 rounded-m" placeholder="..."
                        value="{{ old('profil_telp', $profil['profil_telp']) }}">
                        @error('profil_telp')
                            <div class="ms-3 fsz-10 mt-1 text-danger"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-clr2" id="btnFormInformasi">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session()->has('errors') && (session('errors')->has('pp')))
            var myModal = new bootstrap.Modal(document.getElementById('modalPicture'));
            myModal.show();
        @endif
        @if(session()->has('errors') && ((session('errors')->has('user_nama')) || (session('errors')->has('user_email'))))
            var myModal = new bootstrap.Modal(document.getElementById('modalNama'));
            myModal.show();
        @endif
        @if(session()->has('errors') && ((session('errors')->has('profil_alamat')) || (session('errors')->has('profil_telp'))))
            var myModal = new bootstrap.Modal(document.getElementById('modalInformasi'));
            myModal.show();
        @endif
    });
    document.getElementById('btnFormProfil').addEventListener('click', function() {
        document.getElementById('formProfil').submit();
    });
    document.getElementById('btnFormNama').addEventListener('click', function() {
        document.getElementById('formNama').submit();
    });
    document.getElementById('btnFormInformasi').addEventListener('click', function() {
        document.getElementById('formInformasi').submit();
    });
</script>