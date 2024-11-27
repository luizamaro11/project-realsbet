<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    users: Object,
    flash: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Usuarios
            </h2>
        </template>

        <div v-if="flash?.success" class="mx-auto max-w-7xl my-4 px-4 py-4 sm:px-6 lg:px-6 border rounded-lg border-emerald-400">
            {{ flash.success }}
        </div>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-right">
            <Link :href="route('users.create')" class="bg-emerald-400 text-white p-2 rounded-lg hover:bg-emerald-500">
                Adicionar usuario
            </Link>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <table class="table-auto w-full">
                <thead class="text-left border-b">
                    <tr class="">
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    <tr class="border-b" v-for="user in users">
                        <td class="py-2">{{ user.name }}</td>
                        <td class="py-2">{{ user.email }}</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">
                            <Link :href="route('users.edit', {'user': user.id })">
                                Editar
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
