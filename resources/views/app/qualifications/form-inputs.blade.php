@php $editing = isset($qualification) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="School"
            label="School"
            :value="old('School', ($editing ? $qualification->School : ''))"
            maxlength="255"
            placeholder="School"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="from_date"
            label="From Date"
            value="{{ old('from_date', ($editing ? optional($qualification->from_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="to_date"
            label="To Date"
            value="{{ old('to_date', ($editing ? optional($qualification->to_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="degree"
            label="Degree"
            :value="old('degree', ($editing ? $qualification->degree : ''))"
            maxlength="255"
            placeholder="Degree"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $qualification->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
