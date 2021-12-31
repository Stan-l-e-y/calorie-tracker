require("./bootstrap");

import Alpine from "alpinejs";
import Vue from "vue";
import App from "./vue/app.vue";
import dayView from "./vue/dayView.vue";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faPlus, faTimes } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faPlus, faTimes);

Vue.component("font-awesome-icon", FontAwesomeIcon);

// const app = new Vue({
//     el: "#app",
//     components: { App },
// });

const app = new Vue({
    el: "#app",
    components: { App, dayView },
});

window.Alpine = Alpine;

Alpine.start();
