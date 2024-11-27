<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    affiliates: Object,
});
</script>

<template>
    <Head title="Afiliados" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Afiliados
            </h2>
        </template>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-right">
            <Link :href="route('affiliates.create')" class="bg-emerald-400 text-white p-2 rounded-lg hover:bg-emerald-500">
                Adicionar afiliado
            </Link>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <table class="table-auto w-full">
                <thead class="text-left border-b">
                    <tr class="">
                        <th>Nome</th>
                        <th>Data de nascimento</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    <tr class="border-b" v-for="affiliate in affiliates">
                        <td class="py-2">{{ affiliate.name }}</td>
                        <td class="py-2">{{ new Date(affiliate.date_birth).toLocaleDateString('pt-BR') }}</td>
                        <td class="py-2">{{ affiliate.email }}</td>
                        <td class="py-2">{{ affiliate.phone }}</td>
                        <td class="py-2">{{ affiliate.address }}</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">
                            <Link :href="route('affiliates.edit', {'affiliate': affiliate.id })">
                                Editar
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
