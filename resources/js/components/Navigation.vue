<template>
  <nav class="nav nav-pills flex-column flex-sm-row">
    <a
      @click.prevent="addActive"
      id="monthly"
      :class="[
        active === 'monthly' ? 'active' : '',
        'flex-sm-fill',
        'text-sm-center',
        'nav-link'
      ]"
    >
      月ごとの応募数
    </a>
    <a
      @click.prevent="addActive"
      id="experienced"
      :class="[
        active === 'experienced' ? 'active' : '',
        'flex-sm-fill',
        'text-sm-center',
        'nav-link'
      ]"
    >
      プログラム経験有無
    </a>
    <a
      @click.prevent="addActive"
      id="skill"
      :class="[
        active === 'skill' ? 'active' : '',
        'flex-sm-fill',
        'text-sm-center',
        'nav-link'
      ]"
    >
      経験技術
    </a>
    <a
      @click.prevent="addActive"
      id="medium"
      :class="[
        active === 'medium' ? 'active' : '',
        'flex-sm-fill',
        'text-sm-center',
        'nav-link'
      ]"
    >
      媒体
    </a>
  </nav>
</template>

<script>
export default {
  data() {
    return {
      active: "monthly"
    };
  },
  methods: {
    addActive(e) {
      switch (e.currentTarget.id) {
        case "monthly":
          this.active = "monthly";
          break;
        case "experienced":
          this.active = "experienced";
          break;
        case "skill":
          this.active = "skill";
          break;
        case "medium":
          this.active = "medium";
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
nav {
  margin-bottom: 30px;
  > a {
    cursor: pointer;
  }
}
</style>
