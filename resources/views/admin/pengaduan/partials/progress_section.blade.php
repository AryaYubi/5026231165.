<div class="card mt-4">
    <div class="card-header">Progress Laporan</div>
    <div class="card-body">
        @forelse ($pengaduan->progress as $item)
            <div class="mb-3 p-3 rounded" style="background-color: #f8f9fa;">
                <div class="d-flex justify-content-between">
                    <small class="text-muted">{{ $item->created_at->format('d M Y H:i') }}</small>
                </div>
                <h6 class="mb-1">{{ $item->judul }}</h6>
                <p class="mb-2">{{ $item->keterangan }}</p>
                <div>
                    {{-- Tombol Edit dengan data attributes untuk JavaScript --}}
                    <button class="btn btn-sm btn-outline-primary btn-edit-progress"
                            data-action="{{ route('admin.progress.update', $item->id) }}"
                            data-judul="{{ $item->judul }}"
                            data-keterangan="{{ $item->keterangan }}">
                        Edit
                    </button>
                    <form action="{{ route('admin.progress.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus progress ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada progress untuk laporan ini.</p>
        @endforelse

        <hr>

        <h5 class="mt-4" id="form-progress-title">Tambah Progress Baru</h5>
        <form id="form-progress" action="{{ route('admin.progress.store') }}" method="POST">
            @csrf
            {{-- Elemen @method('PUT') akan ditambahkan oleh JavaScript saat mode edit --}}
            <div id="method-field"></div>

            <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Progress</label>
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul progress" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan Progress</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan progress" required></textarea>
            </div>
            <button type="submit" class="btn btn-success" id="btn-submit-progress">+ Tambah Progress</button>
            <button type="button" class="btn btn-secondary" id="btn-cancel-edit-progress" style="display: none;">Batal Edit</button>
        </form>
    </div>
</div>

{{-- Script diletakkan di sini agar bisa di-include oleh halaman show --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formProgress = document.getElementById('form-progress');
        const formTitle = document.getElementById('form-progress-title');
        const judulInput = document.getElementById('judul');
        const keteranganInput = document.getElementById('keterangan');
        const methodField = document.getElementById('method-field');
        const submitButton = document.getElementById('btn-submit-progress');
        const cancelButton = document.getElementById('btn-cancel-edit-progress');
        const originalAction = formProgress.action;

        // Fungsi untuk mereset form ke mode 'Tambah Baru'
        function resetForm() {
            formTitle.innerText = 'Tambah Progress Baru';
            formProgress.action = originalAction;
            methodField.innerHTML = ''; // Hapus method PUT
            judulInput.value = '';
            keteranganInput.value = '';
            submitButton.innerText = '+ Tambah Progress';
            submitButton.classList.remove('btn-primary');
            submitButton.classList.add('btn-success');
            cancelButton.style.display = 'none';
        }

        // Tambahkan event listener untuk semua tombol 'Edit'
        document.querySelectorAll('.btn-edit-progress').forEach(button => {
            button.addEventListener('click', function () {
                const action = this.dataset.action;
                const judul = this.dataset.judul;
                const keterangan = this.dataset.keterangan;

                // Ubah form ke mode 'Edit'
                formTitle.innerText = 'Edit Progress';
                formProgress.action = action;
                methodField.innerHTML = '@method("PUT")'; // Tambahkan method spoofing
                judulInput.value = judul;
                keteranganInput.value = keterangan;
                submitButton.innerText = 'Update Progress';
                submitButton.classList.remove('btn-success');
                submitButton.classList.add('btn-primary');
                cancelButton.style.display = 'inline-block';

                // Scroll ke form
                formProgress.scrollIntoView({ behavior: 'smooth' });
            });
        });

        // Event listener untuk tombol 'Batal Edit'
        cancelButton.addEventListener('click', resetForm);
    });
</script>
@endpush
