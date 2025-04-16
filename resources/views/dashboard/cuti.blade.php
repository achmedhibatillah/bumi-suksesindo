<div class="row m-0 p-0">
    <div class="card m-0 p-0 overflow-hidden rounded-m">
        <div class="bg-clr2 p-3">
            <p class="m-0 text-light fw-bold">Formulir Pengajuan Cuti</p>
        </div>
        <div class="">
            <form action="{{ url('izin-cuti/request') }}" method="post" class="m-3">
                @csrf 
                <div class="mb-3 w-100 overflow-hidden row m-0 p-0 text-clr2 border-clr2 rounded-m">
                    <div class="col-1 m-0 p-3 fw-bold border-clr2">
                        Pilih
                    </div>
                    <div class="col-9 m-0 p-3 fw-bold border-clr2">
                        Cuti
                    </div>
                    <div class="col-2 m-0 p-3 fw-bold border-clr2">
                        Sisa Cuti
                    </div>
                    <!-- Data -->
                    <div class="col-1 m-0 p-3 border-clr2">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="col-9 m-0 p-3 border-clr2">
                        Cuti Tahunan
                    </div>
                    <div class="col-2 m-0 p-3 border-clr2">
                        25 x
                    </div>
                    <!-- Data -->
                    <div class="col-1 m-0 p-3 border-clr2">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="col-9 m-0 p-3 border-clr2">
                        Cuti Sakit atau Melahirkan
                    </div>
                    <div class="col-2 m-0 p-3 border-clr2">
                        25 x
                    </div>
                    <!-- Data -->
                    <div class="col-1 m-0 p-3 border-clr2">
                        <input type="checkbox" name="" id="">
                    </div>
                    <div class="col-9 m-0 p-3 border-clr2">
                        Cuti Keluarga atau Duka
                    </div>
                    <div class="col-2 m-0 p-3 border-clr2">
                        25 x
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="text-clr2 fw-bold">Mulai Cuti</label>
                    <input type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3">
                </div>
                <div class="mb-3">
                    <label for="" class="text-clr2 fw-bold">Akhir Cuti</label>
                    <input type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3">
                </div>
                <div class="mb-3">
                    <label for="" class="text-clr2 fw-bold">Alasan Cuti</label>
                    <input type="text" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" placeholder="..." autocomplete="off">
                </div>
            </form>
        </div>
    </div>
</div>