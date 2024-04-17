<template>
  <nav
    class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light"
    id="sidenav-main"
  >
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="mb-4 text-center sidenav-header">
        <img
          src="/img/logo/iMake-Indigo.png"
          alt="iMake"
          class="home-logo mt-1"
          height="150"
        />
      </div>
      <br />
      <div class="mt-5 navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse sidebar_menu" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="mb-3 navbar-nav">
            <li class="nav-item">
              <Link
                :class="{ active: isActive('dashboard') }"
                class="nav-link active-preloader"
                :href="route('dashboard')"
              >
                <font-awesome-icon icon="fa-solid fa-desktop" />
                <span class="ml-2 nav-link-text font-weight-400">Dashboard</span>
              </Link>
            </li>
            <li class="nav-item">
              <Link
                :class="{ active: isActive('/vendors') }"
                class="nav-link active-preloader"
              >
                <font-awesome-icon icon="fa-solid fa-building-user" />
                <span class="ml-2 nav-link-text font-weight-400">Vehicles</span>
              </Link>
            </li>

            <!-- Additional nav items repeated as needed -->
            <li class="nav-item">
              <a
                class="nav-link"
                href="#settingsMenu"
                data-toggle="collapse"
                aria-expanded="true"
              >
                <font-awesome-icon icon="fa-solid fa-gear" /><span class="ml-2"
                  >Settings</span
                >
              </a>
              <ul class="collapse list-unstyled" id="settingsMenu">
                <!-- Settings Items Here -->
                <li class="nav-item">
                  <Link
                    :class="{ active: isActive('/vehicle-category') }"
                    class="nav-link active-preloader"
                    :href="route('vehicle-category.index')"
                  >
                    <font-awesome-icon icon="fa-solid fa-folder " class="ml-4" /><span
                      class="ml-2 hide-menu"
                      >Vehicle Category</span
                    >
                  </Link>
                </li>
                <li class="nav-item">
                  <Link
                    :class="{ active: $page.url.startsWith('/country') }"
                    class="nav-link active-preloader"
                    :href="route('country.index')"
                  >
                    <font-awesome-icon icon="fa-solid fa-folder " class="ml-4" /><span
                      class="ml-2 hide-menu"
                      >Country Register</span
                    >
                  </Link>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, onBeforeMount } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faDesktop,
  faBuildingUser,
  faFolderOpen,
  faFolder,
  faGear,
  faWarehouse,
} from "@fortawesome/free-solid-svg-icons";

library.add(faDesktop, faBuildingUser, faFolderOpen, faFolder, faGear, faWarehouse);

const { url } = usePage().props;
const isActive = (path) => {
  // Using optional chaining to prevent accessing properties of undefined
  return url?.startsWith(path);
};

const materialTypes = ref([]);

onBeforeMount(() => {
  // getMaterialTypes();
});

async function getMaterialTypes() {
  // const response = await axios.get(route("materialType.all"));
  // materialTypes.value = response.data;
}
</script>

<style lang="css">
.navbar-vertical .navbar-brand-img,
.navbar-vertical .navbar-brand > img {
  max-width: 100%;
  max-height: none;
  margin-top: -60px;
  margin-left: -10px;
}

.navbar-vertical.navbar-expand-xs .navbar-collapse {
  margin-top: -50px;
}
</style>

<style lang="css">
.navbar-vertical .navbar-brand-img,
.navbar-vertical .navbar-brand > img {
  max-width: 100%;
  max-height: none;
  margin-top: -60px;
  margin-left: -10px;
}

.navbar-vertical.navbar-expand-xs .navbar-collapse {
  margin-top: -50px;
}
</style>
