<!DOCTYPE html>
<html>
<head>
    <title>Penerjemah Bahasa</title>
</head>
<body>

<h2>Penerjemah Bahasa</h2>

@if ($errors->any())
    <div style="color:red;">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="/translate">
    @csrf

    <select name="source_lang">
        <option value="id" {{ old('source_lang') == 'id' ? 'selected' : '' }}>Indonesia</option>
        <option value="en" {{ old('source_lang') == 'en' ? 'selected' : '' }}>English</option>
    </select>

    <select name="target_lang">
        <option value="en" {{ old('target_lang') == 'en' ? 'selected' : '' }}>English</option>
        <option value="id" {{ old('target_lang') == 'id' ? 'selected' : '' }}>Indonesia</option>
    </select>

    <br><br>

    <textarea name="text" rows="5" cols="50">{{ old('text') }}</textarea>

    <br><br>

    <button type="submit">Translate</button>
</form>

@if(isset($result))
    <h3>Hasil Terjemahan:</h3>
    <textarea rows="5" cols="50" readonly>{{ $result }}</textarea>
@endif

</body>
</html>
