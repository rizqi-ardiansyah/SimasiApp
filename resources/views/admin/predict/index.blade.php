@extends('admin.mainIndex')
@section('content')

<div class="container">
    <h2>Prediksi Ekspresi Wajah</h2>

    <form id="formPrediksi" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto" required>
        <button type="submit">Kirim</button>
    </form>

    <div id="hasil"></div>

    <script>
        document.getElementById('formPrediksi').addEventListener('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            fetch("{{ url('/predict') }}", {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                const label = { 0: 'Marah', 1: 'Senang', 2: 'Netral', 3: 'Sedih', 4: 'Terkejut' };
                document.getElementById('hasil').innerText = 'Ekspresi: ' + label[data.predicted_class] + ' (Confidence: ' + data.confidence + ')';
            })
            .catch(err => {
                console.error(err);
                document.getElementById('hasil').innerText = 'Terjadi kesalahan saat memproses.';
            });
        });
    </script>
</div>

@endsection
