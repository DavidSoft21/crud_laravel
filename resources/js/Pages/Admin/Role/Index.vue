<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
});
//showModalRole
</script>

<template>
    <div>
        <Head title="Roles" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
                    Roles
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">
                    <div
                        class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    >
                        <div
                            class="flex bg-indigo-500 justify-between items-center p-5"
                        >
                            <div class="flex space-x-2 items-center text-white">
                                Roles Settings Page! Here you can list, create,
                                update or delete rol!
                            </div>
                            <div
                                class="flex space-x-2 items-center"
                                v-if="can.create"
                            >
                                <a
                                    @click.prevent="showModalRole"
                                    href="#"
                                    class="px-4 py-2 hover:bg-teal-900 bg-teal-700 uppercase text-white rounded focus:outline-none flex items-center"
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
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-indigo-500 dark:text-white"
                            >
                                <tr>
                                    <th scope="col" class="py-3 px-6">ID</th>
                                    <th scope="col" class="py-3 px-6">Name</th>
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
                                    v-for="rol in roles.data"
                                    :key="rol.id"
                                    class="bg-white border-b dark:bg-indigo-200 dark:border-indigo-400 dark:text-gray-700 hover:bg-gray-100 dark:hover:bg-indigo-100"
                                >
                                    <td data-label="ID" class="py-4 px-6">
                                        {{ rol.id }}
                                    </td>
                                    <td data-label="Name" class="py-4 px-6">
                                        {{ rol.name }}
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
        </AuthenticatedLayout>
    </div>
</template>
