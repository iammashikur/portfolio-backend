@php $editing = isset($experience) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="company"
            label="Company"
            :value="old('company', ($editing ? $experience->company : ''))"
            maxlength="255"
            placeholder="Company"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="designation"
            label="Designation"
            :value="old('designation', ($editing ? $experience->designation : ''))"
            maxlength="255"
            placeholder="Designation"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="from_date"
            label="From Date"
            value="{{ old('from_date', ($editing ? optional($experience->from_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="to_date"
            label="To Date"
            value="{{ old('to_date', ($editing ? optional($experience->to_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $experience->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
