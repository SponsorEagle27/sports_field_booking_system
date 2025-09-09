@php /** @var \App\Models\SportsField $field */ @endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Field - {{ $field->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h3 class="mb-3">Edit Field</h3>
    <form method="POST" action="{{ route('admin.fields.update', $field->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $field->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Sport Type</label>
            @php $sportOptions = ['football','cricket','badminton','paddle','tabletennis','basketball','tennis']; @endphp
            <select name="sport_type" class="form-select" required>
                @foreach($sportOptions as $opt)
                    <option value="{{ $opt }}" {{ old('sport_type', $field->sport_type) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="{{ old('location', $field->location) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="{{ old('address', $field->address) }}">
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Size</label>
                @php $sizeOptions = ['Full Size','Half Size','Mini','Single Court','Double Court']; @endphp
                <select name="size" class="form-select">
                    @foreach($sizeOptions as $opt)
                        <option value="{{ $opt }}" {{ old('size', $field->size) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Surface</label>
                @php $surfaceOptions = ['Indoor Court','Outdoor Court','Turf','Grass','Hardcourt','Clay']; @endphp
                <select name="surface" class="form-select">
                    @foreach($surfaceOptions as $opt)
                        <option value="{{ $opt }}" {{ old('surface', $field->surface) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" {{ old('status', $field->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="maintenance" {{ old('status', $field->status) === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    <option value="unavailable" {{ old('status', $field->status) === 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Type</label>
            @php $typeOptions = ['indoor','outdoor']; @endphp
            <select name="type" class="form-select" required>
                @foreach($typeOptions as $opt)
                    <option value="{{ $opt }}" {{ old('type', $field->type) === $opt ? 'selected' : '' }}>{{ ucfirst($opt) }}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Opening Time</label>
                <input type="time" class="form-control" name="opening_time" value="{{ old('opening_time', \Carbon\Carbon::parse($field->opening_time)->format('H:i')) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Closing Time</label>
                <input type="time" class="form-control" name="closing_time" value="{{ old('closing_time', \Carbon\Carbon::parse($field->closing_time)->format('H:i')) }}">
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Base Price (per 90min)</label>
            <input type="number" min="0" step="1" class="form-control" name="price_per_90min" value="{{ old('price_per_90min', (int) $field->price_per_90min) }}" required>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.fields.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>
</div>
</body>
</html>
