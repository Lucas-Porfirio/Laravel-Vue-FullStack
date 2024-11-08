<template>
    <div
        class="login-container d-flex justify-content-center align-items-center vh-100"
    >
        <div class="card p-4 shadow" style="width: 400px">
            <h3 class="text-center mb-4">Login</h3>

            <div v-if="error" class="alert alert-danger" role="alert">
                {{ error }}
            </div>

            <form @submit.prevent="handleLogin">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        type="email"
                        id="email"
                        class="form-control"
                        v-model="form.email"
                        required
                    />
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input
                        type="password"
                        id="password"
                        class="form-control"
                        v-model="form.password"
                        required
                    />
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Login
                </button>
            </form>

            <p class="text-center mt-3">
                Não tem uma conta?
                <router-link to="/register">Registre-se</router-link>
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            },
            error: null,
        };
    },
    methods: {
        async handleLogin() {
            try {
                this.error = null;
                const response = await this.$axios.post("/login", this.form);
                localStorage.setItem("token", response.data.token);
                this.$router.push("/");
            } catch (error) {
                this.error =
                    error.response?.data?.message || "Erro ao fazer login.";
            }
        },
    },
};
</script>

<style scoped>
.login-container {
    background-color: #f8f9fa;
}
</style>
