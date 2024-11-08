<template>
  <div class="register-container d-flex justify-content-center align-items-center vh-100">
      <div class="card p-4 shadow" style="width: 400px">
          <h3 class="text-center mb-4">Cadastro</h3>

          <div v-if="errors.length" class="alert alert-danger" role="alert">
              <ul>
                  <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
              </ul>
          </div>

          <form @submit.prevent="handleSubmit">
              <div class="mb-3">
                  <label for="name" class="form-label">Nome</label>
                  <input
                      type="text"
                      id="name"
                      class="form-control"
                      v-model="name"
                      placeholder="Digite seu nome"
                      required
                  />
              </div>

              <div class="mb-3">
                  <label for="email" class="form-label">E-mail</label>
                  <input
                      type="email"
                      id="email"
                      class="form-control"
                      v-model="email"
                      placeholder="Digite seu e-mail"
                      required
                  />
              </div>

              <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input
                      type="password"
                      id="password"
                      class="form-control"
                      v-model="password"
                      placeholder="Digite sua senha"
                      required
                  />
              </div>

              <div class="mb-3">
                  <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                  <input
                      type="password"
                      id="password_confirmation"
                      class="form-control"
                      v-model="passwordConfirmation"
                      placeholder="Confirme sua senha"
                      required
                  />
              </div>

              <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
          </form>

          <p class="text-center mt-3">
              Já tem uma conta?
              <router-link to="/login">Faça login</router-link>
          </p>
      </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
          name: "",
          email: "",
          password: "",
          passwordConfirmation: "",
          errors: [],
      };
  },
  methods: {
      async handleSubmit() {
          this.errors = [];

          if (this.password !== this.passwordConfirmation) {
              this.errors.push("As senhas não coincidem.");
              return;
          }

          try {
              const response = await this.$axios.post("/register", {
                  name: this.name,
                  email: this.email,
                  password: this.password,
                  password_confirmation: this.passwordConfirmation,
              });

              localStorage.setItem("token", response.data.token);
              this.$router.push("/login");
          } catch (error) {
              if (error.response && error.response.data.errors) {
                  this.errors = Object.values(error.response.data.errors).flat();
              } else {
                  this.errors.push("Ocorreu um erro, tente novamente.");
              }
          }
      },
  },
};
</script>

<style scoped>
.register-container {
  background-color: #f8f9fa;
}

.card {
  max-width: 400px;
  width: 100%;
}

h3 {
  text-align: center;
}

.error {
  color: red;
}

form {
  margin-top: 20px;
}
</style>
