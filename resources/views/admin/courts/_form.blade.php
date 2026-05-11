<div style="display: flex; flex-direction: column; gap: 1.5rem; animation: fadeIn 0.8s ease-out;">
    
    {{-- Main Grid for Inputs --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
        
        {{-- Name Field --}}
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Arena Designation</label>
            <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.75rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                   name="name" value="{{ old('name',$court?->name) }}" required placeholder="e.g. Sector 7 Court"
                   onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
        </div>

        {{-- Type Field --}}
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Classification</label>
            <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.75rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                   name="type" value="{{ old('type',$court?->type) }}" required placeholder="e.g. Indoor Basketball"
                   onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
        </div>

        {{-- Capacity Field --}}
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Max Entity Occupancy</label>
            <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.75rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                   type="number" name="capacity" value="{{ old('capacity',$court?->capacity) }}" required placeholder="0"
                   onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
        </div>

        {{-- Rate Field --}}
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Hourly Tariff (₱)</label>
            <input style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.75rem 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s;" 
                   type="number" step="0.01" name="hourly_rate" value="{{ old('hourly_rate',$court?->hourly_rate) }}" required placeholder="0.00"
                   onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                   onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">
        </div>
    </div>

    {{-- Description Field --}}
    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
        <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Operational Details / Description</label>
        <textarea style="background: rgba(15, 23, 42, 0.6); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 1rem; color: #fff; font-size: 0.9rem; outline: none; transition: 0.3s; min-height: 100px; resize: vertical;" 
                  name="description" rows="3" placeholder="Enter facility metadata..."
                  onfocus="this.style.borderColor='#22d3ee'; this.style.boxShadow='0 0 10px rgba(34, 211, 238, 0.2)';"
                  onblur="this.style.borderColor='rgba(255, 255, 255, 0.1)';">{{ old('description',$court?->description) }}</textarea>
    </div>

    {{-- File Upload and Checkbox Container --}}
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: center;">
        
        {{-- Image Upload --}}
        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
            <label style="font-size: 10px; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.1em;">Visual Asset (Image)</label>
            <input type="file" name="image" accept="image/*"
                   style="background: rgba(255, 255, 255, 0.02); border: 1px dashed rgba(255, 255, 255, 0.1); border-radius: 10px; padding: 0.5rem; color: #94a3b8; font-size: 0.8rem; cursor: pointer;">
        </div>

        {{-- Availability Toggle --}}
        <div style="display: flex; align-items: center; gap: 12px; padding-top: 1.25rem;">
            <label style="position: relative; display: inline-flex; align-items: center; cursor: pointer; gap: 12px; color: #fff; font-size: 0.85rem; font-weight: 600;">
                <input type="checkbox" name="is_available" value="1" @checked(old('is_available', $court?->is_available ?? true)) style="width: 1.25rem; height: 1.25rem; accent-color: #22d3ee; cursor: pointer;">
                Available for System Booking
            </label>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>