<script>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthentificationLayout from '../../Layouts/AuthentificationLayout.vue'

export default {
  layout: AuthentificationLayout,

  components: {
    Head,
    Link,
  },

  data() {
    return {
      form: useForm({
        username: '',
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      }),
    }
  },

  methods: {
    submit() {
      this.form.post(route('register'), {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    },
  },
}
</script>


<template>
            <h1 class="register-title">REGISTER</h1>

            <!-- Form Section -->
            <form @submit.prevent="submit" class="register-form">
                <div class="input-group">
                    <label for="username" class="label">Username</label>
                    <input
                        id="username"
                        type="text"
                        v-model="form.username"
                        class="input"
                        required
                        autofocus
                    />
                    <p v-if="form.errors.username" class="error">{{ form.errors.username }}</p>
                </div>

                <!-- Email Input -->
                <div class="input-group">
                    <label for="email" class="label">Email</label>
                    <input
                        id="email"
                        type="text"
                        v-model="form.email"
                        class="input"
                        required
                    />
                    <p v-if="form.errors.email" class="error">{{ form.errors.email }}</p>
                </div>

                <!-- Name Input -->
                <div class="input-group">
                    <label for="name" class="label">Name</label>
                    <input
                        id="name"
                        type="text"
                        v-model="form.name"
                        class="input"
                        required
                        autofocus
                    />
                    <p v-if="form.errors.name" class="error">{{ form.errors.name }}</p>
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

                <!-- Confirm Password Input -->
                <div class="input-group">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        class="input"
                        required
                    />
                    <p v-if="form.errors.password_confirmation" class="error">{{ form.errors.password_confirmation }}</p>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button
                    type="submit"
                    :disabled="form.processing"
                    class="submit-button"
                >
                        REGISTER
                    </button>
                </div>

                <!-- Link to Login page -->
                <div class="form-actions">
                    <Link :href="route('login')" class="go-to-login">
                        Already registered?
                    </Link>
                </div>
            </form>
</template>

<style scoped>
    .logo {
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

    /* .register-wrapper {
        background-color: #fcfcfc;
        opacity: 0.9;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
    } */

    .register-title {
        color: #000;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .register-form {
        display: flex;
        flex-direction: column;
    }

    .input-group {
        margin-bottom: 7px;
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

    .input:focus {
        border: 1px solid #f44040; 
    }

    .error {
        font-size: 12px;
        color: red;
        margin-top: 4px;
    }

    .form-actions {
        margin-bottom: 15px;
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

    .go-to-login {
        border-radius: 0.375rem;
        font-size: 0.875rem;
        color: #4b5563;
        text-decoration: underline;
    }

    .go-to-login:hover {
        color: #1f2937;
    }

    .go-to-login:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.5);
        background-color: rgba(99, 102, 241, 0.1);
    }
</style>


