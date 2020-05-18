<template>
  <ul class="list-group">
    <li
      @click="addActive"
      class="list-group-item"
      id="bar"
      :class="[active === 'bar' ? 'active' : '', 'list-group-item']"
    >
      棒グラフ
    </li>
    <li
      @click="addActive"
      class="list-group-item"
      id="pie"
      :class="[active === 'pie' ? 'active' : '', 'list-group-item']"
    >
      円グラフ
    </li>
    <li
      @click="addActive"
      class="list-group-item"
      id="line"
      :class="[active === 'line' ? 'active' : '', 'list-group-item']"
    >
      折れ線グラフ
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {
      active: "bar"
    };
  },
  methods: {
    addActive(e) {
      switch (e.currentTarget.id) {
        case "bar":
          this.active = "bar";
          break;
        case "pie":
          this.active = "pie";
          break;
        case "line":
          this.active = "line";
          break;
        default:
          this.active = null;
      }
      this.$emit("changeActive", this.active);
    }
  }
};
</script>

<style lang="scss" scoped>
.list-group {
  width: 11%;
  margin: 30px 20px 0 0;
  > li {
    cursor: pointer;
  }
}
</style>
