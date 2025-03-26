<div class="bg-web d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;background-image:url('{{ url('assets/images/static/background/login.png') }}')">
    <div class="bg-light shadow-l border-radius-none m-0 p-0 border-radius-none py-4 px-3" style="width:340px;">
        <h3 class="text-center">Verifikasi email Anda</h3>
        <div class="mt-3">
            <p class="text-center mb-1">Kami telah mengirimkan email ke</p>
            <p class="text-center mb-1 fw-bold">{{ $email }}</p>
            <p class="text-center m-0">SIlakan cek untuk melakukan verifikasi.</p>
        </div>
        <div class="mt-5">
            <p class="text-center mb-1">Tidak menerima email? Cek folder spam atau</p>
            <form action="{{ url('registrasi') }}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <div class="d-flex justify-content-center m-0 p-0">
                    <button type="submit" class="btn btn-transparent m-0 p-0 text-primary">Kirim ulang email</button>
                </div>
            </form>
        </div>
    </div>
    <p class="text-center mt-4 m-0 text-clr2">© <?= date('Y') ?>, Created by <i class="fst-normal text-clr3">Manda</i></p>
</div>