<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import { ref, computed } from 'vue';

defineProps({
    affiliates: Object
});

const form = useForm({
    value: 0.0,
    date_commission: '',
    affiliates_id: '',
})

// const selectedValue = ref('');
// const selectOptions = ref([]);
// const selectOptions = computed(() => {
//     affiliates.map(affiliate => ({
//         value: affiliate.id,
//         label: affiliate.name,
//     }))
// })

// Buscar dados do backend ao carregar a página
// onMounted(async () => {
//   try {
//     const response = await axios.get('/api/categories'); // URL da API
//     // Formatar os dados para o select
//     selectOptions.value = response.data.map(category => ({
//       value: category.id,
//       label: category.name,
//     }));
//   } catch (error) {
//     console.error('Erro ao carregar categorias:', error);
//   }
// });
</script>

<template>
    <Head title="Adicionar Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Adicionar Comissão
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <section class="max-w-xl">
                        <form
                            @submit.prevent="form.post(route('commission.store'))"
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
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>
