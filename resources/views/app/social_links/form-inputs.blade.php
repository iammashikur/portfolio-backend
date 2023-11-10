@php $editing = isset($socialLink) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $socialLink->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="icon"
            label="Icon"
            :value="old('icon', ($editing ? $socialLink->icon : ''))"
            maxlength="255"
            placeholder="Icon"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="link"
            label="Link"
            :value="old('link', ($editing ? $socialLink->link : ''))"
            maxlength="255"
            placeholder="Link"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
