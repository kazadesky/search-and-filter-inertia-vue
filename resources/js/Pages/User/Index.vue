<template>

    <Head>
        <title>Users</title>
    </Head>
    <div class="container mx-auto py-5 px-12">
        <div class="w-full flex items-center justify-between mb-4">
            <h1 class="text-2xl font-bold">User List</h1>
            <input type="search"
                class="w-1/4 h-12 rounded-lg border-2 outline-none transition duration-300 focus:border-blue-500 px-3"
                v-model="search" placeholder="Search this....">
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">No</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Dibuat</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody v-if="users && users.data.length > 0" class="text-gray-600 text-sm font-light">
                    <tr v-for="(user, index) in users.data" :key="user.id"
                        class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ index + 1 + (users.current_page - 1) * users.per_page }}.</td>
                        <td class="py-3 px-6">{{ user.name }}</td>
                        <td class="py-3 px-6">{{ user.email }}</td>
                        <td class="py-3 px-6">{{ getDate(user.created_at) }}</td>
                        <td class="py-3 px-6 flex items-center space-x-3">
                            <Link class="outline-none transition duration-300 hover:text-blue-500 focus:text-blue-500"
                                method="get" as="button" type="button" href="#">Edit</Link>
                            <Link class="outline-none transition duration-300 hover:text-blue-500 focus:text-blue-500"
                                method="delete" as="button" type="button" href="#">Delete</Link>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center text-gray-600">Data tidak ditemukan.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div>
            <Pagination :paginator="users" />
        </div>
    </div>
</template>

<script setup>
import { computed, ref, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { debounce } from 'lodash';
import Pagination from '../../Components/Pagination.vue';

const users = computed(() => usePage().props.users);

const props = defineProps({
    searchTerm: String,
});

const getDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID", {
        year: "numeric",
        month: "long",
        day: "numeric"
    });
};

const search = ref(props.searchTerm);

watch(
    search,
    debounce((query) => {
        router.get("/", { search: query }, { preserveState: true });
    }, 500)
);

</script>
