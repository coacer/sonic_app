<template>
  <div>
    <template v-if="sending">
      <div class="spinner-box">
        <Spinner />
      </div>
    </template>
    <template v-else>
      <button @click="snapshot" class="btn btn-danger">
        スナップショットを撮る
      </button>
    </template>
  </div>
</template>

<script>
import fetchGraphData from "../plugins/fetchGraphData";
import Spinner from "vue-simple-spinner";

export default {
  components: {
    Spinner
  },
  data() {
    return {
      sending: false
    };
  },
  methods: {
    async snapshot() {
      this.sending = true;
      const monthlyData = await fetchGraphData("now", "monthly");
      const experiencedData = await fetchGraphData("now", "experienced");
      const skillData = await fetchGraphData("now", "skill");
      const mediumData = await fetchGraphData("now", "medium");
      const now = Date.now();

      console.log(monthlyData);
      console.log(monthlyData.month);
      console.log(monthlyData.count);

      const params = {
        date: now,
        monthly: monthlyData,
        experienced: experiencedData,
        skill: skillData,
        medium: mediumData
      };

      const endpoint = "http://lambda-api";
      const res = await axios.post(endpoint, params);
      this.$emit("snap");
      console.log("params", params);
      console.log("params", res.status);
      console.log("data", res.data);
      this.sending = false;
    }
  }
};
</script>

<style lang="scss" scoped>
.spinner-box {
  margin-left: 20px;

  > div {
    display: inline-block;
  }
}
</style>
