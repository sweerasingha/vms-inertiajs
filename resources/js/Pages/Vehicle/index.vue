<template>
  <AppLayout title="Vehicle Management">
    <template #header>
      <div class="header pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center mb-1 mt-1">
              <div class="col-lg-8">
                <h6 class="h2 text-dark d-inline-block mb-0">Vehicle</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item">
                      <Link href="/">
                        <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                      </Link>
                    </li>
                    <li
                      class="breadcrumb-item active breadcrumb-text"
                      aria-current="page"
                    >
                      Vehicle Management
                    </li>
                  </ol>
                </nav>
              </div>
              <div class="col-lg-4 text-right py-4" v-if="true">
                <a
                  href="javascript:void(0)"
                  @click.prevent="newVehicle"
                  class="btn btn-sm btn-neutral float-end"
                >
                  <font-awesome-icon icon="fa-solid fa-circle-plus" />
                  ADD NEW
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
    <template #content>
      <div class="row">
        <div class="col-lg-12">
          <div class="card shadow">
            <div class="row my-3 mx-2">
              <div class="col-md-2 column__right___padding">
                <div for="purchase_uom" class="col-form-label">MODEL</div>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="code"
                  id="code"
                  v-model="state.search_vehicle.code"
                  placeholder="Model"
                  @keyup="getSearch"
                />
              </div>
              <div class="col-md-2 column__right___padding column__left___padding">
                <div for="purchase_uom" class="col-form-label">NAME</div>
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="name"
                  id="name"
                  v-model="state.search_vehicle.name"
                  placeholder="Vehicle's Name"
                  @keyup="getSearch"
                />
              </div>
              <div class="col-md-2 column__left___padding column__right___padding">
                <div for="purchase_uom" class="col-form-label">COUNTRY</div>
                <Multiselect
                  v-model="state.select_search_country"
                  :options="state.countries"
                  class="z__index"
                  :showLabels="false"
                  :close-on-select="true"
                  :clear-on-select="false"
                  :searchable="true"
                  placeholder="Select Country"
                  label="name"
                  track-by="id"
                />
              </div>
              <div class="col-md-2 column__left___padding column__right___padding">
                <div for="purchase_uom" class="col-form-label">VEHICLE CATEGORY</div>
                <Multiselect
                  v-model="state.select_search_vehicle_category"
                  :options="state.vehicle_categories"
                  class="z__index"
                  :showLabels="false"
                  :close-on-select="true"
                  :clear-on-select="false"
                  :searchable="true"
                  placeholder="Select Vehicle Category"
                  label="name"
                  track-by="id"
                />
              </div>
              <div class="col-md-2 mt-4 column__left___padding">
                <a
                  href="javascript:void(0)"
                  @click.prevent="clearFilters"
                  class="btn btn-sm btn-ash float-end mt-2 pt-2"
                >
                  CLEAR
                </a>
              </div>
              <div class="text-muted ml-auto mx-4 mt-4">
                <div class="inline-block">
                  <select
                    class="form-control form-control-sm per-page-entry mt-2"
                    :value="100"
                    v-model="state.pageCount"
                    @change="perPageChange"
                  >
                    <option
                      v-for="perPageCount in state.perPage"
                      :key="perPageCount"
                      :value="perPageCount"
                      v-text="perPageCount"
                    />
                  </select>
                </div>
              </div>
            </div>

            <div class="row mx-4">
              <div class="table-responsive">
                <div class="d-flex flex-row mb-3 rounded">
                  <div class="left d-flex">
                    <div class="p-2 border icon_item">
                      <font-awesome-icon
                        class="icon_item-icon"
                        icon="fa-solid fa-clone"
                        color="#505050"
                      />
                    </div>
                    <div class="p-2 border icon_item">
                      <font-awesome-icon
                        class="icon_item-icon"
                        icon="fa-solid fa-arrow-up-from-bracket"
                        color="#505050"
                      />
                    </div>
                    <div class="p-2 border icon_item">
                      <font-awesome-icon
                        class="icon_item-icon"
                        icon="fa-solid fa-cloud-arrow-down"
                        color="#505050"
                      />
                    </div>
                    <div class="p-2 border icon_item">
                      <font-awesome-icon
                        class="icon_item-icon"
                        icon="fa-solid fa-wrench"
                        rotation="270"
                        color="#505050"
                      />
                    </div>
                    <div class="p-2 border icon_item" v-if="true">
                      <a @click.prevent="activeSelectedItems(state.checkVehicleItems)">
                        <font-awesome-icon
                          class="icon_item-icon"
                          icon="fa-solid fa-circle-check"
                          color="#0bd018"
                        />
                      </a>
                    </div>
                    <div class="p-2 border icon_item" v-if="true">
                      <a @click.prevent="inactiveSelectedItems(state.checkVehicleItems)">
                        <font-awesome-icon
                          class="icon_item-icon"
                          icon="fa-solid fa-circle-minus"
                          color="#eb0505"
                        />
                      </a>
                    </div>
                    <div
                      class="p-2 border icon_item"
                      v-if="state.checkVehicleItems.length > 0 && true"
                    >
                      <a
                        href="javascript:void(0)"
                        @click.prevent="deleteSelectedItems(state.checkVehicleItems)"
                      >
                        <font-awesome-icon
                          class="icon_item-icon"
                          icon="fa-solid fa-trash"
                          color="#eb0505"
                        />
                      </a>
                    </div>
                  </div>
                  <div class="right d-flex ml-auto">
                    <div class="p-2 border icon_item">
                      <font-awesome-icon
                        class="icon_item-icon"
                        icon="fa-solid fa-print"
                        color="#505050"
                      />
                    </div>
                  </div>
                </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th class="checkArea">
                        <div class="form-check mb-4">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            @click="selectAll"
                            v-if="state.vehicles.length > 0"
                            :checked="
                              state.checkAllItems.length == state.checkVehicleItems.length
                            "
                            v-model="state.checkAllItems"
                          />
                        </div>
                      </th>
                      <th :class="state.iconClassHead">Status</th>
                      <th :class="state.textClassHead">Model</th>
                      <th :class="state.textClassHead">Name</th>
                      <th :class="state.textClassHead">Country</th>
                      <th :class="state.textClassHead">Vehicle Category</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="vehicle in state.vehicles"
                      :key="vehicle.id"
                      :class="state.rowClass"
                    >
                      <td class="checkArea">
                        <div class="form-check mb-4">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            v-model="state.checkVehicleItems"
                            v-bind:value="vehicle"
                            v-bind:id="vehicle.id"
                          />
                        </div>
                      </td>
                      <td :class="state.iconClassBody" class="pt-2">
                        <label
                          v-if="vehicle.status == 1"
                          class="badge bg-success text-white fw-bold"
                          >Active</label
                        >
                        <label
                          v-if="vehicle.status == 0"
                          class="badge bg-warning text-white fw-bold"
                          >Deactive</label
                        >
                      </td>
                      <td :class="state.textClassBody">
                        {{ vehicle.code }}
                      </td>
                      <td :class="state.textClassBody">
                        {{ vehicle.name }}
                      </td>
                      <td :class="state.textClassBody">
                        {{ vehicle.country_name }}
                      </td>
                      <td :class="state.textClassBody">
                        {{ vehicle.vehicle_category_name }}
                      </td>
                      <td :class="state.textClassBody">
                        <a
                          href="javascript:void(0)"
                          @click.prevent="editvehicle(vehicle.id)"
                        >
                          <font-awesome-icon icon="fa-solid fa-pen" class="text-ash" />
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="flex mt-1 px-3 mx-1 card-footer table-footer align-items-center">
              <div class="col-sm-12 col-md-6 p-0">
                <div
                  class="dataTables_info column__left___padding"
                  id="DataTables_Table_0_info"
                  role="status"
                  aria-live="polite"
                >
                  Showing {{ state.pagination.from }} to {{ state.pagination.to }} of
                  {{ state.pagination.total }} entries
                </div>
              </div>
              <div class="col-sm-12 col-md-6 p-0">
                <div
                  class="dataTables_paginate paging_simple_numbers column__right___padding"
                  id="DataTables_Table_0_paginate"
                >
                  <nav aria-label="Page navigation" style="float: right">
                    <ul class="pagination">
                      <li
                        class="page-item"
                        :class="state.pagination.current_page == 1 ? 'disabled' : ''"
                      >
                        <a
                          class="page-link"
                          href="javascript:void(0)"
                          @click="setPage(state.pagination.current_page - 1)"
                        >
                          <i class="fa-solid fa-angles-left"></i>
                        </a>
                      </li>
                      <template v-for="(page, index) in state.pagination.last_page">
                        <template
                          v-if="
                            page == 1 ||
                            page == state.pagination.last_page ||
                            Math.abs(page - state.pagination.current_page) < 5
                          "
                        >
                          <li
                            class="page-item"
                            :key="index"
                            :class="state.pagination.current_page == page ? 'active' : ''"
                          >
                            <a class="page-link" @click="setPage(page)">{{ page }}</a>
                          </li>
                        </template>
                      </template>
                      <li
                        class="page-item"
                        :class="
                          state.pagination.current_page == state.pagination.last_page
                            ? 'disabled'
                            : ''
                        "
                      >
                        <a
                          class="page-link"
                          href="javascript:void(0)"
                          @click="setPage(state.pagination.current_page + 1)"
                        >
                          <i class="fa-solid fa-angles-right"></i>
                        </a>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
    <template #modals>
      <div
        class="modal fade"
        id="newVehicleModal"
        data-bs-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="newVehicleModal"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
          <div class="modal-content p-2">
            <div class="modal-header">
              <h5
                class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                id="add_brandLabel"
              >
                New Vehicle
              </h5>
              <button
                type="button"
                class="close btn"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">
                  <i class="fa fa-times"></i>
                </span>
              </button>
            </div>
            <div class="modal-body p-0">
              <div class="card-plain">
                <div class="card-body">
                  <form
                    role="form text-left"
                    @submit.prevent="createVehicle"
                    enctype="multipart/form-data"
                  >
                    <div class="row mb-1">
                      <div for="code" class="col-md-3 col-form-label">MODEL</div>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          name="code"
                          id="code"
                          v-model="state.vehicle.code"
                          placeholder="Model"
                          required
                        />
                      </div>

                      <small
                        v-if="validationErrors.code"
                        id="msg_code"
                        class="text-danger form-text text-error-msg error"
                        >{{ validationErrors.code }}</small
                      >
                    </div>
                    <div class="row mb-1">
                      <div for="name" class="col-md-3 col-form-label">NAME</div>
                      <div class="col-md-9">
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          name="name"
                          id="name"
                          v-model="state.vehicle.name"
                          placeholder="Name"
                          required
                        />
                      </div>

                      <small
                        v-if="validationErrors.name"
                        id="msg_name"
                        class="text-danger form-text text-error-msg error"
                        >{{ validationErrors.name }}</small
                      >
                    </div>
                    <div class="row mb-1">
                      <div for="country_id" class="col-md-3 col-form-label">COUNTRY</div>
                      <div class="col-md-9">
                        <Multiselect
                          v-model="state.select_country"
                          :options="state.countries"
                          :showLabels="false"
                          :close-on-select="true"
                          :clear-on-select="false"
                          :searchable="true"
                          placeholder="Select Country"
                          label="name"
                          track-by="id"
                        />

                        <small
                          v-if="validationErrors.country_id"
                          id="msg_country_id"
                          class="text-danger form-text text-error-msg error"
                          >{{ validationErrors.country_id }}</small
                        >
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div for="vehicle_category_id" class="col-md-3 col-form-label">
                        CATEGORY
                      </div>
                      <div class="col-md-9">
                        <Multiselect
                          v-model="state.select_vehicle_category"
                          :options="state.vehicle_categories"
                          :showLabels="false"
                          :close-on-select="true"
                          :clear-on-select="false"
                          :searchable="true"
                          placeholder="Select Vehicle Category"
                          label="name"
                          track-by="id"
                        />
                        <small
                          v-if="validationErrors.vehicle_category_id"
                          id="msg_vehicle_category_id"
                          class="text-danger form-text text-error-msg error"
                          >{{ validationErrors.vehicle_category_id }}</small
                        >
                      </div>
                    </div>
                    <div class="text-right mt-2" v-if="true">
                      <button
                        type="submit"
                        class="btn btn-round custom-button btn-sm mb-0"
                      >
                        <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                        CREATE
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </AppLayout>
</template>

