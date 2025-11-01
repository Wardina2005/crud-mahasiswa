<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Mahasiswa</title>
    <style>
        /* Gaya Dasar */
        body { font-family: sans-serif; } /* Menggunakan font sans-serif dasar yang didukung Dompdf */
        h2 { 
            text-align: center; 
            margin-bottom: 20px; 
            color: #333;
        }

        /* Gaya Tabel */
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #444; 
            padding: 8px 12px; 
            text-align: left;
            font-size: 10pt;
        }
        th { 
            background-color: #f2f2f2; /* Header agak abu-abu */
            text-align: center;
            font-weight: bold;
        }
        td.center {
            text-align: center;
        }
        
        /* Footer (Opsional: untuk mencantumkan tanggal cetak, dll.) */
        .footer {
            position: fixed; 
            bottom: -50px; 
            left: 0px; 
            right: 0px; 
            height: 50px; 
            text-align: center;
            line-height: 35px;
            font-size: 8pt;
            color: #777;
        }
    </style>
</head>
<body>
    
    <h2>LAPORAN DAFTAR MAHASISWA</h2>
    
    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th width="150">Nama</th>
                <th width="100">NIM</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $mhs)
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i:s') }}
    </div>
    
</body>
</html>