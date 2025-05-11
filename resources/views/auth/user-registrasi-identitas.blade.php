<div class="bg-web d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;background-image:url('{{ url('assets/images/static/background/login.png') }}')">
    <div class="bg-light shadow-l border-radius-none m-0 p-0 border-radius-none py-4 px-3" style="width:340px;">
        <h5 class="text-center text-clr2 fw-bold">Identitas Diri</h5>
        <hr>
        <form action="{{ url('registrasi/identitas') }}" method="post">
            @csrf
            <input type="hidden" name="ut_id" value="{{ $ut->ut_id }}">
            <input type="hidden" name="user_email" value="{{ $ut->ut_email }}">
            <div class="mb-3">
                <label for="user_nama" class="text-clr2">Nama Lengkap</label>
                <input name="user_nama" id="user_nama" type="text" class="rounded-m fsz-10 border-clr2 bg-clrsec w-100 he-40 px-3 @error('user_nama') border-clrdang @enderror" autocomplete="off" placeholder="ex: Amanda Faizatun"
                value="{{ old('user_nama') }}">
                @error('user_nama')
                    <div class="mt-1 fsz-10 lh-1 text-center text-clrdang"><i class="fas fa-exclamation-circle me-1"></i>{{$message}}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="mb-1">
                    <label for="user_password" class="text-clr2">Password</label>
                    <input name="user_password" id="user_password" type="password" class="rounded-m fsz-10 border-clr2 bg-clrsec w-100 he-40 px-3 @error('user_password') border-clrdang @enderror" autocomplete="off" placeholder="Maksimal 12 karakter"
                    value="{{ old('user_password') }}">
                </div>
                <div class="m-0">
                    <input name="user_password_confirmation" id="user_password_confirmation" type="password" class="rounded-m fsz-10 border-clr2 bg-clrsec w-100 he-40 px-3 @error('user_password') border-clrdang @enderror" autocomplete="off" placeholder="Konfirmasi Password"
                    value="{{ old('user_password_confirmation') }}">
                </div>
                @error('user_password')
                    <div class="mt-1 fsz-10 lh-1 text-center text-clrdang"><i class="fas fa-exclamation-circle me-1"></i>{{$message}}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-clr2 rounded-s px-3">Simpan</button>
            </div>
        </form>
    </div>
    <p class="text-center mt-4 m-0 text-clr2">© <?= date('Y') ?>, Created by <i class="fst-normal text-clr3">Manda</i></p>
</div>