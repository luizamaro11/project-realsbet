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
    user: Object
});

const confirmingUserDeletion = ref(false);

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;
};

const deleteUser = () => {
    form.delete(route('users.destroy', {user: user.id}), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => form.errors,
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.clearErrors();
    form.reset();
};

const user = usePage().props.user;

const form = useForm({
    name: user.name,
    email: user.email,
    current_password: '',
    password: '',
    password_confirmation: '',
})

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <Head title="Editar Usuario" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Editar Usuario
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Informações de perfil
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Atualize as informações do perfil e o endereço de e-mail da sua conta.
                            </p>
                        </header>

                        <form
                            @submit.prevent="form.patch(route('users.update', {user: user.id}))"
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
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Atualizar Senha
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Certifique-se de que sua conta esteja usando uma senha longa
                                e aleatória para permanecer segura.
                            </p>
                        </header>

                        <form
                            @submit.prevent="updatePassword"
                            class="mt-6 space-y-6"
                        >
                            <div>
                                <InputLabel for="current_password" value="Senha atual" />

                                <TextInput
                                    id="current_password"
                                    ref="currentPasswordInput"
                                    v-model="form.current_password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="current-password"
                                />

                                <InputError
                                    :message="form.errors.current_password"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <InputLabel for="password" value="Nova senha" />

                                <TextInput
                                    id="password"
                                    ref="passwordInput"
                                    v-model="form.password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError :message="form.errors.password" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel
                                    for="password_confirmation"
                                    value="Confirmar senha"
                                />

                                <TextInput
                                    id="password_confirmation"
                                    v-model="form.password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    autocomplete="new-password"
                                />

                                <InputError
                                    :message="form.errors.password_confirmation"
                                    class="mt-2"
                                />
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
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                Excluir conta
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Depois que sua conta for excluída, todos os seus recursos e dados serão
                                permanentemente excluídos. Antes de excluir sua conta, por favor
                                baixe quaisquer dados ou informações que você deseja reter.
                            </p>
                        </header>

                        <DangerButton @click="confirmUserDeletion">Excluir conta</DangerButton>

                        <Modal :show="confirmingUserDeletion" @close="closeModal">
                            <div class="p-6">
                                <h2
                                    class="text-lg font-medium text-gray-900"
                                >
                                    Tem certeza de que deseja excluir sua conta?
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Depois que sua conta for excluída, todos os seus recursos e dados
                                    serão excluídos permanentemente. Insira sua senha para
                                    confirmar que você deseja excluir sua conta permanentemente.
                                </p>

                                <div class="mt-6 flex justify-end">
                                    <SecondaryButton @click="closeModal">
                                        Cancelar
                                    </SecondaryButton>

                                    <DangerButton
                                        class="ms-3"
                                        :class="{ 'opacity-25': form.processing }"
                                        :disabled="form.processing"
                                        @click="deleteUser"
                                    >
                                        Excluir conta
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
