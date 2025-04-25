<div class="row m-0 p-0 text-clr2">
    <div class="pt-5 pt-md-3">
        <h3 class="fw-bold mb-3 text-clr2">Data Pengajuan Cuti</h3>
        
        <div class="card m-0 p-3">
            @include('templates/flashmessage')
            @if($cuti->isNotEmpty())
                <div class="w-100 overflow-x-scroll">
                    <table class="table">
                        <thead class="table-secondary">
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Waktu Cuti</th>
                            <th>Durasi</th>
                            <th>Status Persetujuan</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php $i = $cuti->firstItem() ?>
                            @foreach($cuti as $x)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ url('root/karyawan/' . $x['user_id']) }}" target="_blank" class="td-hover">{{ $x['user_nama'] }}</a></td>
                                    <td>
                                        <p class="m-0">{{ $x['created_at'] }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0">{{ $x['cuti_mulai'] }} - {{ $x['cuti_selesai'] }}</p>
                                    </td>
                                    <td>
                                        <p class="m-0">{{ $x['cuti_durasi'] }}</p>  
                                    </td>
                                    <td><p class="m-0">{{ $x['cuti_verif'] }}</p>  </td>
                                    <td>
                                        @if($x['cuti_konfirm'] == true)
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-clr2 fsz-10 lh-1 py-1" data-bs-toggle="modal" data-bs-target="#modalTinjau{{ $x['cuti_id'] }}">Tinjau</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modalTinjau{{ $x['cuti_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content border-light rounded-m">
                                            <div class="modal-header bg-clr2 text-light">
                                                <h3 class="modal-title fw-bold">Pengajuan Cuti</h3>
                                                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>{{ $x['user_nama'] }}</h5>
                                                <p class="m-0">{{ $x['created_at'] }}</p>
                                                <p class="m-0">{{ $x['cuti_mulai'] }} - {{ $x['cuti_selesai'] }}</p>
                                                <p class="m-0">Durasi : {{ $x['cuti_durasi'] }}</p>
                                                <p class="m-0">Status : {{ $x['cuti_status'] }}</p>
                                                <p class="m-0">Alasan : {{ $x['cuti_alasan'] }}</p>
                                                <a href="{{ url('uploads/CTI-' . $x['cuti_id'] . '.pdf') }}" target="_blank" class="td-hover mt-3 d-block">Lihat file <i class="fas fa-file-pdf"></i></a>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ url('root/cuti/response') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="false">
                                                    <input type="hidden" name="cuti_id" value="{{ $x['cuti_id'] }}">
                                                    <input type="hidden" name="user_nama" value="{{ $x['user_nama'] }}">
                                                    <button class="btn btn-danger">Tolak</button>
                                                </form>
                                                <form action="{{ url('root/cuti/response') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="true">
                                                    <input type="hidden" name="cuti_id" value="{{ $x['cuti_id'] }}">
                                                    <input type="hidden" name="user_nama" value="{{ $x['user_nama'] }}">
                                                    <button class="btn btn-success">Setujui</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++ ?>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        @include('templates/pagination', ['xxx' => $cuti])
                    </div>
                </div>
            @else 
                <div class="m-0 text-secondary">Belum ada yang mengajukan cuti.</div>
            @endif
        </div>
    </div>
</div>