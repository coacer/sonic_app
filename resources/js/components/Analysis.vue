<template>
  <div class="graph-container">
    <div class="alert-box">
      <alert ref="alert">スナップショットを撮りました</alert>
    </div>
    <Navigation @changeActive="displayGraph" />
    <SnapshotBtn @snap="handleSnap" />
    <HistoryBtn ref="historyBtn" />
    <div class="graph-wrapper">
      <MonthlyGraph v-if="active === 'monthly'" />
      <ExperiencedGraph v-if="active === 'experienced'" />
      <SkillGraph v-if="active === 'skill'" />
      <MediumGraph v-if="active === 'medium'" />
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Alert from "./atoms/Alert.vue";
import Navigation from "./Navigation.vue";
import SnapshotBtn from "./SnapshotBtn.vue";
import HistoryBtn from "./HistoryBtn.vue";
import MonthlyGraph from "./MonthlyGraph.vue";
import ExperiencedGraph from "./ExperiencedGraph.vue";
import SkillGraph from "./SkillGraph.vue";
import MediumGraph from "./MediumGraph.vue";

export default {
  components: {
    Alert,
    Navigation,
    SnapshotBtn,
    HistoryBtn,
    MonthlyGraph,
    ExperiencedGraph,
    SkillGraph,
    MediumGraph
  },
  data() {
    return {
      active: "monthly"
    };
  },
  created() {
    this.$store.dispatch("register", "now");
  },
  methods: {
    ...mapActions["register"],
    displayGraph(active) {
      this.active = active;
    },
    handleSnap() {
      this.$refs.historyBtn.fetchHistories();
      this.$refs.alert.showAlert();
    }
  }
};
</script>

<style>
.graph-container {
  width: 80%;
  margin: 50px auto;
}

.graph-wrapper {
  position: relative;
  height: 400px;
}

.spinner {
  width: 100%;
  margin-top: 160px;
}

.alert-box {
  height: 60px;
}
</style>
