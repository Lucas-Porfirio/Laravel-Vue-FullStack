<template>
  <div class="container-fluid">
    <div class="row">
      <Sidebar class="col-md-2" />
      <MainContent />
    </div>
  </div>
</template>

<script>
import Sidebar from './SideBar.vue';
import MainContent from './DashboardRoute.vue';

export default {
  components: {
    Sidebar,
    MainContent,
  },
};
</script>

<style>
</style>
