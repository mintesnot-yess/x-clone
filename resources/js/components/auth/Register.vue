<template>
    <div class="form-container">
        <form @submit.prevent="registerUser" method="post" class="modal-wrapper">
            <div class="modal-logo">
                <img src="img/x-twitter.svg" alt="X logo white" width="32" height="32" style="filter: invert(1);" />
            </div>
            <h1 id="signin-title">Sign up to X-Clone</h1>

            <!-- Name Input -->
            <div class="input-group">
                <input v-model="FormData.name" name="name" id="name" class="input-field" type="text"
                    placeholder="User Name" :class="{ 'error-input': errors.name }" />
                <span class="error-message" v-if="errors.name">{{ errors.name[0] }}</span>
            </div>

            <!-- Email Input -->
            <div class="input-group">
                <input v-model="FormData.email" type="email" name="email" id="email" class="input-field"
                    placeholder="Email" :class="{ 'error-input': errors.email }" />
                <span class="error-message" v-if="errors.email">{{ errors.email[0] }}</span>
            </div>

            <!-- Password Input -->
            <div class="input-group">
                <input v-model="FormData.password" name="password" id="password" class="input-field" type="password"
                    placeholder="Password" :class="{ 'error-input': errors.password }" />
                <span class="error-message" v-if="errors.password">{{ errors.password[0] }}</span>
            </div>

            <!-- Password Confirmation Input -->
            <div class="input-group">
                <input v-model="FormData.password_confirmation" name="password_confirmation" id="password_confirmation"
                    class="input-field" type="password" placeholder="Confirm Password" />
            </div>

            <!-- General Error Message -->
            <div class="error-message general-error" v-if="generalError">
                {{ generalError }}
            </div>

            <button class="btn-next" type="submit">Register</button>

            <p class="signup-text">
                Already have an account? <router-link to="login">Sign in</router-link>
            </p>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            FormData: {
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            errors: {
                name: null,
                email: null,
                password: null
            },
            generalError: ''
        }
    },
    methods: {
        async registerUser() {
            // Reset errors
            this.errors = {
                name: null,
                email: null,
                password: null
            };
            this.generalError = '';

            try {
                const response = await axios.post('api/register', this.FormData);

                const { token, user } = response.data;
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user));

                this.$router.push('/');
                window.location.href = '/';


            } catch (error) {
                if (error.response) {
                    // Handle validation errors
                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                    // Handle other API errors
                    else {
                        this.generalError = error.response.data.message || 'Registration failed. Please try again.';
                    }
                } else {
                    this.generalError = 'Network error. Please check your connection.';
                }
            }
        }
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.$router.push('/');
        }
    }
}
</script>

<style scoped>
.input-group {
    margin-bottom: 1rem;
    position: relative;
}

.error-message {
    color: #ff991d;
    font-size: 0.8rem;
    margin-top: 0.25rem;
    display: block;
}

.general-error {
    margin-bottom: 1rem;
    text-align: center;
}

.error-input {
    border-color: #ff991d !important;
}
</style>