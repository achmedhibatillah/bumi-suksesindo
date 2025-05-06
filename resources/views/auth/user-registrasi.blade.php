<div class="bg-web d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;background-image:url('{{ url('assets/images/static/background/login.png') }}')">
    <div class="bg-light shadow-l border-radius-none m-0 p-0 border-radius-none" style="width:340px;">
        <div class="position-relative" style="margin-bottom:55px;">
            <img src="{{ asset('assets/images/static/elements/login-top.png') }}" class="w-100 bg-clr2">
            <img src="{{ asset('assets/images/static/elements/logo-circle.png') }}" class="position-absolute translate-center" style="width:150px;aspect-ratio:1/1;left:50%;top:75%;">
        </div>
        <div style="padding: 0 35px;">
            <h4 class="text-center text-clr2 fw-bold">Registrasi</h4>
            @include('templates/flashmessage')
            <hr class="text-clr2">
            <form action="{{ url('registrasi') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="email" class="fw-bold text-clr2 text-center d-block">Email</label>
                    <input name="email" id="email" type="text" class="rounded-m he-40 text-center w-100 px-3 fsz-10 border-clr2 bg-clrsec @error('email') border-clrdang @enderror" placeholder="ex: amanda12@gmail.com"
                    value="{{old('email')}}">
                    @error('email')
                        <div class="mt-1 fsz-10 lh-1 text-center text-clrdang"><i class="fas fa-exclamation-circle me-1"></i>{{$message}}</div>
                    @enderror
                </div>
                <div class="mb-4 row m-0 p-0 justify-content-center">
                    <div class="col-6 m-0 p-0">
                        <button type="submit" class="btn btn-clr2 btn-sm rounded-s fw- w-100">Daftar</button>
                    </div>
                </div>
            </form>
            <p class="text-secondary text-center fsz-12">Sudah punya akun? <a href="{{ url('login') }}" class="td-hover text-clr2">Login di sini.</a></p>
        </div>
    </div>
    <p class="text-center mt-4 m-0 text-clr2">© <?= date('Y') ?>, Created by <i class="fst-normal text-clr3">Manda</i></p>
</div>