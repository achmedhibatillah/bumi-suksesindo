<div class="row m-0 p-0">
    <div class="card m-0 p-0 overflow-hidden rounded-m">
        <div class="bg-clr2 p-3">
            <p class="m-0 text-light fw-bold">Formulir Pengajuan Cuti</p>
        </div>
        <div class="m-2 mt-3">
            @include('templates/flashmessage')
        </div>
        <div class="">
            <form action="{{ url('izin-cuti/request') }}" method="post" class="m-3" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 mb-3">
                    <label for="cuti_status" class="text-clr2 fw-bold">Jenis Cuti</label>
                    <select name="cuti_status" id="cuti_status" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3">
                        <option value="" disabled selected>Pilih Jenis Cuti</option>
                        <option value="1" {{ old('cuti_status') == '1' ? 'selected' : '' }}>Cuti Tahunan</option>
                        <option value="2" {{ old('cuti_status') == '2' ? 'selected' : '' }}>Cuti Sakit atau Melahirkan</option>
                        <option value="3" {{ old('cuti_status') == '3' ? 'selected' : '' }}>Cuti Keluarga atau Cuti Duka</option>
                    </select>
                    @error('cuti_status')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cuti_mulai" class="text-clr2 fw-bold">Mulai Cuti</label>
                    <input name="cuti_mulai" type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" value="{{ old('cuti_mulai') }}">
                    @error('cuti_mulai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cuti_selesai" class="text-clr2 fw-bold">Akhir Cuti</label>
                    <input name="cuti_selesai" type="date" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" value="{{ old('cuti_selesai') }}">
                    @error('cuti_selesai')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cuti_alasan" class="text-clr2 fw-bold">Alasan Cuti</label>
                    <input name="cuti_alasan" type="text" class="rounded-s border-clr2 d-block he-35 w-100 text-clr2 px-3" placeholder="..." autocomplete="off" value="{{ old('cuti_alasan') }}">
                    @error('cuti_alasan')
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                <label for="cuti_file" class="text-clr2 fw-bold mb-1">File Pendukung (PDF, maks 10 MB)</label>
                    <input name="cuti_file" type="file" class="form-control border-clr2 rounded-s"
                    accept="application/pdf">
                    @if(session('errors') && session('errors')->has('cuti_file'))
                        <div class="fsz-10 text-danger ms-2">
                            <i class="fas fa-exclamation-circle me-1"></i>{{ session('errors')->first('cuti_file') }}
                        </div>
                    @elseif(session('errors'))
                        <div class="fsz-10 text-danger ms-2"><i class="fas fa-exclamation-circle me-1"></i>Silakan upload ulang file.</div>
                    @endif
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-clr2">
                        <img src="{{ asset('assets/images/static/icons/submit.png') }}" class="he-15 me-2">
                        Ajukan Cuti
                    </button>
                </div>
            </form>

        </div>
    </div>

    <div class="card m-0 p-0 mt-3 overflow-hidden rounded-m">
        <div class="bg-clr2 p-3">
            <p class="m-0 text-light fw-bold">Riwayat Pengajuan Cuti</p>
        </div>
        <div class="w-100 overflow-x-scroll p-3">
            <table class="table">
                <thead>
                    <th>Pengajuan</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Durasi</th>
                    <th>Status Persetujuan</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($cuti as $x)
                        <tr>
                            <td>{{ $x['created_at'] }}</td>
                            <td>{{ $x['cuti_mulai'] }}</td>
                            <td>{{ $x['cuti_selesai'] }}</td>
                            <td>{{ $x['cuti_durasi'] }}</td>
                            <td>{{ $x['cuti_verif'] }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-clr2 lh-1 py-1" data-bs-toggle="modal" data-bs-target="#modalInfo{{ $x['cuti_id'] }}">Lihat</a>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="modalInfo{{ $x['cuti_id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-light rounded-m">
                                    <div class="modal-header bg-clr2 text-light">
                                        <h5 class="modal-title fw-bold">Informasi Cuti</h5>
                                        <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row m-0 p-0 w-100">
                                            <div class="col-4 m-0 p-0">Tanggal pengajuan</div>
                                            <div class="col-1 m-0 p-0 pe-1 text-end">:</div>
                                            <div class="col-7 m-0 p-0">{{ $x['created_at'] }}</div>
                                            <!--  -->
                                            <div class="col-12 m-0 p-0 pt-3 fw-bold">Waktu cuti</div>
                                            <!--  -->
                                            <div class="col-4 m-0 p-0">Tanggal mulai</div>
                                            <div class="col-1 m-0 p-0 pe-1 text-end">:</div>
                                            <div class="col-7 m-0 p-0">{{ $x['cuti_mulai'] }}</div>
                                            <!--  -->
                                            <div class="col-4 m-0 p-0">Tanggal mulai</div>
                                            <div class="col-1 m-0 p-0 pe-1 text-end">:</div>
                                            <div class="col-7 m-0 p-0">{{ $x['cuti_selesai'] }}</div>
                                            <!--  -->
                                            <div class="col-4 m-0 p-0">Durasi</div>
                                            <div class="col-1 m-0 p-0 pe-1 text-end">:</div>
                                            <div class="col-7 m-0 p-0">{{ $x['cuti_durasi'] }}</div>
                                            <!--  -->
                                            <div class="col-12 m-0 p-0 pt-3 fw-bold">Status persetujuan</div>
                                            <div class="col-12 m-0 p-0">{{ $x['cuti_verif'] }}</div>
                                            <!--  -->
                                            <div class="col-12 m-0 p-0 pt-3 fw-bold">Alasan cuti</div>
                                            <div class="col-12 m-0 p-0">{{ $x['cuti_alasan'] }}</div>
                                            <!--  -->
                                            <div class="col-12 m-0 p-0 pt-3 fw-bold">Dokumen persetujuan</div>
                                            <div class="col-12 m-0 p-0"><a href="{{ url('uploads/CTI-' . $x['cuti_id'] . '.pdf') }}" target="_blank" class="td-hover">Lihat dokumen <i class="fas fa-file-pdf"></i></a></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                @include('templates/pagination', ['xxx' => $cuti])
            </div>
        </div>
    </div>
</div>
