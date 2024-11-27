<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    commission: Object,
    affiliates: Object,
});

const form = useForm({
    commission_affiliate_id: ''
})
</script>

<template>
    <Head title="Comissões" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Comissões
            </h2>
        </template>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8 flex justify-between">
            <div>
                <form
                    @submit.prevent="form.get(route('commission.index'))"
                    class="mt-6 space-y-6"
                >
                    <div>
                        <InputLabel for="commission_affiliate_id" value="Consultar comissão do afiliado" />

                        <div class="flex items-center gap-4">
                            <select 
                                v-model="form.commission_affiliate_id" 
                                id="commission_affiliate_id"
                                class="mt-1 block rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                                <option value="">Selecione o afiliado</option>
                                <option v-for="affiliate in affiliates" :value="affiliate.id">
                                    {{ affiliate.name }}
                                </option>
                            </select>
    
                            <PrimaryButton>Consultar</PrimaryButton>
                        </div>

                        <InputError class="mt-2" :message="form.errors.commssion_affiliate_id" />
                    </div>
                </form>
            </div>

            <div class="flex items-end">
                <Link :href="route('commission.create')" class="bg-emerald-400 text-white p-2 rounded-lg hover:bg-emerald-500">
                    Adicionar Comissão
                </Link>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <table class="table-auto w-full">
                <thead class="text-left border-b">
                    <tr class="">
                        <th>Valor</th>
                        <th>Data da Comissão</th>
                        <th>Afiliado</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="text-gray-500">
                    <tr class="border-b" v-for="com in commission">
                        <td class="py-2">{{ com.value }}</td>
                        <td class="py-2">{{ new Date(com.date_commission).toLocaleDateString('pt-BR') }}</td>
                        <td class="py-2">{{ com.affiliatesName }}</td>
                        <td class="py-2 text-emerald-300 text-right hover:text-emerald-500">
                            <Link :href="route('commission.edit', {'commission': com.id })">
                                Editar
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>
