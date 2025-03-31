<div class="bg-web d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;background-image:url('{{ url('assets/images/static/background/login.png') }}')">
    <div class="bg-light shadow-l border-radius-none m-0 p-0 border-radius-none" style="width:340px;">
        <div class="position-relative" style="margin-bottom:55px;">
            <img src="{{ asset('assets/images/static/elements/login-top.png') }}" class="w-100 bg-clr2">
            <img src="{{ asset('assets/images/static/elements/logo-circle.png') }}" class="position-absolute translate-center" style="width:150px;aspect-ratio:1/1;left:50%;top:75%;">
        </div>
        <div style="padding: 0 35px;">
            @include('templates/flashmessage')
            <form action="{{ url('login') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="" class="fw-bold text-clr2">Email</label>
                    <input name="email" type="text" class="border-clr2 rounded-m he-40 w-100 px-3 fsz-10 bg-clrsec" placeholder="ex: regananda12@gmail.com">
                    @error('email')
                        <p class="m-0 mt-1 ms-3 text-danger fsz-10"><i class="fas fa-exclamation-circle me-2"></i>{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="fw-bold text-clr2">Password</label>
                    <input name="password" type="password" class="border-clr2 rounded-m he-40 w-100 px-3 fsz-10 bg-clrsec" placeholder="Maksimal 12 karakter">
                    @error('password')
                        <p class="m-0 mt-1 ms-3 text-danger fsz-10"><i class="fas fa-exclamation-circle me-2"></i>{{ $message }}</p>
                    @enderror
                    <div class="d-flex align-items-center mt-3">
                        <input type="checkbox" name="" id="" class="rounded border-clr2 d-inline-block he-30">
                        <label for="" class="ms-2 text-clr2 fsz-12">Remember me</label>
                    </div>
                </div>
                <div class="mb-4 row m-0 p-0">
                    <div class="col-6 m-0 p-0 pe-1">
                        <button type="submit" class="btn btn-clr2 btn-sm rounded-s fw-bold w-100">Log In</button>
                    </div>
                    <div class="col-6 m-0 p-0 ps-1">
                        <a href="{{ url('registrasi') }}" class="btn btn-outline-clr2 btn-sm rounded-s fw- w-100">Registrasi</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p class="text-center mt-4 m-0 text-clr2">© <?= date('Y') ?>, Created by <i class="fst-normal text-clr3">Manda</i></p>
</div>