<template>
    <div
        class="modal fade"
        tabindex="-1"
        role="dialog"
        :class="{ show: isVisible }"
        style="display: block"
    >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ title }}</h5>
                    <button
                        type="button"
                        class="close"
                        @click="closeModal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <slot></slot>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        @click="closeModal"
                    >
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: "Título do Modal",
        },
    },
    data() {
        return {
            isVisible: true,
        };
    },
    methods: {
        closeModal() {
            this.isVisible = false;
            this.$emit("close");
        },
    },
};
</script>

<style scoped>
.modal.show {
    display: block;
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