<script setup>
import { ref, reactive, onBeforeMount, watch } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Swal from "sweetalert2";
import { Link } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { library, dom } from "@fortawesome/fontawesome-svg-core";
import {
  faHouse,
  faFloppyDisk,
  faCirclePlus,
  faClone,
  faCloudArrowDown,
  faSquarePlus,
  faPrint,
  faWrench,
  faCircleCheck,
  faCircleMinus,
  faTrash,
  faArrowUpFromBracket,
  faXmark,
  faPen,
} from "@fortawesome/free-solid-svg-icons";

// Add icons to the library
library.add(
  faHouse,
  faFloppyDisk,
  faCirclePlus,
  faClone,
  faCloudArrowDown,
  faSquarePlus,
  faPrint,
  faArrowUpFromBracket,
  faWrench,
  faCircleCheck,
  faCircleMinus,
  faTrash,
  faXmark,
  faPen
);
dom.watch();

// Reactive state
const state = reactive({
  textClassBody: "text-start",
  iconClassHead: "text-center",
  iconClassBody: "text-center",
  textClassHead: "text-start text-uppercase",
  rowClass: "cursor-pointer",

  loading: false,
  search: null,
  page: 1,
  perPage: [25, 50, 100],
  pageCount: 25,
  pagination: {},

  vehicle: {},
  select_country: null,
  select_vehicle_category: null,
  countries: [],
  vehicle_categories: [],
  vehicles: [],
  checkVehicleItems: [],
  checkAllItems: false,

  search_vehicle: {},
  select_search_country: null,
  select_search_vehicle_category: null,
});

