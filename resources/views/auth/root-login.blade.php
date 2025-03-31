<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;padding:100px 0;">
    <div class="card rounded-s bg-clr2 border-none m-0 p-3 text-light" style="max-width:300px;">
        <form action="{{ url('root/login') }}" method="post">
            @csrf 
            <div class="mb-3">
                <p class="fw-bold fsz-16 text-center">Masukkan Token Autentikasi</p>
                <input name="token" type="password" class="w-100 he-30 px-3 bg-clrsec rounded-s text-center" placeholder="...">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-light text-clr2 rounded-s">Submit</button>
            </div>
        </form>
    </div>
</div>