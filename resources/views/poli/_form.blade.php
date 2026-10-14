<div>
    <label for="code">Kode Poli</label><br>
    <input id="code" type="text" name="code" maxlength="20"
           value="{{ old('code', $poli->code ?? '') }}">
    @error('code')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="name">Nama Poli</label><br>
    <input id="name" type="text" name="name" maxlength="255"
           value="{{ old('name', $poli->name ?? '') }}">
    @error('name')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="description">Deskripsi (opsional)</label><br>
    <textarea id="description" name="description"
              rows="3">{{ old('description', $poli->description ?? '') }}</textarea>
    @error('description')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="is_active">Status</label><br>
    <select id="is_active" name="is_active">
        <option value="1"
                @selected((string) old('is_active', isset($poli) ? (int) $poli->is_active : 1) === '1')>
            Aktif
        </option>
        <option value="0"
                @selected((string) old('is_active', isset($poli) ? (int) $poli->is_active : 1) === '0')>
            Tidak Aktif
        </option>
    </select>
    @error('is_active')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>
