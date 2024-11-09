<template>
    <form @submit.prevent="handleSubmit">
        <div class="form-group" v-if="formData.id">
            <label for="id">ID</label>
            <input
                type="text"
                class="form-control"
                id="id"
                v-model="formData.id"
                disabled
            />
        </div>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input
                type="text"
                class="form-control"
                id="nome"
                v-model="formData.nome"
                :disabled="isViewMode"
                required
            />
        </div>

        <div class="form-group">
            <label for="cpf">CPF/CNPJ</label>
            <input
                type="text"
                class="form-control"
                id="cpf"
                v-model="formData.cpf"
                :disabled="isViewMode"
                required
            />
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                v-model="formData.email"
                :disabled="isViewMode"
                required
            />
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input
                type="text"
                class="form-control"
                id="telefone"
                maxlength="14"
                v-model="formData.telefone"
                v-mask="'(##)#####-####'"
                :disabled="isViewMode"
                required
            />
        </div>

        <button type="submit" class="btn btn-primary" v-if="!isViewMode">
            Salvar
        </button>
    </form>
</template>

<script>
import { mask } from "v-mask";
export default {
    props: {
        person: {
            type: Object,
            default: () => ({
                id: null,
                nome: "",
                cpf: "",
                email: "",
                telefone: "",
            }),
        },
        isViewMode: {
            type: Boolean,
            default: false,
        },
    },
    directives: {
        mask,
    },
    data() {
        return {
            formData: { ...this.person },
        };
    },
    methods: {
        async handleSubmit() {
            const param = this.getParamsRequest();
            const request = this.formData.id
                ? this.$axios.put(`/pessoa/${this.formData.id}`, param)
                : this.$axios.post("/pessoa", param);

            await request
                .then(() => this.$emit("success"))
                .catch((error) =>
                    alert(
                        "Erro ao salvar os dados: " +
                            error?.response?.data?.message
                    )
                );
        },
        getTipo() {
            switch (this.formData.cpf.length) {
                case 14:
                    return 1;
                case 18:
                    return 2;
            }
        },
        getParamsRequest() {
            return {
                ...this.formData,
                tipo: this.getTipo(),
                cpf: this.formData.cpf.replace(/\D/g, ""),
            };
        },
    },
};
</script>
