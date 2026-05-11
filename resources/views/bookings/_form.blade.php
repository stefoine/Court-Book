@php $sports = ['Basketball','Volleyball','Badminton','Futsal','Training Session','School Event','Community Event']; @endphp

<style>
    .nexus-input {
        width: 100%;
        background: rgba(15, 23, 42, 0.6) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 12px !important;
        padding: 0.75rem 1rem !important;
        color: #fff !important;
        font-size: 0.9rem !important;
        outline: none !important;
        transition: 0.3s !important;
        margin-top: 0.4rem;
    }
    .nexus-input:focus {
        border-color: #22d3ee !important;
        box-shadow: 0 0 15px rgba(34, 211, 238, 0.2) !important;
    }
    .nexus-label {
        font-size: 10px;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        display: block;
    }
    .grid-layout {
        display: grid;
        gap: 1.5rem;
    }
    /* Para sa custom date/time icons color */
    input::-webkit-calendar-picker-indicator {
        filter: invert(1);
        opacity: 0.5;
        cursor: pointer;
    }
</style>

<div class="grid-layout">
    {{-- Court Selection --}}
    <div>
        <label class="nexus-label">Target Arena / Facility</label>
        <select name="court_id" class="nexus-input" required>
            <option value="" style="background: #0f172a;">— Select Deployment Area —</option>
            @foreach($courts as $c)
                <option value="{{ $c->id }}" @selected(old('court_id', $booking?->court_id)==$c->id) style="background: #0f172a;">
                    {{ $c->name }} ({{ $c->type }}) — ₱{{ number_format($c->hourly_rate,2) }}/hr
                </option>
            @endforeach
        </select>
    </div>

    {{-- Activity & Purpose --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
        <div>
            <label class="nexus-label">Sport / Activity Class</label>
            <select name="sport_type" class="nexus-input" required>
                @foreach($sports as $s)
                    <option value="{{ $s }}" @selected(old('sport_type', $booking?->sport_type)==$s) style="background: #0f172a;">{{ $s }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="nexus-label">Mission Purpose</label>
            <input class="nexus-input" name="purpose" value="{{ old('purpose', $booking?->purpose) }}" required placeholder="Ex. Practice Match">
        </div>
    </div>

    {{-- Temporal Data (Date & Time) --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 1.5rem;">
        <div>
            <label class="nexus-label">Deployment Date</label>
            <input class="nexus-input" type="date" name="booking_date" value="{{ old('booking_date', $booking?->booking_date?->format('Y-m-d')) }}" required>
        </div>
        <div>
            <label class="nexus-label">Start Time</label>
            <input class="nexus-input" type="time" name="start_time" value="{{ old('start_time', $booking?->start_time) }}" required>
        </div>
        <div>
            <label class="nexus-label">End Time</label>
            <input class="nexus-input" type="time" name="end_time" value="{{ old('end_time', $booking?->end_time) }}" required>
        </div>
    </div>

    {{-- Notes --}}
    <div>
        <label class="nexus-label">Additional Intelligence (Notes)</label>
        <textarea name="notes" class="nexus-input" rows="3" placeholder="Enter special requirements or logistical notes...">{{ old('notes', $booking?->notes) }}</textarea>
    </div>

    {{-- File Upload --}}
    <div style="background: rgba(255,255,255,0.02); padding: 1.25rem; border-radius: 16px; border: 1px dashed rgba(255,255,255,0.1);">
        <label class="nexus-label" style="margin-bottom: 0.5rem;">Transaction Authentication (Payment Proof)</label>
        <input type="file" name="payment_proof" accept="image/*" class="nexus-input" style="border: none !important; background: transparent !important; padding-left: 0 !important;">
        <p style="margin-top: 0.5rem; font-size: 10px; color: #475569;">Supported formats: JPG, PNG. Max size: 2MB</p>
    </div>
</div>