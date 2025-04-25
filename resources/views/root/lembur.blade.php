<div class="row m-0 p-0 text-clr2">
    <div class="pt-5 pt-md-3">
        <h3 class="fw-bold mb-3 text-clr2">Data Pengajuan Lembur</h3>
        
        <div class="card m-0 p-3">
            @include('templates/flashmessage')
            @if($lembur->isNotEmpty())
                <div class="w-100 overflow-x-scroll">
                    <table class="table">
                        <thead class="table-secondary">
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @php($i = $lembur->firstItem())
                            @foreach($lembur as $x)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ url('root/karyawan/' . $x['user_id']) }}" target="_blank" class="td-hover">{{ $x['user_nama'] }}</a></td>
                                    <td>
                                        <p class="m-0">{{ $x['lembur_tgl'] }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0">{{ $x['lembur_mulai'] }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0">{{ $x['lembur_selesai'] }}</p>  
                                    </td>
                                    <td>{{ $x['lembur_status'] }}</td>
                                    <td>
                                        @if($x['lembur_konfirm'] == true)
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-clr2 fsz-10 lh-1 py-1" data-bs-toggle="modal" data-bs-target="#modalTinjau{{ $x['lembur_id'] }}">Tinjau</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modalTinjau{{ $x['lembur_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content border-light rounded-m">
                                            <div class="modal-header bg-clr2 text-light">
                                                <h3 class="modal-title fw-bold">Pengajuan Lembur</h3>
                                                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{ $x['user_nama'] }}</h5>
                                                <p class="m-0">{{ $x['lembur_tgl'] }}</p>
                                                <p class="m-0">{{ $x['lembur_mulai'] }} - {{ $x['lembur_selesai'] }}</p>
                                                <p class="m-0">Durasi : {{ $x['lembur_durasi'] }}</p>
                                                <p class="m-0">Status : {{ $x['lembur_status'] }}</p>
                                                <a href="{{ url('uploads/LMB-' . $x['lembur_id'] . '.pdf') }}" target="_blank" class="td-hover mt-3 d-block">Lihat file <i class="fas fa-file-pdf"></i></a>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ url('root/lembur/response') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="false">
                                                    <input type="hidden" name="lembur_id" value="{{ $x['lembur_id'] }}">
                                                    <input type="hidden" name="user_nama" value="{{ $x['user_nama'] }}">
                                                    <button class="btn btn-danger">Tolak</button>
                                                </form>
                                                <form action="{{ url('root/lembur/response') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="true">
                                                    <input type="hidden" name="lembur_id" value="{{ $x['lembur_id'] }}">
                                                    <input type="hidden" name="user_nama" value="{{ $x['user_nama'] }}">
                                                    <button class="btn btn-success">Setujui</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php($i++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    @include('templates/pagination', ['xxx' => $lembur])
                </div>
            @else 
                <div class="m-0 text-secondary">Belum ada pengajuan lembur tersedia.</div>
            @endif
        </div>
    </div>
</div>