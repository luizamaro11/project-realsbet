<script setup>
  defineProps({
    name: "SelectInput",
    props: {
      options: {
        type: Array,
        required: true,
        default: () => [],
      },
      modelValue: {
        type: [String, Number],
        default: "",
      },
      label: {
        type: String,
        default: "",
      },
      id: {
        type: String,
        default: "custom-select",
      },
    },
  });

  defineEmits(['update:modelValue']);
</script>
  
<template>
    <div class="flex flex-col gap-2">
      <label v-if="label" :for="id" class="text-sm font-medium text-gray-700">
        {{ label }}
      </label>
      <select 
        :id="id" 
        class="px-3 py-2 text-sm border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 border-gray-300 text-gray-700"
        :value="modelValue" 
        @change="$emit('update:modelValue', $event.target.value)"
      >
        <option v-for="(option, index) in options" 
                :key="index" 
                :value="option.value">
          {{ option.label }}
        </option>
      </select>
    </div>
  </template>