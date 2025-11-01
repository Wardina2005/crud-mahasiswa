<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CSS Tambahan untuk Pagination agar lebih rapi */
        .pagination {
            font-size: 13px;
            margin-top: 8px;
        }
        .pagination .page-item {
            margin: 0 3px;
        }
        .pagination .page-link {
            padding: 4px 10px;
            min-width: 28px;
            height: 28px;
            line-height: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #0d6efd;
        }
        .pagination .page-item.active .page-link {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('mahasiswa.cetakPdf') }}" class="btn btn-danger">🖨 Cetak PDF</a>
                <a href="{{ route('mahasiswa.exportExcel') }}" class="btn btn-success">📤 Export Excel</a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
            </div>
        </div>

        <form action="{{ route('mahasiswa.index') }}" method="GET" class="mb-4 d-flex">
            <input type="text" name="search" class="form-control me-2" 
                    placeholder="Cari nama, NIM, atau email..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
            @if(request('search'))
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary ms-2">Reset</a>
            @endif
        </form>

        <div class="card shadow-sm">
            <div class="card-body">
                {{-- Cek apakah ada data yang ditemukan --}}
                @if($mahasiswa->isEmpty())
                    <div class="alert alert-warning text-center">
                        Tidak ada data mahasiswa yang cocok dengan pencarian "{{ request('search') }}".
                    </div>
                @else
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mahasiswa as $index => $m)
                            <tr>
                                <td class="text-center">{{ $mahasiswa->firstItem() + $index }}</td>
                                <td>{{ $m->nama }}</td>
                                <td>{{ $m->nim }}</td>
                                <td>{{ $m->email }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                                        
                                        {{-- Tombol Hapus (Mengaktifkan Modal) --}}
                                        <button type="button" 
                                                class="btn btn-danger btn-sm delete-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#confirmDeleteModal" 
                                                data-id="{{ $m->id }}" 
                                                data-nama="{{ $m->nama }}">
                                            🗑 Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $mahasiswa->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus data **<span id="mahasiswaNama" class="fw-bold"></span>**?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    {{-- Form ini akan diisi action-nya oleh JavaScript --}}
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var confirmDeleteModal = document.getElementById('confirmDeleteModal');
            
            // Event listener saat modal akan ditampilkan
            confirmDeleteModal.addEventListener('show.bs.modal', function(event) {
                // Ambil tombol yang mengaktifkan modal
                var button = event.relatedTarget;
                
                // Ambil ID dan Nama dari atribut data-* tombol
                var id = button.getAttribute('data-id');
                var nama = button.getAttribute('data-nama');
                
                // 1. Tampilkan Nama di modal body
                var modalNama = confirmDeleteModal.querySelector('#mahasiswaNama');
                modalNama.textContent = nama;
                
                // 2. Set action URL pada form hapus
                var deleteForm = confirmDeleteModal.querySelector('#deleteForm');
                
                // Asumsi rute destroy Anda adalah /mahasiswa/{id}
                var actionUrl = '/mahasiswa/' + id; 
                
                // Update attribute 'action' form
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    </script>
</body>
</html>