// Lifecycle hooks and watchers
onBeforeMount(() => {
  getCountries();
  getvehicle_categories();
  getvehicles();
});

watch(
  () => state.select_search_vehicle_category,
  (newVal, oldVal) => {
    state.search_vehicle.vehicle_category_id = newVal ? newVal.id : null;
    getSearch();
  }
);

watch(
  () => state.select_search_country,
  (newVal, oldVal) => {
    state.search_vehicle.country = newVal ? newVal.id : null;
    getSearch();
  }
);

watch(
  () => state.checkAllItems,
  (newVal, oldVal) => {
    state.vehicles.forEach((item, index) => {
      if (index !== 0) {
        item.selected = newVal;
      }
    });
    state.checkVehicleItems = newVal ? [...state.vehicles] : [];
  }
);

watch(
  () => state.checkVehicleItems,
  (newVal, oldVal) => {
    if (newVal.length != state.vehicles.length) {
      state.checkAllItems = false;
    }
  }
);

// Methods
const setPage = async (page) => {
  state.page = page;
  reload();
};

const getSearch = async () => {
  state.page = 1;
  reload();
};

const perPageChange = async () => {
  reload();
};

const startLoading = () => (state.loading = true);
const finishLoading = () => (state.loading = false);

const reload = async () => {
  startLoading();
  const tableData = (
    await axios.get(route("vehicles.all"), {
      params: {
        page: state.page,
        per_page: state.pageCount,
        "filter[search]": state.search,
        search_vehicle_code: state.search_vehicle.code,
        search_vehicle_name: state.search_vehicle.name,
        search_vehicle_country: state.search_vehicle.country,
        search_vehicle_category: state.search_vehicle.vehicle_category_id,
      },
    })
  ).data;

  state.vehicles = tableData.data;
  state.pagination = tableData.meta;

  finishLoading();
};

