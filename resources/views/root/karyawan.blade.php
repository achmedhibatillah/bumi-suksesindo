<h3 class="text-clr2 fw-bold mb-3">Data Karyawan</h3>

<div class="overflow-x-scroll overflow-y-hidden w-100">
    <table class="table">
        <thead class="table-secondary">
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Bergabung</th>
            <th>Tindakan</th>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($karyawan as $x)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <p class="m-0"><a href="{{ url('root/karyawan/' . $x['user_id']) }}" class="td-hover text-clr2">{{ $x['user_nama'] }}</a></p>
                        <p class="m-0 text-secondary">{{ $x['user_email'] }}</p>
                    </td>
                    <td>{{ $x['created_at_tgl'] }}</td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalDel-{{ $x['user_id'] }}" class="btn btn-danger btn-sm fsz-10" style="width:100px;">Hapus <i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</div>