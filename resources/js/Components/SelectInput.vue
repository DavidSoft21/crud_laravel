<script setup>
import { ref, watchEffect } from "vue";

const emit = defineEmits(["update:modelValue"]);

const props = defineProps({
    options: {
        type: Array,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        default: null,
    },
});

const selectedValue = ref(props.modelValue);

watchEffect(() => {
    emit("update:modelValue", selectedValue.value);
});
</script>

<template>
    <select
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-500"
        v-model="selectedValue"
    >
        <option disabled value="">Select one</option>
        <option v-for="option in options" :key="option.id" :value="option.id">
            {{ option.name }}
        </option>
    </select>
</template>
