@extends('layouts.admin')
@section('title', $room ? 'Edit Room' : 'Add Room')

@section('content')
    <div class="form-container">
        <form method="POST" action="{{ $room ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}"
            enctype="multipart/form-data" class="admin-form">
            @csrf
            @if($room)
                @method('PUT')
            @endif

            <div class="form-row">
                <div class="form-group">
                    <label for="name">Room Name</label>
                    <input type="text" name="name" id="name" required value="{{ old('name', $room?->name) }}"
                        class="form-control @error('name') is-invalid @enderror" autocomplete="off"
                        placeholder="e.g. Sunrise Standard…">
                    @error('name')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="type">Room Type</label>
                    <select name="type" id="type" required class="form-control @error('type') is-invalid @enderror">
                        <option value="">Select type…</option>
                        @foreach(['standard', 'deluxe', 'suite', 'family'] as $type)
                            <option value="{{ $type }}" {{ old('type', $room?->type) == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Describe the room features and amenities…">{{ old('description', $room?->description) }}</textarea>
                @error('description')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="price_per_night">Price per Night (Rp)</label>
                    <input type="number" name="price_per_night" id="price_per_night" required
                        value="{{ old('price_per_night', $room?->price_per_night) }}"
                        class="form-control @error('price_per_night') is-invalid @enderror" min="0" step="10000"
                        inputmode="numeric" autocomplete="off">
                    @error('price_per_night')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="capacity">Capacity (Guests)</label>
                    <input type="number" name="capacity" id="capacity" required
                        value="{{ old('capacity', $room?->capacity) }}"
                        class="form-control @error('capacity') is-invalid @enderror" min="1" max="10" inputmode="numeric"
                        autocomplete="off">
                    @error('capacity')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required class="form-control @error('status') is-invalid @enderror">
                        <option value="available" {{ old('status', $room?->status) == 'available' ? 'selected' : '' }}>
                            Available</option>
                        <option value="unavailable" {{ old('status', $room?->status) == 'unavailable' ? 'selected' : '' }}>
                            Unavailable</option>
                    </select>
                    @error('status')
                        <span class="form-error" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="image">Room Image</label>
                @if($room?->image)
                    <div class="current-image">
                        <img src="{{ asset('storage/' . $room->image) }}" alt="Current room image" width="200" height="130"
                            loading="lazy">
                        <p class="form-hint">Upload a new image to replace the current one</p>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="form-control @error('image') is-invalid @enderror">
                <span class="form-hint">Maximum file size: 2 MB</span>
                @error('image')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg">{{ $room ? 'Update Room' : 'Create Room' }}</button>
                <a href="{{ route('admin.rooms') }}" class="btn btn-outline btn-lg">Cancel</a>
            </div>
        </form>
    </div>
@endsection