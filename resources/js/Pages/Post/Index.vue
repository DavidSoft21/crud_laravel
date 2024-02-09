<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    posts: {
        type: Object,
        default: () => ({}),
    },
    can: {
        type: Object,
        default: () => ({}),
    },
});
//showModalPost
</script>

<template>
    <div>
        <Head title="Posts" />

        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
                    Post
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
                                Posts Settings Page! Here you can list, create,
                                update or delete post!
                            </div>
                            <div
                                class="flex space-x-2 items-center"
                                v-if="can.create"
                            >
                                <a
                                    @click.prevent="showModalPost"
                                    href="#"
                                    class="px-4 py-2 bg-teal-700 hover:bg-teal-900 uppercase text-white rounded focus:outline-none flex items-center"
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
                                    <th scope="col" class="py-3 px-6">Title</th>
                                    <th scope="col" class="py-3 px-6">
                                        Description
                                    </th>
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
                                    v-for="post in posts.data"
                                    :key="post.id"
                                    class="bg-white border-b dark:bg-indigo-200 dark:border-indigo-400 dark:text-gray-700"
                                >
                                    <td data-label="Title" class="py-4 px-6">
                                        {{ post.title }}
                                    </td>
                                    <td
                                        data-label="Description"
                                        class="py-4 px-6"
                                    >
                                        {{ post.description }}
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