const getCountries = async () => {
  const countries = (await axios.get(route("country.all"))).data;
  state.countries = countries.data;
};

const getvehicle_categories = async () => {
  const vehicle_categories = (await axios.get(route("vehicle-category.all"))).data;
  state.vehicle_categories = vehicle_categories.data;
};

const getvehicles = async () => {
  startLoading();
  const vehicles = (await axios.get(route("vehicles.all"))).data;
  state.vehicles = vehicles.data;
  state.pagination = vehicles.meta;
  finishLoading();
};

const createVehicle = async () => {
  resetValidationErrors();
  try {
    if (state.select_country) {
      state.vehicle.country_id = state.select_country.id;
    }
    if (state.select_vehicle_category) {
      state.vehicle.vehicle_category_id = state.select_vehicle_category.id;
    }
    const vehicle = (await axios.post(route("vehicles.store"), state.vehicle)).data;
    window.location.href = route("vehicles.edit", vehicle.id);
    $("#newVehicleModal").modal("hide");
    state.vehicle = {};
    state.select_country = {};
    state.select_vehicle_category = {};
    Swal.fire({
      title: "Success",
      text: "Vehicle created successfully",
      icon: "success",
    });
  } catch (error) {
    convertValidationNotification(error);
  }
};

const editvehicle = async (vehicleId) => {
  window.location.href = route("vehicles.edit", vehicleId);
};

