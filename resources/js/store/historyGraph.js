import fetchGraphData from "../plugins/fetchGraphData";

const state = {
  date: "now",
  monthly: {},
  experienced: {},
  skill: {},
  medium: {},
  isLoaded: false
};

const mutations = {
  setIsLoaded(state, flag) {
    state.isLoaded = flag;
  },
  setDate(state, date) {
    state.date = date;
  },
  setMonthly(state, monthly) {
    console.log("setMonthly!!", monthly);
    state.monthly = monthly;
  },
  setExperienced(state, experienced) {
    state.experienced = experienced;
  },
  setSkill(state, skill) {
    state.skill = skill;
  },
  setMedium(state, medium) {
    state.medium = medium;
  }
};

const actions = {
  async register({ commit }, date) {
    commit("setIsLoaded", false);
    console.log("register-date: ", date);
    commit("setDate", date);
    const monthly = await fetchGraphData(date, "monthly");
    const experienced = await fetchGraphData(date, "experienced");
    const skill = await fetchGraphData(date, "skill");
    const medium = await fetchGraphData(date, "medium");
    commit("setMonthly", monthly);
    commit("setExperienced", experienced);
    commit("setSkill", skill);
    commit("setMedium", medium);
    console.log("action!!!!!");
    commit("setIsLoaded", true);
  }
};

export default {
  state,
  mutations,
  actions
};
