<template>
  <div class="local-graph-wrapper">
    <SideNavigation @changeActive="displayGraph" />
    <template v-if="isLoaded">
      <BarGraph
        v-if="active === 'bar'"
        label="人数"
        :labels="skill.skill_types"
        :graphData="skill.totals"
        style="width: 100%"
      />
      <PieGraph
        v-if="active === 'pie'"
        :labels="skill.skill_types"
        :graphData="skill.totals"
        style="width: 100%"
      />
      <LineGraph
        v-if="active === 'line'"
        label="人数"
        :labels="skill.skill_types"
        :graphData="skill.totals"
        style="width: 100%"
      />
    </template>
    <template v-else>
      <div class="spinner">
        <Spinner />
      </div>
    </template>
  </div>
</template>

<script>
import SideNavigation from "./SideNavigation.vue";
import BarGraph from "./graphs/BarGraph.vue";
import PieGraph from "./graphs/PieGraph.vue";
import LineGraph from "./graphs/LineGraph.vue";
import Spinner from "vue-simple-spinner";
import fetchGraphData from "../plugins/fetchGraphData";
import { mapState } from "vuex";

export default {
  components: {
    SideNavigation,
    BarGraph,
    PieGraph,
    LineGraph,
    Spinner
  },
  data() {
    return {
      active: "bar"
    };
  },
  methods: {
    displayGraph(active) {
      this.active = active;
    }
  },
  computed: {
    ...mapState(["skill", "isLoaded"])
  }
};
</script>

<style scoped>
.local-graph-wrapper {
  display: flex;
}
</style>
