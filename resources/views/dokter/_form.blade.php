<div class="mb-3">
    <label for="doctor_code" class="form-label">Kode Dokter</label>
    <input
        id="doctor_code"
        type="text"
        name="doctor_code"
        class="form-control @error('doctor_code') is-invalid @enderror"
        maxlength="255"
        value="{{ old('doctor_code', $dokter->doctor_code ?? '') }}"
    >
    @error('doctor_code')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Nama Dokter</label>
    <input
        id="name"
        type="text"
        name="name"
        class="form-control @error('name') is-invalid @enderror"
        maxlength="255"
        value="{{ old('name', $dokter->name ?? '') }}"
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="specialization" class="form-label">Spesialisasi</label>
    <input
        id="specialization"
        type="text"
        name="specialization"
        class="form-control @error('specialization') is-invalid @enderror"
        maxlength="255"
        value="{{ old('specialization', $dokter->specialization ?? '') }}"
    >
    @error('specialization')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Telepon (opsional)</label>
    <input
        id="phone"
        type="text"
        name="phone"
        class="form-control @error('phone') is-invalid @enderror"
        maxlength="20"
        value="{{ old('phone', $dokter->phone ?? '') }}"
    >
    @error('phone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="poli_id" class="form-label">Poli</label>
    <select
        id="poli_id"
        name="poli_id"
        class="form-select @error('poli_id') is-invalid @enderror"
    >
        <option value="">-- Pilih Poli --</option>

        @foreach ($polis as $poli)
            <option
                value="{{ $poli->id }}"
                @selected(
                    (string) old('poli_id', $dokter->poli_id ?? '')
                    === (string) $poli->id
                )
            >
                {{ $poli->name }}{{ $poli->is_active ? '' : ' (Tidak aktif)' }}
            </option>
        @endforeach
    </select>

    @error('poli_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if ($polis->isEmpty())
        <p class="text-danger mt-2">
            Belum ada Poli yang dapat dipilih. Tambahkan atau aktifkan Poli terlebih dahulu.
        </p>
    @endif
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Status Dokter</label>
    <select
        id="is_active"
        name="is_active"
        class="form-select @error('is_active') is-invalid @enderror"
    >
        <option
            value="1"
            @selected(
                (string) old('is_active', isset($dokter) ? (int) $dokter->is_active : 1)
                === '1'
            )
        >
            Aktif
        </option>

        <option
            value="0"
            @selected(
                (string) old('is_active', isset($dokter) ? (int) $dokter->is_active : 1)
                === '0'
            )
        >
            Tidak Aktif
        </option>
    </select>

    @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
