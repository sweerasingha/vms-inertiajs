<template>
  <div class="app-container">
    <Head :title="title || 'VMS'">
      <link rel="icon" type="image/svg+xml" href="/img/logo/logoN.png" />
      <slot name="meta_head" />
    </Head>
    <SideBar />
    <div class="main-content" id="panel">
      <NavBar />
      <slot name="header" />
      <div class="container-fluid mt--6">
        <slot name="content" />
      </div>
      <slot name="modals" />
      <Notification ref="notification" />
      <Loader ref="loader" />
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted, provide } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import SideBar from "@/Components/Main/SideBar.vue";
import NavBar from "@/Components/Main/NavBar.vue";
import Notification from "@/Components/Basic/Notification.vue";
import Loader from "@/Components/Basic/LoadingBar.vue";
import Footer from "@/Components/Main/Footer.vue";
import { defineProps } from "vue";

const props = defineProps({
  title: String,
});

const notificationRef = ref(null);
const loaderRef = ref(null);

onMounted(() => {
  provide("notify", notificationRef.value);
  provide("loader", loaderRef.value);
});
</script>

<style lang="scss">
body,
html {
  height: 100%;
}

.app-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.main-content {
  display: flex;
  flex-direction: column;
  flex: 1;
}

body {
  background-image: url("@/../src/img/banner/bg.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
  height: 100vh;
}

.bg-header {
  background-color: #55699f;
}

.table-responsive {
  overflow: auto;
}
</style>
