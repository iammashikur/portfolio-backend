@php $editing = isset($skill) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $skill->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="icon"
            label="Icon"
            :value="old('icon', ($editing ? $skill->icon : ''))"
            maxlength="255"
            placeholder="Icon"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="value"
            label="Value"
            :value="old('value', ($editing ? $skill->value : ''))"
            max="255"
            placeholder="Value"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status"
            label="Status"
            :checked="old('status', ($editing ? $skill->status : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
