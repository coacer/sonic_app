import Vue from "vue";
import Vuex from "vuex";
import historyGraph from "./historyGraph";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const store = new Vuex.Store({
  ...historyGraph,
  plugins: [createPersistedState()]
});

export default store;
