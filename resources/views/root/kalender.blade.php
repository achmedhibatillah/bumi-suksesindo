<div class="m-3">
    <h3>Kalender</h3>
    <form action="{{ url('root/kalender') }}" method="get">
        @csrf 
        <p class="m-0 lh-1 mb-2">Cari rentang 30 hari dimulai<br>dari tanggal yang Anda input</p>
        <div class="d-flex gap-2">
            <input type="date" name="tgl" class="form-control border-clr2" style="width:200px" value="{{ $tgl }}">
            <button type="submit" class="btn btn-clr2">Cari</button>
        </div>
    </form>
    <div class="mt-2">
        <p class="m-0">{{ $tgl }} - {{ $tgl_30 }}</p>
    </div>
    <button class="btn btn-clr2 my-3" data-bs-toggle="modal" data-bs-target="#modalTambah">Tambah kegiatan <i class="fas fa-calendar"></i></button>
    <div class="">
        @include('templates/flashmessage')
    </div>
    <div class="mt-3 w-100 overflow-x-scroll">
        <table class="table">
            <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th></th>
            </thead>
            <tbody>
                @php($i = 1)
                @foreach ($kalender as $x)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $x['kalender_tgl'] }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="rounded-circle square we-12 he-12 me-2 {{ $x['kalender_style'] }}">.</i>
                                {{ $x['kalender_kegiatan'] }}

                            </div>
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ url('root/kalender/delete') }}" data-bs-toggle="modal" data-bs-target="#modalDel{{$x['kalender_id']}}" class="btn btn-danger lh-1 fsz-10">Hapus <i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modalDel{{$x['kalender_id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                            <div class="modal-content border-light rounded-m">
                                <div class="modal-header bg-danger text-light">
                                    <h5 class="modal-title fw-bold me-5">Apakah Anda yakin?</h5>
                                    <button type="button" class="ms-auto hover bg-danger border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
                                </div>
                                <div class="modal-body">
                                    Ingin menghapus kegiatan di tanggal {{$x['kalender_tgl']}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{url('root/kalender/delete')}}" method="post">
                                        @csrf 
                                        <input type="hidden" name="kalender_id" value="{{ $x['kalender_id'] }}">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
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
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-light rounded-m">
            <div class="modal-header bg-clr2 text-light">
                <h3 class="modal-title fw-bold">Tambah Kegiatan</h3>
                <button type="button" class="ms-auto hover bg-clr2 border-light text-light rounded-circle he-28 we-28" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('root/kalender/add') }}" id="formAdd" method="post" class="text-clr2">
                    @csrf
                    <div class="mb-3">
                        <label for="">Tanggal</label>
                        <input type="date" name="kalender_tgl" class="form-control border-clr2" value="{{ old('kalender_tgl') }}">
                        @error('kalender_tgl')
                            <div class="mt-2 mx-2 text-danger fsz-10"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="">Kegiatan</label>
                        <input type="text" name="kalender_kegiatan" class="form-control border-clr2" value="{{ old('kalender_kegiatan') }}" placeholder="...">
                        @error('kalender_kegiatan')
                            <div class="mt-2 mx-2 text-danger fsz-10"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kalender_style" class="form-label m-0">Warna</label>
                        <select name="kalender_style" id="kalender_style" class="form-select border-clr2">
                            <option value="">-- Pilih Warna --</option>
                            <option value="1" {{ old('kalender_style') == '1' ? 'selected' : '' }}>Merah</option>
                            <option value="2" {{ old('kalender_style') == '2' ? 'selected' : '' }}>Biru</option>
                            <option value="3" {{ old('kalender_style') == '3' ? 'selected' : '' }}>Hijau</option>
                            <option value="4" {{ old('kalender_style') == '4' ? 'selected' : '' }}>Abu-Abu</option>
                        </select>
                        @error('kalender_style')
                            <div class="mt-2 mx-2 text-danger fsz-10"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>
                        @enderror
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-clr2" onclick="submitAdd()">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    @if(session()->has('errors') && (session('errors')->has('kalender_tgl')))
        var myModal = new bootstrap.Modal(document.getElementById('modalTambah'));
        myModal.show();
    @endif
});
function submitAdd() { document.getElementById('formAdd').submit(); }
</script>