<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import { useForm } from "@inertiajs/vue3";
import { nextTick, onMounted, ref } from "vue";
import axios from "axios";

const nameInput = ref(null);
const emailInput = ref(null);
const passwordInput = ref(null);
const roleInput = ref(null);
const options = ref([]);

const props = defineProps({
    show: {
        type: Boolean,
        default: () => false,
    },
});

const form = useForm({
    name: "",
    email: "",
    password: "",
    role: "",
});

const confirmUserDeletion = () => {
    confirmingUserCreate.value = true;
    nextTick(() => passwordInput.value.focus());
};

const createUser = () => {
    form.post(route("users.store"), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => nameInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    emit("closeModal");
    form.errors = {};
    form.reset();
};

onMounted(async () => {
    try {
        const response = await axios.get(route("roles.selectRoles"));
        options.value = response.data;
    } catch (error) {
        console.error(error);
    }
});
const emit = defineEmits(["closeModal"]);
</script>

<template>
    <Modal :show="show" @close="$emit('closeModal')">
        <div class="p-6">
            <h2 class="text-lg font-medium text-indigo-600 text-center">
                Create User
            </h2>

            <div class="flex flex-col justify-center items-center mx-auto mt-6">
                <InputLabel
                    for="role"
                    value="Role"
                    class="sr-only text-indigo-400"
                />
                <div>{{ form.role }}</div>
                <SelectInput
                    ref="roleInput"
                    id="role"
                    v-model="form.role"
                    :options="options"
                    class="mt-1 block w-3/4"
                >
                </SelectInput>

                <InputError
                    :message="form.errors.role && form.errors.role[0]"
                    class="block w-3/4 text-start"
                />
            </div>

            <div class="flex flex-col justify-center items-center mx-auto mt-3">
                <InputLabel
                    for="name"
                    value="Name"
                    class="sr-only text-indigo-400"
                />

                <TextInput
                    id="name"
                    ref="nameInput"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-3/4 text-indigo-500"
                    placeholder="Name"
                />

                <InputError
                    :message="form.errors.name && form.errors.name[0]"
                    class="block w-3/4 text-start"
                />
            </div>

            <div class="flex flex-col justify-center items-center mx-auto mt-3">
                <InputLabel
                    for="email"
                    value="Email"
                    class="sr-only text-indigo-400"
                />

                <TextInput
                    id="email"
                    ref="emailInput"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-3/4 text-indigo-500"
                    placeholder="Email"
                />

                <InputError
                    :message="form.errors.email && form.errors.email[0]"
                    class="block w-3/4 text-start"
                />
            </div>

            <div class="flex flex-col justify-center items-center mx-auto mt-3">
                <InputLabel
                    for="password"
                    value="Password"
                    class="sr-only text-indigo-400"
                />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-3/4 text-indigo-500"
                    placeholder="Password"
                />

                <InputError
                    :message="form.errors.password && form.errors.password[0]"
                    class="block w-3/4 text-start"
                />
            </div>

            <div class="mt-6 flex justify-center">
                <PrimaryButton class="bg-indigo-500" @click="closeModal">
                    Cancel
                </PrimaryButton>

                <PrimaryButton
                    class="ms-3 bg-teal-700"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="createUser"
                >
                    Create
                </PrimaryButton>
            </div>
        </div>
    </Modal>
</template>
