<template>
    <div>
        <h6>{{ userName }}</h6>
    </div>
</template>

<script>
export default {
    computed: {
        userName() {
            const user = JSON.parse(localStorage.getItem("user"));
            return user ? user.name : "Usuário Desconhecido";
        },
    },
};
</script>
