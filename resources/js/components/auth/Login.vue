<template>
    <div class="form-container">
        <form class="modal-wrapper" @submit.prevent="handleLogin" method="post">
            <div class="modal-logo">
                <img src="img/x-twitter.svg" alt="X logo white" width="32" height="32" style="filter: invert(1);" />
            </div>
            <h1 id="signin-title">Sign in to X-Clone</h1>

            <!-- Email Input with Error Display -->
            <div class="input-group">
                <input class="input-field" type="email" name="email" v-model="FormData.email" id="email"
                    placeholder="Email address" aria-label="Email address" :class="{ 'error-input': errors.email }" />
                <span class="error-message" v-if="errors.email">{{ errors.email[0] }}</span>
            </div>

            <!-- Password Input with Error Display -->
            <div class="input-group">
                <input class="input-field" type="password" name="password" id="password" v-model="FormData.password"
                    placeholder="Password" aria-label="Password" :class="{ 'error-input': errors.password }" />
                <span class="error-message" v-if="errors.password">{{ errors.password[0] }}</span>
            </div>

            <!-- General Error Message -->
            <div class="error-message general-error" v-if="generalError">
                {{ generalError }}
            </div>

            <button class="btn-next" type="submit">Login</button>

            <p class="signup-text">
                Don't have an account?
                <router-link to="register">Sign up</router-link>
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
                email: '',
                password: ''
            },
            errors: {
                email: null,
                password: null
            },
            generalError: ''
        }
    },
    methods: {
        async handleLogin() {
            // Reset errors
            this.errors = {
                email: null,
                password: null
            };
            this.generalError = '';

            try {
                const response = await axios.post('api/login', this.FormData);

                const { token, user } = response.data;
                localStorage.setItem('token', token);
                localStorage.setItem('user', JSON.stringify(user));
                sessionStorage.setItem('token', token);
                sessionStorage.setItem('user', JSON.stringify(user));
                this.$router.push('/');
                window.location.href = '/';

            } catch (error) {
                if (error.response) {
                    // Handle validation errors (422 status)
                    if (error.response.status === 422 && error.response.data.errors) {
                        this.errors = error.response.data.errors;
                    }
                    // Handle invalid credentials (401 status)
                    else if (error.response.status === 401) {
                        this.generalError = error.response.data.message || 'Invalid credentials';
                    }
                    // Handle other API errors
                    else {
                        this.generalError = error.response.data.message || 'An error occurred. Please try again.';
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