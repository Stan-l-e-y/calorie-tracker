<template>
    <div
        :class="[
            isActive ? 'active' : 'inactive',
            'plusContainer',
            showModal ? 'cursor' : '',
        ]"
        @click="showModal = true"
    >
        <font-awesome-icon style="color: white" class="fa-sm" icon="plus" />

        <add-day-form
            :user_id="user_id"
            v-if="showModal"
            @close="(showModal = false), weed()"
            @reload="$emit((hey = true))"
        />
    </div>
</template>

<script>
import addDayForm from "./addDayForm.vue";
export default {
    components: {
        addDayForm,
    },
    data() {
        return {
            showModal: false,
            isActive: true,
        };
    },
    props: ["user_id"],
    methods: {
        weed() {
            // window.history.go();
            // location.reload();
            // location.reload();
            // location.reload();
        },
    },
};
</script>

<style scoped>
.plusContainer {
    padding: 0.375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 0.25rem;
}
.active {
    --tw-bg-opacity: 1;
    background-color: rgb(34 197 94 / var(--tw-bg-opacity));
}
.inactive {
    --tw-bg-opacity: 1;
    background-color: rgb(156 163 175 / var(--tw-bg-opacity));
}
.cursor {
    cursor: default;
}
</style>
