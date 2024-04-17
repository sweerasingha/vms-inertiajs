<template>
  <AppLayout title="Vehicle Categories">
    <template #header>
      <div class="header pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center mb-3 mt-3">
              <div class="col-lg-8">
                <h6 class="h2 text-dark d-inline-block mb-0">Vehicle Categories</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-block">
                  <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                    <li class="breadcrumb-item">
                      <Link :href="route('dashboard')">
                        <font-awesome-icon :icon="['fas', 'house']" color="#505050" />
                      </Link>
                    </li>
                    <li
                      class="breadcrumb-item active breadcrumb-text"
                      aria-current="page"
                    >
                      Vehicle Category Management
                    </li>
                  </ol>
                </nav>
              </div>
              <div
                class="col-lg-4 text-right"
                v-if="$page.props.auth.user.permissions.all_permissions"
              >
                <a
                  href="javascript:void(0)"
                  data-toggle="modal"
                  data-target="#newVehicleCategoryModal"
                  class="btn btn-sm btn-neutral float-end"
                >
                  <font-awesome-icon :icon="['fas', 'circle-plus']" />
                  ADD NEW
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
    <template #content>
      <div class="card">
        <div class="py-3 mx-3 text-sm card-body">
          <div class="flex">
            <div class="flex items-center text-muted">
              Search:
              <div class="inline-block ml-2">
                <input
                  type="text"
                  class="form-control form-control-sm"
                  v-model="state.search"
                  @keyup="getSearch"
                />
              </div>
            </div>
            <div class="flex text-muted ml-auto mx-1">
              <div class="inline-block mx-2">
                <select
                  class="form-control form-control-sm per-page-entry"
                  :value="25"
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
        </div>
        <div class="row mx-4">
          <div class="table-responsive">
            <div class="d-flex flex-row mb-3 rounded">
              <div class="left d-flex">
                <div class="p-2 border icon_item">
                  <font-awesome-icon
                    class="icon_item-icon"
                    :icon="['fas', 'clone']"
                    color="#505050"
                  />
                </div>
                <div class="p-2 border icon_item">
                  <font-awesome-icon
                    class="icon_item-icon"
                    :icon="['fas', 'arrow-up-from-bracket']"
                    color="#505050"
                  />
                </div>
                <div class="p-2 border icon_item">
                  <font-awesome-icon
                    class="icon_item-icon"
                    :icon="['fas', 'cloud-arrow-down']"
                    color="#505050"
                  />
                </div>
                <div class="p-2 border icon_item">
                  <font-awesome-icon
                    class="icon_item-icon"
                    :icon="['fas', 'wrench']"
                    :rotation="270"
                    color="#505050"
                  />
                </div>
                <div
                  class="p-2 border icon_item"
                  v-if="$page.props.auth.user.permissions.all_permissions"
                >
                  <a @click.prevent="activeSelectedItems(state.checkUOMItems)">
                    <font-awesome-icon
                      class="icon_item-icon"
                      :icon="['fas', 'circle-check']"
                      color="#0bd018"
                    />
                  </a>
                </div>
                <div
                  class="p-2 border icon_item"
                  v-if="$page.props.auth.user.permissions.all_permissions"
                >
                  <a @click.prevent="inactiveSelectedItems(state.checkUOMItems)">
                    <font-awesome-icon
                      class="icon_item-icon"
                      :icon="['fas', 'circle-minus']"
                      color="#eb0505"
                    />
                  </a>
                </div>
                <div
                  class="p-2 border icon_item"
                  v-if="
                    $page.props.auth.user.permissions.all_permissions &&
                    state.checkUOMItems.length > 0
                  "
                >
                  <a
                    href="javascript:void(0)"
                    @click.prevent="deleteSelectedItems(state.checkUOMItems)"
                  >
                    <font-awesome-icon
                      class="icon_item-icon"
                      :icon="['fas', 'trash']"
                      color="#eb0505"
                    />
                  </a>
                </div>
              </div>
              <div class="right d-flex ml-auto">
                <div class="p-2 border icon_item">
                  <font-awesome-icon
                    class="icon_item-icon"
                    :icon="['fas', 'print']"
                    color="#505050"
                  />
                </div>
                <a
                  href="javascript:void(0)"
                  data-toggle="modal"
                  data-target="#newVehicleModal"
                >
                  <div class="p-2 border icon_item">
                    <font-awesome-icon
                      class="icon_item-icon"
                      :icon="['fas', 'square-plus']"
                      color="#306ed9"
                    />
                  </div>
                </a>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th class="checkArea pl-3">
                    <div class="form-check mb-4">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        @change="selectAll"
                        v-if="state.vehicles.length > 0"
                        :checked="state.checkUOMItems.length === state.vehicles.length"
                        v-model="state.checkAllItems"
                      />
                    </div>
                  </th>
                  <th :class="state.iconClassHead">Status</th>
                  <th class="text-start">Name</th>
                  <th class="text-right"></th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="vehicle in state.vehicles"
                  :key="vehicle.id"
                  :class="state.rowClass"
                >
                  <td class="pl-3">
                    <div class="form-check mb-4">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        v-model="state.checkUOMItems"
                        v-bind:value="vehicle"
                        :id="'checkbox-' + vehicle.id"
                      />
                    </div>
                  </td>
                  <td :class="state.iconClassBody">
                    <span
                      v-if="vehicle.status == 1"
                      class="badge bg-success text-white fw-bold ml-3"
                      >Active</span
                    >
                    <span
                      v-if="vehicle.status == 0"
                      class="badge bg-warning text-white fw-bold ml-3"
                      >Deactive</span
                    >
                  </td>
                  <td class="text-start">
                    {{ vehicle.name }}
                  </td>
                  <td class="text-right">
                    <a
                      href="javascript:void(0)"
                      v-if="$page.props.auth.user.permissions.all_permissions"
                      class="p-2"
                      @click.prevent="editvehicle(vehicle.id)"
                    >
                      <i class="fas fa-pencil text-ash" aria-hidden="true"></i>
                    </a>
                    <a
                      href="javascript:void(0)"
                      v-if="$page.props.auth.user.permissions.all_permissions"
                      @click.prevent="deletevehicle(vehicle.id)"
                      class="p-2"
                    >
                      <i class="fas fa-trash text-ash" aria-hidden="true"></i>
                    </a>
                    <a
                      href="javascript:void(0)"
                      class="p-2"
                      @click.prevent="changeVehicleCategoryState(vehicle.id)"
                    >
                      <i class="fas fa-times text-ash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="flex mt-1 card-footer table-footer align-items-center">
          <div class="col-sm-12 col-md-6">
            <div
              class="dataTables_info"
              id="DataTables_Table_0_info"
              role="status"
              aria-live="polite"
            >
              Showing {{ state.pagination.from }} to {{ state.pagination.to }} of
              {{ state.pagination.total }} entries
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div
              class="dataTables_paginate paging_simple_numbers"
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
    </template>
    <template #modals>
      <div
        class="modal fade"
        id="newVehicleCategoryModal"
        data-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="newVehicleCategoryModal"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5
                class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                id="add_brandLabel"
              >
                New vehicle
              </h5>
              <button
                type="button"
                class="close btn"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">
                  <font-awesome-icon :icon="['fas', 'xmark']" />
                </span>
              </button>
            </div>
            <div class="modal-body p-2">
              <div class="card-plain">
                <div class="card-body m-3">
                  <form
                    role="form text-left"
                    @submit.prevent="createvehicle"
                    enctype="multipart/form-data"
                  >
                    <div class="row mb-1">
                      <div for="name" class="col-md-2 col-form-label col-form-label">
                        NAME
                      </div>
                      <div class="col-md-10">
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          name="name"
                          id="name"
                          v-model="state.vehicle.name"
                          placeholder="Enter Name"
                          required
                        />
                        <small
                          v-if="validationErrors.name"
                          id="msg_code"
                          class="text-danger form-text text-error-msg error"
                          >{{ validationErrors.name }}</small
                        >
                      </div>
                    </div>
                    <div
                      class="text-right mt-2"
                      v-if="$page.props.auth.user.permissions.all_permissions"
                    >
                      <button
                        type="submit"
                        class="btn btn-sm btn-round btn-outline--info btn-md mb-0"
                      >
                        <i class="fas fa-save"></i>
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

      <div
        class="modal fade"
        id="editVehicleCategoryModal"
        data-backdrop="static"
        tabindex="-1"
        role="dialog"
        aria-labelledby="editVehicleCategoryModal"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5
                class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                id="add_brandLabel"
              >
                Edit vehicle
              </h5>
              <button
                type="button"
                class="close btn"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">
                  <font-awesome-icon :icon="['fas', 'xmark']" />
                </span>
              </button>
            </div>
            <div class="modal-body p-2">
              <div class="card-plain">
                <div class="card-body m-3">
                  <form
                    role="form text-left"
                    @submit.prevent="updateVehicleCategory"
                    enctype="multipart/form-data"
                  >
                    <div class="row mb-1">
                      <div for="name" class="col-md-2 col-form-label col-form-label">
                        NAME
                      </div>
                      <div class="col-md-10">
                        <input
                          type="text"
                          class="form-control form-control-sm"
                          name="name"
                          id="name"
                          v-model="state.vehicle_category_edit.name"
                          placeholder="Enter Name"
                          required
                        />
                        <small
                          v-if="validationErrors.message"
                          id="msg_code"
                          class="text-danger form-text text-error-msg error"
                          >{{ validationErrors.message }}</small
                        >
                      </div>
                    </div>

                    <div
                      class="text-right mt-4"
                      v-if="$page.props.auth.user.permissions.all_permissions"
                    >
                      <button
                        type="submit"
                        class="btn btn-round custom-button btn-sm mb-0"
                      >
                        <font-awesome-icon :icon="['fas', 'floppy-disk']" />
                        UPDATE
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade bd-example-modal-lg"
        id="editVehicleCategoryModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5
                class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                id="exampleModalLabel"
              >
                Edit vehicle
              </h5>
              <button
                type="button"
                class="close btn"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">
                  <font-awesome-icon :icon="['fas', 'xmark']" />
                </span>
              </button>
            </div>
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-body">
                  <form
                    role="form text-left"
                    @submit.prevent="updateVehicleCategory"
                    method="POST"
                    enctype="multipart/form-data"
                  >
                    <div class="row mb-1">
                      <div for="name" class="col-md-3 col-form-label">NAME</div>
                      <div class="col-md-9">
                        <input
                          type="text"
                          v-model="state.vehicle_category_edit.name"
                          class="form-control form-control-sm"
                          name="name"
                          id="name"
                          placeholder="Enter Name"
                          required
                        />
                        <small
                          v-if="validationErrors.message"
                          id="msg_name"
                          class="text-danger form-text text-error-msg error"
                          >{{ validationErrors.message }}</small
                        >
                      </div>
                    </div>
                    <div class="text-right mt-2">
                      <button
                        type="submit"
                        class="btn btn-sm btn-round btn-outline--info btn-md mb-0"
                      >
                        <i class="fas fa-save"></i>
                        UPDATE
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
import { ref, reactive, onMounted, watch } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import { fas } from "@fortawesome/free-solid-svg-icons";
import { library } from "@fortawesome/fontawesome-svg-core";
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
  faPenToSquare,
} from "@fortawesome/free-solid-svg-icons";

