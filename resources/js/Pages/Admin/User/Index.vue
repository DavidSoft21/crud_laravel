<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CreateUserModal from "./Partials/CreateUserModal.vue";
import { nextTick, ref } from "vue";

const showModal = ref(false);
const showModalUser = () => {
    showModal.value = true;

    // nextTick(() => passwordInput.value.focus());
};

const closeModal = () => {
    showModal.value = false;
    // nextTick(() => passwordInput.value.focus());
};

const props = defineProps({
    users: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div>
        <Head title="Users" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
                    Users
                </h2>
            </template>

            <div class="py-12">
                <!-- <div
                    v-if="Object.keys($page.props.errors).length > 0"
                    class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5"
                >
                    <div
                        class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                        role="alert"
                        v-for="(error, index) in $page.props.errors"
                        :key="index"
                    >
                        <strong class="font-bold">Error! </strong>
                        <span class="block sm:inline">{{ error }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg
                                class="fill-current h-6 w-6 text-red-500"
                                role="button"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <title>Close</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                                ></path>
                            </svg>
                        </span>
                    </div>
                </div> -->
                <transition name="slide-fade">
                    <div
                        v-if="$page.props.flash.success"
                        class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5"
                    >
                        <div
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                            role="alert"
                        >
                            <strong class="font-bold">¡Éxito! </strong>
                            <span class="block sm:inline">{{
                                $page.props.flash.success
                            }}</span>
                            <span
                                class="absolute top-0 bottom-0 right-0 px-4 py-3"
                            >
                                <svg
                                    class="fill-current h-6 w-6 text-green-500"
                                    role="button"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                >
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                                    ></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </transition>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div
                            class="flex bg-indigo-500 justify-between items-center p-5"
                        >
                            <div class="flex space-x-2 items-center text-white">
                                Users Settings Page! Here you can list, create,
                                update or delete user!
                            </div>
                            <div
                                class="flex space-x-2 items-center"
                                v-if="can.create"
                            >
                                <a
                                    @click.prevent="showModalUser"
                                    href="#"
                                    class="px-4 py-2 bg-teal-700 uppercase text-white rounded focus:outline-none flex items-center hover:bg-teal-900"
                                    ><span
                                        class="iconify mr-1"
                                        data-icon="gridicons:create"
                                        data-inline="false"
                                    ></span>
                                    Create
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-white"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-indigo-500 dark:text-white"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">Name</th>
                                    <th scope="col" class="py-3 px-6">Email</th>
                                    <th
                                        v-if="can.edit || can.delete"
                                        scope="col"
                                        class="py-3 px-6"
                                    >
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="user in users.data"
                                    :key="user.id"
                                    class="bg-white border-b dark:bg-indigo-200 dark:border-indigo-400 text-gray-700"
                                >
                                    <td data-label="Name" class="py-4 px-6">
                                        {{ user.name }}
                                    </td>
                                    <td data-label="Email" class="py-4 px-6">
                                        {{ user.email }}
                                    </td>
                                    <td
                                        v-if="can.edit || can.delete"
                                        class="py-4 px-6"
                                    >
                                        <div
                                            class="flex justify-start lg:justify-end"
                                        >
                                            <PrimaryButton
                                                class="ml-4 bg-amber-500 px-2 py-1 rounded text-white cursor-pointer"
                                                v-if="can.edit"
                                            >
                                                Edit
                                            </PrimaryButton>
                                            <PrimaryButton
                                                class="ml-4 bg-rose-700 px-2 py-1 rounded text-white cursor-pointer"
                                                v-if="can.delete"
                                            >
                                                Delete
                                            </PrimaryButton>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <CreateUserModal
                :show="showModal"
                @closeModal="closeModal"
                :maxWidth="'md'"
            />
        </AuthenticatedLayout>
    </div>
</template>

<style scoped>
/* Las animaciones de entrada y salida pueden usar */
/* funciones de espera y duración diferentes.      */
.slide-fade-enter-active {
    transition: all 0.3s ease;
}
.slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>
