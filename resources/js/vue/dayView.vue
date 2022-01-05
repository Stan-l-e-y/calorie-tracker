<template>
    <div
        :class="[
            grey ? 'active' : 'inactive',
            'plusContainer',
            showModal ? 'cursor' : '',
        ]"
        @click="showModal = true"
    >
        <div class="top" v-show="weight">W: {{ weight }}</div>
        <div v-show="calories">C: {{ calories }}</div>
        <font-awesome-icon
            v-show="grey"
            style="color: white"
            class="fa-sm"
            icon="plus"
        />

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
    props: ["weight", "calories", "time", "id", "grey"],
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
.plusContainer {
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
.active {
    --tw-bg-opacity: 1;
    background-color: gray;
    padding: 0.375rem;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 0.25rem;
}
</style>
