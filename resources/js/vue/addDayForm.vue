<template>
    <div class="notifContainer">
        <div class="notif">
            <button class="closeBtn" @click.stop="$emit('close')">Close</button>
            <form class="form" @submit.prevent="addDay()">
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
                {{ timezone }}
                <button class="addBtn">Add</button>
            </form>
        </div>

        <!-- <day-view></day-view> -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            day: {
                user_id: this.user_id,
            },
            errors: {},
            timezone: moment.tz.guess(),
        };
    },

    methods: {
        addDay() {
            axios
                .post("api/table/store", this.day)
                .then((response) => {
                    this.day = {};
                    if (response.status == 201) {
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
    props: ["user_id"],
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
.addBtn {
    --tw-bg-opacity: 1;
    background-color: rgb(34 197 94 / var(--tw-bg-opacity));
    margin-top: 0.75rem;
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
</style>
