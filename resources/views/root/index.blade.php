<div class="row m-0 p-0 text-clr2">
    <div class="col-md-6 m-0 p-0">
        <h3>Data Sesi</h3>
        @foreach($sesi as $x)
            <div class="">
                <h5>{{ $x->sesi_id }}</h5>
                <p>{{ $x->sesi_mulai }}</p>
                <p>{{ $x->sesi_pulang }}</p>
            </div>
        @endforeach
    </div>
    <div class="col-md-6 m-0 p-0">
        <div class="card">
            <h3>Tambah Sesi</h3>
            <hr>
            <form action="{{ url('root/sesi/tambah') }}" method="post">
                @csrf 
                <div class="row m-0 p-0 mb-3">
                    <div class="col-6 m-0 pe-1">
                        <label for="">Waktu Masuk</label>
                        <input type="date" name="" id="" class="form-control">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>