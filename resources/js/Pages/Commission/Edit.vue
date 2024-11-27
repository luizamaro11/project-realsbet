<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';

defineProps({
    commission: Object,
    affiliates: Object,
});

const confirmingCommissionDeletion = ref(false);

const confirmCommissionDeletion = () => {
    confirmingCommissionDeletion.value = true;
};

const deleteCommission = () => {
    form.delete(route('commission.destroy', {commission: commission.id}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => form.errors,
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingCommissionDeletion.value = false;

    form.clearErrors();
    form.reset();
};

const commission = usePage().props.commission;

const form = useForm({
    value: commission.value,
    date_commission: commission.date_commission,
    affiliates_id: commission.affiliates_id
})

</script>

<template>
    <Head title="Editar Comissão" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Editar Comissão
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Comissão
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Atualize os dados da comissão.
                            </p>
                        </header>

                        <form
                            @submit.prevent="form.patch(route('commission.update', {commission: commission.id}))"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="value" value="Valor" />

                                <TextInput
                                    id="value"
                                    type="number"
                                    step="0.01"
                                    class="mt-1 block w-full"
                                    v-model="form.value"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.value" />
                            </div>

                            <div>
                                <InputLabel for="date_commission" value="Data da comissão" />

                                <TextInput
                                    id="date_commission"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.date_commission"
                                    required
                                />

                                <InputError class="mt-2" :message="form.errors.date_commission" />
                            </div>

                            <div>
                                <InputLabel for="affiliates_id" value="Afiliados" />

                                <select 
                                    v-model="form.affiliates_id" 
                                    id="affiliates_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    required
                                >
                                    <option value="">Selecione o afiliado</option>
                                    <option v-for="affiliate in affiliates" :value="affiliate.id">
                                        {{ affiliate.name }}
                                    </option>
                                </select>

                                <InputError :message="form.errors.affiliates_id" class="mt-2" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                                <Transition
                                    enter-active-class="transition ease-in-out"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in-out"
                                    leave-to-class="opacity-0"
                                >
                                    <p
                                        v-if="form.recentlySuccessful"
                                        class="text-sm text-gray-600"
                                    >
                                        Salvo.
                                    </p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>

                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <section class="max-w-xl">
                        <DangerButton @click="confirmCommissionDeletion">Excluir comissão</DangerButton>

                        <Modal :show="confirmingCommissionDeletion" @close="closeModal">
                            <div class="p-6">
                                <h2
                                    class="text-lg font-medium text-gray-900"
                                >
                                    Tem certeza de que deseja excluir sua comissão?
                                </h2>

                                <div class="mt-6 flex justify-end">
                                    <SecondaryButton @click="closeModal">
                                        Cancelar
                                    </SecondaryButton>

                                    <DangerButton
                                        class="ms-3"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        @click="deleteCommission"
                                    >
                                        Excluir comissão
                                    </DangerButton>
                                </div>
                            </div>
                        </Modal>
                    </section>
                </div>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
