<template>
    <div class="notifContainer">
        <div class="notif">
            <button class="closeBtn" @click.stop="$emit('close')">Close</button>
            <form class="form" @submit.prevent="editDay(id)">
                <label for="weight">Weight</label>
                <input type="text" v-model="day.weight" />
                <div class="alert" v-if="errors && errors.weight">
                    {{ errors.weight[0] }}
                </div>
                <label for="weight">Calories</label>
                <input type="text" v-model="day.calories" />
                <div class="alert" v-if="errors && errors.calories">
                    {{ errors.calories[0] }}
                </div>
                <button class="editBtn">Edit</button>
            </form>
            <div class="time">{{ time }}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["weight", "calories", "time", "id"],
    data() {
        return {
            day: {
                weight: this.weight,
                calories: this.calories,
                id: this.id,
            },
            errors: {},
        };
    },
    methods: {
        editDay(id) {
            axios
                .put("api/table/" + id, this.day)
                .then((response) => {
                    this.day = {};
                    if (response.status == 200) {
                        this.$emit("close");
                        this.$emit("reload");
                        window.location.reload();
                    }
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.notifContainer {
    position: absolute;
    left: 50px;
    top: 25px;
    background: #c4c4d3;
    width: 83%;
    height: 100%;
    border-radius: 1rem;
    text-align: right;
}
.editBtn {
    --tw-bg-opacity: 1;
    background-color: rgb(34 197 94 / var(--tw-bg-opacity));
    margin-top: 0.75rem;
    margin-bottom: 0.75rem;
    padding: 0.375rem;
    border-radius: 0.25rem;
}
.closeBtn {
    --tw-bg-opacity: 1;
    background-color: rgb(239 68 68 / var(--tw-bg-opacity));
    padding: 0.375rem;
    border-radius: 0.25rem;
    align-self: flex-end;
}

.form {
    display: flex;
    flex-direction: column;
    width: 50%;
    align-items: center;
    justify-content: center;
}
.notif {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.alert {
    color: red;
}
.time {
    font-size: 0.875rem /* 14px */;
    line-height: 1.25rem /* 20px */;
}
</style>
