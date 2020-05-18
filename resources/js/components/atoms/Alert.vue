<template>
  <transition>
    <div v-show="show" class="alert alert-success" role="alert">
      <slot></slot>
    </div>
  </transition>
</template>

<script>
export default {
  data() {
    return {
      show: false
    };
  },
  methods: {
    showAlert() {
      this.show = true;
      setTimeout(() => (this.show = false), 4000);
    }
  }
};
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s;
}
.v-enter, .v-leave-to /* .v-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
