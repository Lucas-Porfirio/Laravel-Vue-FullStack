<template>
    <main class="col-md-10 p-4">
        <DashboardPessoa />
    </main>
</template>

<script>
import DashboardPessoa from "./Pessoa/DashboardPessoa.vue";

export default {
    name: "MainContent",
    components: {
        DashboardPessoa,
    },
};
</script>