// Reactive state management with the Composition API
const state = reactive({
  textClassHead: "text-start text-uppercase",
  textClassBody: "text-start",
  iconClassHead: "text-center",
  iconClassBody: "text-center",
  rowClass: "cursor-pointer",
  search: null,
  page: 1,
  perPage: [25, 50, 100],
  pageCount: 25,
  pagination: {},
  vehicle: {},
  vehicle_category_edit: {},
  vehicles: [],
  checkUOMItems: [],
  checkAllItems: false,
});

onMounted(async () => {
  library.add(
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
    faPenToSquare
  );
  await getVehicleCategories();
});

watch(
  () => state.checkAllItems,
  (newVal) => {
    selectAll();
  }
);
const getVehicleCategories = async () => {
  const response = await axios.get(route("vehicle-category.all"));
  state.vehicles = response.data.data;
  state.pagination = response.data.meta;
};

const setPage = async (page) => {
  state.page = page;
  await reload();
};

const getSearch = async () => {
  await reload();
};

const perPageChange = async () => {
  await reload();
};

const reload = async () => {
  const tableData = await axios.get(route("vehicle-category.all"), {
    params: {
      page: state.page,
      per_page: state.pageCount,
      "filter[search]": state.search,
    },
  });
  state.vehicles = tableData.data.data;
  state.pagination = tableData.data.meta;
};

