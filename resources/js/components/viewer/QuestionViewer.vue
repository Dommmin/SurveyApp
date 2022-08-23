<template>
    <fieldset class="mb-4">
        <div class="mt-3">
            <div v-if="question.type === 'radio'">
                <label>{{ index + 1 }}. {{ question.question }}</label>
                <div
                    v-for="(option, ind) of question.data.options"
                    :key="option.uuid"
                    class="flex items-center"
                >
                    <input
                        :id="option.uuid"
                        :name="'question' + question.id"
                        :value="option.text"
                        @change="emits('update:modelValue', $event.target.value)"
                        type="radio"
                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                        required
                    />
                    <label
                        :for="option.uuid"
                        class="ml-3 block text-sm font-medium text-gray-700"
                    >
                        {{ option.text }}
                    </label>
                </div>
            </div>
            <div v-else-if="question.type === 'text'">
                <label :for="question.id">{{ index + 1 }}. {{ question.question }}</label>
                <input
                    :id="question.id"
                    type="text"
                    :value="modelValue"
                    @input="emits('update:modelValue', $event.target.value)"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    required
                />
            </div>
        </div>
    </fieldset>
</template>

<script setup>
const { question, index, modelValue } = defineProps({
    question: Object,
    index: Number,
    modelValue: [String, Array],
});
const emits = defineEmits(["update:modelValue"]);

</script>
