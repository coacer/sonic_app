<template>
  <div class="history-box">
    <div class="btn-group">
      <button
        type="button"
        class="btn btn-secondary dropdown-toggle"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        ヒストリー
      </button>
      <div class="dropdown-menu dropdown-menu-right">
        <button
          v-for="dateKey in dateKeys"
          :key="dateKey"
          @click="handleClick"
          :id="dateKey"
          :class="['dropdown-item', active == dateKey ? 'active' : '']"
          type="button"
        >
          {{ dateKey | convFormatDate }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import fetchGraphData from "../plugins/fetchGraphData";
import { mapMutations } from "vuex";

export default {
  data() {
    return {
      dateKeys: [],
      active: "now"
    };
  },
  created() {
    this.fetchHistories();
  },
  methods: {
    ...mapMutations["setDate"],
    handleClick(e) {
      const id = e.currentTarget.id;
      this.active = id;
      const date = id !== "now" ? parseInt(id) : id;
      this.$store.dispatch("register", date);
      console.log("store data: ", this.$store.state.date);
    },
    async fetchHistories() {
      const { data } = await axios.get("https://lambda-api");
      console.log(data);
      this.dateKeys = data.map(record => record.date).sort();
      this.dateKeys.unshift("now");
      console.log(this.dateKeys);
    }
  },
  filters: {
    convFormatDate(value) {
      if (value === "now") return "現在";
      const date = new Date(value);
      const year = date.getFullYear();
      const month = date.getMonth();
      const day = date.getDate();
      const hour = date.getHours();
      const min = date.getMinutes();
      return `${year}/${month}/${day}  ${hour}:${min}`;
    }
  }
};
</script>

<style scoped>
.history-box {
  margin-top: 20px;
}
</style>