const resetValidationErrors = () => {
  state.validationErrors = {};
};

const createvehicle = async () => {
  resetValidationErrors();
  try {
    await axios.post(route("vehicle-category.store"), state.vehicle);
    reload();
    $("#newVehicleCategoryModal").modal("hide");
    state.vehicle = {};
    $root.notify.success({
      title: "Success",
      message: "vehicle created successfully",
    });
  } catch (error) {
    convertValidationNotification(error);
  }
};

const changeVehicleCategoryState = async (id) => {
  try {
    Swal.fire({
      title: "Are you sure?",
      text: "You want to change status!",
      showCancelButton: true,
      confirmButtonColor: "#C00202",
      cancelButtonColor: "#6CA925",
      confirmButtonText: "Yes, change it!",
    }).then((result) => {
      if (result.isConfirmed) {
        axios
          .post(`/vehicle-category/${id}/changeStatus`)
          .then((response) => {
            reload();
            Swal.fire("Changed!", `Status has been changed.`, "success");
          })
          .catch((error) => {
            console.error("Error changing status:", error);
            Swal.fire("Error!", `Failed to change status.`, "error");
          });
      }
    });
  } catch (error) {
    console.error("Error in changeVehicleCategoryState method:", error);
  }
};

const deletevehicle = async (id) => {
  try {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#C00202",
      cancelButtonColor: "#6CA925",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        axios.delete(route("vehicle-category.delete", id));
        reload();
        Swal.fire("Deleted!", `Record has been deleted.`, "success");
      }
    });
  } catch (error) {
    convertValidationNotification(error);
  }
};

