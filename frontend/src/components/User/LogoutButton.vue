<template>
    <button @click="handleLogout" class="btn btn-outline-secondary btn-sm">
        Logout
    </button>
</template>

<script>
export default {
    methods: {
        handleLogout() {
            this.$axios
                .post("/logout")
                .then(() => {
                    localStorage.removeItem("token");
                    localStorage.removeItem("user");
                    this.$router.push("/login");
                })
                .catch(() => {this.$router.push("/login");});
        },
    },
};
</script>
