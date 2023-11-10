@php $editing = isset($tool) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $tool->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="logo"
            label="Logo"
            :value="old('logo', ($editing ? $tool->logo : ''))"
            maxlength="255"
            placeholder="Logo"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
