<template>
    <div
        class="container"
        :class="[
            isActive ? 'active' : 'inactive',
            'plusContainer',
            showModal ? 'cursor' : '',
        ]"
        @click="showModal = true"
    >
        <div class="top">W: {{ weight }}</div>
        <div>C: {{ calories }}</div>

        <day-view-pop-up
            :weight="weight"
            :calories="calories"
            :time="time"
            :id="id"
            v-if="showModal"
            @close="showModal = false"
        ></day-view-pop-up>
    </div>
</template>
<script>
import dayViewPopUp from "./dayViewPopUp.vue";
export default {
    props: ["weight", "calories", "time", "id"],
    data() {
        return {
            showModal: false,
            isActive: true,
        };
    },
    components: {
        dayViewPopUp,
    },
};
</script>

<style scoped>
.container {
    display: flex;
    flex-direction: column;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}
.top {
    margin-bottom: 0.5rem;
}
.cursor {
    cursor: default;
    color: white;
}
</style>
