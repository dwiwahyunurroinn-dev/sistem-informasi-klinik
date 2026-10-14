<div>
    <label for="medical_record_number">Nomor Rekam Medis</label><br>
    <input id="medical_record_number" type="text"
           name="medical_record_number" maxlength="255"
           value="{{ old('medical_record_number', $pasien->medical_record_number ?? '') }}">
    @error('medical_record_number')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="name">Nama Pasien</label><br>
    <input id="name" type="text" name="name" maxlength="255"
           value="{{ old('name', $pasien->name ?? '') }}">
    @error('name')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="gender">Jenis Kelamin</label><br>
    <select id="gender" name="gender">
        <option value="">Pilih jenis kelamin</option>
        <option value="L"
                @selected(old('gender', $pasien->gender ?? '') === 'L')>
            Laki-laki
        </option>
        <option value="P"
                @selected(old('gender', $pasien->gender ?? '') === 'P')>
            Perempuan
        </option>
    </select>
    @error('gender')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="birth_date">Tanggal Lahir</label><br>
    <input id="birth_date" type="date" name="birth_date"
           value="{{ old('birth_date', $pasien->birth_date ?? '') }}">
    @error('birth_date')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="address">Alamat (opsional)</label><br>
    <textarea id="address" name="address" rows="3">{{ old('address', $pasien->address ?? '') }}</textarea>
    @error('address')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="phone">Telepon (opsional)</label><br>
    <input id="phone" type="text" name="phone" maxlength="20"
           value="{{ old('phone', $pasien->phone ?? '') }}">
    @error('phone')
        <p style="color: red;">{{ $message }}</p>
    @enderror
</div>

<br>