const clearFilters = async () => {
  state.select_search_country = null;
  state.select_search_vehicle_category = null;
  state.search_vehicle = {};
  reload();
};

const newVehicle = async () => {
  startLoading();
  state.select_country = null;
  state.select_vehicle_category = null;
  state.vehicle = {};
  $("#newVehicleModal").modal("show");
  finishLoading();
};

const inactiveSelectedItems = async () => {
  startLoading();
  const ids = state.checkVehicleItems.map((vehicle) => vehicle.id);
  axios.post(route("vehicle.inactive.selected"), { ids }).then((response) => {
    state.checkVehicleItems = [];
    reload();
  });
  finishLoading();
};

const activeSelectedItems = async () => {
  startLoading();
  const ids = state.checkVehicleItems.map((vehicle) => vehicle.id);
  axios.post(route("vehicle.active.selected"), { ids }).then((response) => {
    state.checkVehicleItems = [];
    reload();
  });
  finishLoading();
};

const selectAll = (event) => {
  if (event.target.checked == false) {
    state.checkVehicleItems = [];
  } else {
    state.vehicles.forEach((vehicle) => {
      state.checkVehicleItems.push(vehicle.id);
    });
  }
};

const deleteSelectedItems = async () => {
  startLoading();
  try {
    const result = await Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#C00202", // Red
      cancelButtonColor: "#6CA925", // Green
      confirmButtonText: "Yes, delete it!",
    });

    if (result.isConfirmed) {
      const ids = state.checkVehicleItems.map((vehicle) => vehicle.id);
      await axios.post(route("vehicle.delete.selected"), { ids });
      reload();
    }
  } catch (error) {
    convertValidationNotification(error);
  } finally {
    finishLoading();
  }
};

const convertValidationNotification = (error) => {
  if (error.response && error.response.data && error.response.data.errors) {
    // Assuming error response structure has a 'data.errors' object
    const errors = error.response.data.errors;
    const firstError = errors[Object.keys(errors)[0]]; // Grab the first error message from the errors object
    Swal.fire("Validation Error", firstError, "error");
  } else if (error.message) {
    // General error message
    Swal.fire("Error", error.message, "error");
  } else {
    // Fallback error message
    Swal.fire("Error", "An unknown error occurred.", "error");
  }
};

const resetValidationErrors = () => {
  state.validationErrors = {};
};
</script>

<style lang="scss" scoped>
.breadcrumb-text {
  color: #6343e9 !important;
}

.custom-button {
  background-color: #ffffff;
  border-color: #6343e9;
  color: #6343e9 !important;
}

.custom-button:hover {
  background-color: #6343e9;
  color: #ffffff !important;
}
</style>
