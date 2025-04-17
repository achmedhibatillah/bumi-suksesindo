<div class="row m-0 p-0">
    <div class="col-md-12 m-0 p-3">
        <p class="fsz-12 text-secondary m-0">ID Sesi</p>
        <p class="">{{ $sesi['sesi_id'] }}</p>
        <hr>
        <div class="row m-0 p-0">
            <div class="m-0 p-0">
                <p class="m-0 fsz-12 text-secondary">Masuk</p>
                <p class="m-0">{{ $sesi['sesi_masuk_tgl'] }}</p>
                <p class="m-0">{{ $sesi['sesi_masuk_jam'] }} - {{ $sesi['sesi_pulang_jam'] }} WIB</p>
            </div>
        </div>
    </div>
</div>