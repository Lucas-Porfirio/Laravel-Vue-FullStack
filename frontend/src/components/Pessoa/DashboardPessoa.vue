<template>
    <div class="p-4">
        <h3>Consulta de Pessoas</h3>

        <button @click="openFormModal('add')" class="btn btn-primary mb-3">
            Incluir Pessoa
        </button>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="person in people" :key="person.id">
                    <td>{{ person.id }}</td>
                    <td>{{ person.nome }}</td>
                    <td>{{ person.cpf }}</td>
                    <td>{{ person.email }}</td>
                    <td>{{ person.telefone }}</td>
                    <td>
                        <button
                            @click="openFormModal('view', person)"
                            class="btn btn-info btn-sm mr-1"
                        >
                            Visualizar
                        </button>
                        <button
                            @click="openFormModal('edit', person)"
                            class="btn btn-warning btn-sm mr-1"
                        >
                            Alterar
                        </button>
                        <button
                            @click="deletePerson(person)"
                            class="btn btn-danger btn-sm"
                        >
                            Excluir
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <ModalForm v-if="isModalOpen" :title="modalTitle" @close="closeModal">
            <FormPessoa :person="selectedPerson" :isViewMode="isViewMode" />
        </ModalForm>
    </div>
</template>

<script>
import ModalForm from "../ModalForm.vue";
import FormPessoa from "./FormPessoa.vue";

export default {
    components: {
        ModalForm,
        FormPessoa,
    },
    data() {
        return {
            people: [],
            isModalOpen: false,
            selectedPerson: {},
            modalTitle: "",
            isViewMode: false,
        };
    },
    mounted() {
        this.fetchPeople();
    },
    methods: {
        fetchPeople() {
            this.$axios.get('/pessoa')
                .then(response => {
                    this.people = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar pessoas:', error?.response?.data?.message);
                });
        },
        openFormModal(action, person = null) {
            this.isModalOpen = true;
            this.selectedPerson = person || {
                id: "",
                nome: "",
                cpf: "",
                email: "",
                telefone: "",
            };
            switch (action) {
                case "add":
                    this.modalTitle = "Incluir Pessoa";
                    this.isViewMode = false;
                    break;
                case "edit":
                    this.modalTitle = "Alterar Pessoa";
                    this.isViewMode = false;
                    break;
                case "view":
                    this.modalTitle = "Visualizar Pessoa";
                    this.isViewMode = true;
                    break;
            }
        },
        closeModal() {
            this.isModalOpen = false;
        },
        deletePerson(person) {
            if (confirm(`Tem certeza que deseja excluir ${person.nome}?`)) {
                this.$axios.delete(`/pessoa/${person.id}`).then(() => this.fetchPeople()).catch(() => this.fetchPeople());
            }
        },
    },
};
</script>
