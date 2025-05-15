<script setup>
    import {Link, useForm } from '@inertiajs/vue3';

    const form = useForm({
        email_or_username: '',
        password: '',
        remember: false,
    });
    const submit = () => {
        form.post(route('login'));
    };


</script>

<template>
    <div class="login-wrapper">
        <h1 class="login-title">LOG IN</h1>

        <form @submit.prevent="submit" class="login-form">
            <!-- Email Input -->
            <div class="input-group">
                <label for="email_or_username" class="label">Email or Username</label>
                <input
                    id="email_or_username"
                    type="text"
                    v-model="form.email_or_username"
                    class="input"
                    required
                    autofocus
                />
                <p v-if="form.errors.email_or_username" class="error">{{ form.errors.email_or_username }}</p>
            </div>

            <!-- Password Input -->
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    type="password"
                    v-model="form.password"
                    class="input"
                    required
                    />
                <p v-if="form.errors.password" class="error">{{ form.errors.password }}</p>
            </div>

            <!-- Submit Button -->
            <div class="form-actions">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="submit-button"
                >
                LOG IN
                </button>

                    <!-- <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="forgot-password"
                    >
                        Forgot your password?
                    </Link> -->
            </div>
                
            <div class="checkbox-group">
                    <!-- <div>
                        <input id="remember" type="checkbox" v-model="form.remember" class="checkbox"/>
                        <label class="label">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">
                                    Remember me
                                </span>
                        </label>
                    </div> -->


                <Link
                    :href="route('register')"
                    class="register"
                >
                    Don't have an account?
                </Link>
            </div>
        </form>
    </div>
</template>

<script>
    import AuthentificationLayout from '../../Layouts/AuthentificationLayout.vue';

    export default {
        layout: AuthentificationLayout,
    }
</script>

<style scoped>

    .logo{
        font-weight: 600;
        font-size: 35px;
        color: #000000;
        position: absolute;
        top: 0;
        left: 0;
        margin: 10px;
        margin-left: 20px;
    }

    .background {
        background-image: url('/images/background-food4.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh; 
        width: 100vw;  
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 30px;
        box-sizing: border-box;
    }

    /* .login-wrapper {
        background-color: #fcfcfc;
        opacity: 0.9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
    } */

    .login-title {
        color: #000000;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .login-form {
        display: flex;
        flex-direction: column;
    }

    .input-group {
        margin-bottom: 16px;
    }

    .label {
        font-size: 14px;
        color: #333;
        margin-left: 0;
    }

    .input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        font-size: 14px;
    }

    .error {
        font-size: 12px;
        color: red;
        margin-top: 4px;
    }

    .form-actions{
        margin-bottom: 15px;
    }

    .checkbox-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .submit-button {
        background-color: #f44040;
        color: white;
        padding: 10px 20px;
        width: 100%;
        border-radius: 2px;
        border: none;
        cursor: pointer;
    }

    .submit-button:disabled {
        background-color: #aaa;
        cursor: not-allowed;
    }

    .forgot-password {
        font-size: 14px;
        color: #3490dc;
        text-decoration: none;
    }

    .forgot-password:hover {
        text-decoration: underline;
    }

    .register{
        border-radius: 0.375rem; /* rounded-md */
        font-size: 0.875rem; /* text-sm */
        color: #4b5563; /* text-gray-600 */
        text-decoration: underline; /* underline */
    }

    /* Hover state */
    .register:hover {
        color: #1f2937; /* hover:text-gray-900 */
    }

    /* Focus state */
    .register:focus {
        outline: none; /* focus:outline-none */
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5); /* focus:ring-2 focus:ring-indigo-500 */
        background-color: rgba(99, 102, 241, 0.1); /* focus:ring-offset-2 (light background color) */
    }
</style>


<!-- <script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4 block">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600"
                        >Remember me</span
                    >
                </label>
            </div>

            <div class="mt-4 flex items-center justify-end">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template> -->