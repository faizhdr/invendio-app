
    @php
        $ar_judul = ['No', 'Nama Barang', 'Stok', 'Merek', 'Kategori', 'Keterangan', 'Tgl Masuk'];
        $no = 1;
    @endphp
    <h3 align="center">Data Barang</h3>

    <table border="1" align="center" cellpadding="5">
        <thead>
            <tr>
                @foreach ($ar_judul as $jdl)
                    <th>{{ $jdl }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($ar_barang as $b)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $b->nama }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>{{ $b->merek }}</td>
                    <td>{{ $b->kat }}</td>
                    <td>{{ $b->keterangan }}</td>
                    <td>{{ $b->created_at }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

