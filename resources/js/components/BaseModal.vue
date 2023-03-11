<template>
    <Teleport to="body">
        <div
            id="popup-modal"
            tabindex="-1"
            :class="{ 'hidden': !modelValue }"
            class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] bg-custom-gray-light"
        >
            <div class="relative w-full h-full">
                <div class="relative bg-white rounded-lg shadow w-[480px]  m-auto">
                    <button
                        @click="cancel"
                        type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-10">
                        <h2 class="text-xl text-bold mb-5">{{ title}}</h2>
                        <h3 class="mb-5 text-sm font-normal text-custom-six">
                            {{ message }}
                        </h3>
                        <div class="text-right">
                            <button
                                @click="cancel"
                                class="bg-custom-gray-light text-custom-seven text-base py-4 px-6 font-bold rounded-full mr-2"
                            >
                                {{ cancelText ?? 'Cancel' }}
                            </button>
                            <button
                                @click="confirm"
                                class="bg-custom-eight text-white text-base py-4 px-6 font-bold rounded-full mr-2"
                            >
                                {{ confirmText ?? 'Confirm' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<script setup>
defineProps({
    modelValue: {
        type: Boolean,
        required: true
    },
    title: {
        type: String,
        required: true
    },
    message: {
        type: String,
        required: true
    },
    cancelText: {
        type: String,
        required: false
    },
    confirmText: {
        type: String,
        required: false
    }
})

const emit = defineEmits(['update:modelValue', 'confirm', 'cancel'])

const cancel = () => {
    emit('update:modelValue', false)
    emit('cancel')
}

const confirm = () => {
    emit('update:modelValue', false)
    emit('confirm')
}
</script>