const editvehicle = async (id) => {
  resetValidationErrors();
  try {
    const vehicle = (await axios.get(route("vehicle-category.get", id))).data;
    state.vehicle_category_edit = vehicle.data;
    $("#editVehicleCategoryModal").modal("show");
  } catch (error) {
    convertValidationError(error);
  }
};

const updateVehicleCategory = async () => {
  resetValidationErrors();
  try {
    await axios.post(
      route("vehicle-category.update", state.vehicle_category_edit.id),
      state.vehicle_category_edit
    );
    reload();
    $("#editVehicleCategoryModal").modal("hide");
    state.vehicle_category_edit = {};
    $root.notify.success({
      title: "Success",
      message: "vehicle updated successfully",
    });
  } catch (error) {
    convertValidationNotification(error);
  }
};

function selectAll() {
  if (state.checkAllItems) {
    state.checkUOMItems = [...state.vehicles];
  } else {
    state.checkUOMItems = [];
  }
}

const deleteSelectedItems = async (checkUOMItems) => {
  console.log("Attempting to delete items:", checkUOMItems);
  try {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#C00202",
      cancelButtonColor: "#6CA925",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        const ids = state.checkUOMItems.map((vehicles) => vehicles.id);
        axios
          .post(route("vehicle-category.delete.selected", checkUOMItems), { ids })
          .then((response) => {
            reload();
          });
      }
    });
  } catch (error) {
    convertValidationNotification(error);
  }
};

const inactiveSelectedItems = async (checkUOMItems) => {
  const ids = state.checkUOMItems.map((vehicle) => vehicle.id);
  axios.post(route("vehicle-category.inactive.selected"), { ids }).then((response) => {
    state.checkUOMItems = [];
    reload();
  });
};

const activeSelectedItems = async (checkUOMItems) => {
  const ids = state.checkUOMItems.map((vehicle) => vehicle.id);
  axios.post(route("vehicle-category.active.selected"), { ids }).then((response) => {
    state.checkUOMItems = [];
    reload();
  });
};
</script>

<style lang="scss" scoped>
tr:hover {
  background: rgba(157, 157, 157, 0.357);
  cursor: pointer;
}

.table > :not(caption) > * > * {
  padding-bottom: 0.2rem;
  padding-top: 0.2rem;
  padding-left: 0.5rem;
}

.table thead th {
  padding: 0.45rem 0.5rem;
  text-transform: uppercase;
  letter-spacing: 0;
  border-bottom: 1px solid #e9ecef;
  text-align: left;
}

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
