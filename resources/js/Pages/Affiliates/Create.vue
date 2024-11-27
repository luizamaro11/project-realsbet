<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const form = useForm({
    name: '',
    date_birth: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    state: '',
})
</script>

<template>
    <Head title="Adicionar Afiliado" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Adicionar Afiliado
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <section class="max-w-xl">
                        <form
                            @submit.prevent="form.post(route('affiliates.store'))"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="name" value="Nome" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="date_birth" value="Data de nascimento" />

                                <TextInput
                                    id="date_birth"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.date_birth"
                                    required
                                    autofocus
                                    autocomplete="bday"
                                />

                                <InputError class="mt-2" :message="form.errors.date_birth" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Telefone" />

                                <TextInput
                                    id="phone"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.phone"
                                    required
                                    autocomplete="tel"
                                />

                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div>
                                <InputLabel for="address" value="Endereço" />

                                <TextInput
                                    id="address"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.address"
                                    required
                                    autocomplete="street-address"
                                />

                                <InputError class="mt-2" :message="form.errors.address" />
                            </div>

                            <div>
                                <InputLabel for="city" value="Cidade" />

                                <TextInput
                                    id="city"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.city"
                                    required
                                    autocomplete="street-address"
                                />

                                <InputError class="mt-2" :message="form.errors.city" />
                            </div>

                            <div>
                                <InputLabel for="state" value="Estado" />

                                <TextInput
                                    id="state"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.state"
                                    required
                                    autocomplete="street-address"
                                />

                                <InputError class="mt-2" :message="form.errors.state" />
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
