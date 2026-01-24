<!DOCTYPE html>
<html>
<head>
    <title>Penerjemah Bahasa</title>
</head>
<body>

<h2>Penerjemah Bahasa</h2>

<p id="error" style="color:red;"></p>

<form id="translateForm">
    @csrf

    <select name="source_lang">
        <option value="id">Indonesia</option>
        <option value="en">English</option>
    </select>

    <select name="target_lang">
        <option value="en">English</option>
        <option value="id">Indonesia</option>
    </select>

    <br><br>

    <textarea name="text" rows="5" cols="50" placeholder="Masukkan teks..."></textarea>

    <br><br>

    <button type="submit">Translate</button>
</form>

<h3 id="resultTitle" style="display:none;">Hasil Terjemahan:</h3>
<textarea id="resultBox" rows="5" cols="50" readonly style="display:none;"></textarea>

<script>
document.getElementById('translateForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const errorEl = document.getElementById('error');
    const resultBox = document.getElementById('resultBox');
    const resultTitle = document.getElementById('resultTitle');

    errorEl.textContent = '';
    resultBox.style.display = 'none';
    resultTitle.style.display = 'none';

    const formData = new FormData(this);

    try {
        const response = await fetch('/ajax/translate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        });

        const data = await response.json();

        if (!data.success) {
            errorEl.textContent = data.message;
            return;
        }

        resultTitle.style.display = 'block';
        resultBox.style.display = 'block';
        resultBox.value = data.translatedText;

    } catch (error) {
        errorEl.textContent = 'Terjadi kesalahan jaringan';
    }
});
</script>

</body>
</html>
