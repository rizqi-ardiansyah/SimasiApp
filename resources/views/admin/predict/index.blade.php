@extends('admin.mainIndex')
@section('content')

<div class="container">
    <h2>Prediksi Ekspresi Wajah</h2>

    <form id="formPrediksi" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto" id="fotoInput" required>
        <button type="submit" id="submitBtn" class="d-none">Kirim</button> <!-- Tombol disembunyikan -->
    </form>

    <div id="hasil" class="mt-3"></div>

    <script>
        const hasil = document.getElementById('hasil');
            hasil.innerText = 'tes';
        document.addEventListener('DOMContentLoaded', function () {
            
            const form = document.getElementById('formPrediksi');
            const fotoInput = document.getElementById('fotoInput');
            const hasil = document.getElementById('hasil');

            // Trigger submit otomatis setelah file diubah
            fotoInput.addEventListener('change', function () {
                if (fotoInput.files.length > 0) {
                    // Trigger submit programmatically
                    form.dispatchEvent(new Event('submit', { cancelable: true }));
                }
            });

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(form);

                fetch("{{ url('/predict') }}", {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    const label = { 0: 'Marah', 1: 'Senang', 2: 'Netral', 3: 'Sedih', 4: 'Terkejut' };
                    hasil.className = 'alert alert-info';
                    hasil.innerText = 'Ekspresi: ' + label[data.predicted_class] + ' (Confidence: ' + data.confidence + ')';
                })
                .catch(err => {
                    console.error(err);
                    hasil.className = 'alert alert-danger';
                    hasil.innerText = 'Terjadi kesalahan saat memproses.';
                });
            });
        });
    </script>
</div>

@endsection
