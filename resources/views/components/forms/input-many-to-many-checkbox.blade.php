@foreach($things as $thing)
<label class="text-white">
    <input type="checkbox" name="thingIds[]"
    value="{{ $thing->id }}" {{ in_array($thing->id,
        $myThingIds, false) ? 'checked' : '' }}>
    {{ $thing->name }}
</label>
@endforeach