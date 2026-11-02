<div class="mb-3">
    <label for="patient_id" class="form-label">Pasien</label>
    <select
        id="patient_id"
        name="patient_id"
        class="form-select @error('patient_id') is-invalid @enderror"
    >
        <option value="">-- Pilih Pasien --</option>

        @foreach ($patients as $patient)
            <option
                value="{{ $patient->id }}"
                @selected(
                    (string) old('patient_id', $pendaftaran?->patient_id)
                    === (string) $patient->id
                )
            >
                {{ $patient->medical_record_number }} - {{ $patient->name }}
            </option>
        @endforeach
    </select>

    @error('patient_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="doctor_id" class="form-label">Dokter</label>
    <select
        id="doctor_id"
        name="doctor_id"
        class="form-select @error('doctor_id') is-invalid @enderror"
    >
        <option value="">-- Pilih Dokter --</option>

        @foreach ($doctors as $doctor)
            <option
                value="{{ $doctor->id }}"
                @selected(
                    (string) old('doctor_id', $pendaftaran?->doctor_id)
                    === (string) $doctor->id
                )
            >
                {{ $doctor->name }} ({{ $doctor->specialization }})
            </option>
        @endforeach
    </select>

    @error('doctor_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="registration_date" class="form-label">Tanggal Pendaftaran</label>
    <input
        id="registration_date"
        type="date"
        name="registration_date"
        class="form-control @error('registration_date') is-invalid @enderror"
        value="{{ old('registration_date', $pendaftaran?->registration_date?->format('Y-m-d') ?? $defaultDate) }}"
    >
    @error('registration_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="complaint" class="form-label">Keluhan (opsional)</label>
    <input
        id="complaint"
        type="text"
        name="complaint"
        class="form-control @error('complaint') is-invalid @enderror"
        maxlength="255"
        value="{{ old('complaint', $pendaftaran?->complaint) }}"
    >
    @error('complaint')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select
        id="status"
        name="status"
        class="form-select @error('status') is-invalid @enderror"
    >
        @foreach ($statuses as $value => $status)
            <option
                value="{{ $value }}"
                @selected(
                    (string) old('status', $pendaftaran?->status ?? 'waiting')
                    === (string) $value
                )
            >
                {{ $status['label'] }}
            </option>
        @endforeach
    </select>

    @error('status')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
