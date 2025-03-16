<div class="bg-web d-flex flex-column justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;background-image:url('{{ url('assets/images/static/background/login.png') }}')">
    <div class="bg-light shadow-l border-radius-none m-0 p-0 border-radius-none" style="width:340px;">
        <div class="position-relative" style="margin-bottom:55px;">
            <img src="{{ asset('assets/images/static/elements/login-top.png') }}" class="w-100 bg-clr2">
            <img src="{{ asset('assets/images/static/elements/logo-circle.png') }}" class="position-absolute translate-center" style="width:150px;aspect-ratio:1/1;left:50%;top:75%;">
        </div>
        <div style="padding: 0 35px;">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="fw-bold text-clr2">Email</label>
                    <input type="text" class="border-clr2 rounded-m he-40 w-100 px-3 fsz-10 bg-clrsec" placeholder="ex: regananda12@gmail.com">
                </div>
                <div class="mb-3">
                    <label for="" class="fw-bold text-clr2">Password</label>
                    <input type="password" class="border-clr2 rounded-m he-40 w-100 px-3 fsz-10 bg-clrsec" placeholder="Maksimal 12 karakter">
                    <div class="d-flex align-items-center mt-3">
                        <input type="checkbox" name="" id="" class="rounded border-clr2 d-inline-block he-30">
                        <label for="" class="ms-2 text-clr2 fsz-12">Remember me</label>
                    </div>
                </div>
                <div class="mb-4 d-flex justify-content-center">
                    <button class="btn btn-clr2 btn-sm rounded-s fw-bold" style="width:140px;">Log In</button>
                </div>
            </form>
        </div>
    </div>
    <p class="text-center mt-4 m-0 text-clr2">© <?= date('Y') ?>, Created by <i class="fst-normal text-clr3">Manda</i></p>
</div>