<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Usuarios
            </h2>
        </template>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 text-right">
            <button class="bg-emerald-400 text-white p-2 rounded-lg hover:bg-emerald-500">Adicionar usuario</button>
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
                    <tr class="border-b">
                        <td class="py-2">Luiz Henrique</td>
                        <td class="py-2">luiz.amaro90@gmail.com</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">Editar</td>
                    </tr>
                    <tr class="border-b">
                        <td class="py-2">Witchy Woman</td>
                        <td class="py-2">The Eagles</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">Editar</td>
                    </tr>
                    <tr>
                        <td class="py-2">Shining Star</td>
                        <td class="py-2">Earth, Wind, and Fire</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">Editar</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
