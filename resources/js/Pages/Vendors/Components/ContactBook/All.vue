<template>
  <div id="contact-book">
    <div class="card-header">
      <h5>Contact Book</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form @submit.prevent="updateContactData">
        <div class="row mb-2">
          <div class="col-md-2 column__right___padding">
            <label>NAME</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_contact_name"
                name="name"
                class="form-control form-control-sm"
                v-model="contact.name"
                placeholder="Name"
                aria-label="name"
                aria-describedby="name"
                required
              />
            </div>
            <small
              v-if="validationErrors.name"
              id="msg_contact_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.name }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>DESIGNATION</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_contact_designation"
                name="designation"
                class="form-control form-control-sm"
                v-model="contact.designation"
                placeholder="Designation"
                aria-label="designation"
                aria-describedby="designation"
                required
              />
            </div>
            <small
              v-if="validationErrors.designation"
              id="msg_contact_designation"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.designation }}</small
            >
          </div>
          <div class="col-md-3 column__right___padding column__left___padding">
            <label>EMAIL</label>
            <div class="input-group">
              <input
                type="email"
                id="inp_contact_email"
                name="email"
                class="form-control form-control-sm"
                v-model="contact.email"
                placeholder="Email"
                aria-label="email"
                aria-describedby="email"
                required
              />
            </div>
            <small
              v-if="validationErrors.email"
              id="msg_contact_email"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.email }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>MOBILE</label>
            <div class="input-group">
              <input
                type="number"
                id="inp_contact_mobile_no"
                name="mobile_no"
                class="form-control form-control-sm"
                v-model="contact.mobile_no"
                placeholder="Mobile No."
                aria-label="mobile_no"
                aria-describedby="mobile_no"
                required
              />
            </div>
            <small
              v-if="validationErrors.mobile_no"
              id="msg_contact_mobile_no"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.mobile_no }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>LAND</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_contact_land_no"
                name="land_no"
                class="form-control form-control-sm"
                v-model="contact.land_no"
                placeholder="Land No."
                aria-label="land_no"
                aria-describedby="land_no"
                required
              />
            </div>
            <small
              v-if="validationErrors.land_no"
              id="msg_contact_land_no"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.land_no }}</small
            >
          </div>
          <div class="col-md-1 mt-2 pt-1 column__left___padding">
            <label for=""></label>
            <div>
              <button type="submit" class="btn btn-sm custom-button mt-2">
                <font-awesome-icon icon="fa-solid fa-circle-plus" />
              </button>
            </div>
          </div>
        </div>
      </form>
      <div>
        <!-- <div class="py-3 text-sm mt-3">
          <div class="flex">
            <div class="flex items-center text-muted">
              Search:
              <div class="inline-block ml-2">
                <input
                  type="text"
                  class="form-control form-control-sm"
                  v-model="search"
                  @keyup="getSearch"
                />
              </div>
            </div>
            <div class="flex text-muted ml-auto">
              <div class="inline-block mx-2">
                <select
                  class="form-control form-control-sm per-page-entry"
                  :value="25"
                  v-model="pageCount"
                  @change="perPageChange"
                >
                  <option
                    v-for="perPageCount in perPage"
                    :key="perPageCount"
                    :value="perPageCount"
                    v-text="perPageCount"
                  />
                </select>
              </div>
            </div>
          </div>
        </div> -->

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th :class="textClassHead">Name</th>
                <th :class="textClassHead">Designation</th>
                <th :class="textClassHead">email</th>
                <th :class="textClassHead">Mobile</th>
                <th :class="textClassHead">Land No.</th>
                <th :class="textClassHead"></th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="contact in contacts"
                :key="contact.id"
                :class="rowClass"
              >
                <td :class="textClassBody">
                  {{ contact.name }}
                </td>
                <td :class="textClassBody">
                  {{ contact.designation }}
                </td>
                <td :class="textClassBody">
                  {{ contact.email }}
                </td>
                <td :class="textClassBody">
                  {{ contact.mobile_no }}
                </td>
                <td :class="textClassBody">
                  {{ contact.land_no }}
                </td>
                <td :class="textClassBody">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="deleteContactData(contact.id)"
                    class="p-2 float-end"
                  >
                    <font-awesome-icon
                      icon="fa-solid fa-trash"
                      class="text-ash text-right"
                    />
                  </a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- <div
          class="flex mt-1 px-0 mx-0 card-footer table-footer align-items-center"
        >
          <div class="col-sm-12 col-md-6 p-0">
            <div
              class="dataTables_info column__left___padding"
              id="DataTables_Table_0_info"
              role="status"
              aria-live="polite"
            >
              Showing {{ pagination.from }} to {{ pagination.to }} of
              {{ pagination.total }} entries
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
                    :class="pagination.current_page == 1 ? 'disabled' : ''"
                  >
                    <a
                      class="page-link"
                      href="javascript:void(0)"
                      @click="setPage(pagination.current_page - 1)"
                    >
                      <i class="fa-solid fa-angles-left"></i>
                    </a>
                  </li>
                  <template v-for="(page, index) in pagination.last_page">
                    <template
                      v-if="
                        page == 1 ||
                        page == pagination.last_page ||
                        Math.abs(page - pagination.current_page) < 5
                      "
                    >
                      <li
                        class="page-item"
                        :key="index"
                        :class="pagination.current_page == page ? 'active' : ''"
                      >
                        <a class="page-link" @click="setPage(page)">{{
                          page
                        }}</a>
                      </li>
                    </template>
                  </template>
                  <li
                    class="page-item"
                    :class="
                      pagination.current_page == pagination.last_page
                        ? 'disabled'
                        : ''
                    "
                  >
                    <a
                      class="page-link"
                      href="javascript:void(0)"
                      @click="setPage(pagination.current_page + 1)"
                    >
                      <i class="fa-solid fa-angles-right"></i>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faHouse,
  faPlusCircle,
  faTrash,
} from "@fortawesome/free-solid-svg-icons";

export default {
  components: {
    Link,
    library,
  },
  props: {
    vendorId: {
      type: Number,
      required: true,
    },
  },
  setup() {},
  data() {
    return {
      textClassHead: "text-start text-uppercase",
      textClassBody: "text-start",
      iconClassHead: "text-right",
      iconClassBody: "text-right",
      rowClass: "cursor-pointer",

      search: null,
      page: 1,
      perPage: [25, 50, 100],
      pageCount: 25,
      pagination: {},

      contact: {},
      contacts: [],
    };
  },
  beforeMount() {
    this.getContacts();
    library.add(faHouse);
    library.add(faPlusCircle);
    library.add(faTrash);
  },
  waewtch: {},
  methods: {
    async setPage(page) {
      this.page = page;
      this.reload();
    },
    async getSearch() {
      this.page = 1;
      this.reload();
    },
    async perPageChange() {
      this.reload();
    },
    async reload() {
      this.$root.loader.start();
      const tableData = (
        await axios.get(route("vendor.contact.all", this.vendorId), {
          params: {
            page: this.page,
            per_page: this.pageCount,
            "filter[search]": this.search,
          },
        })
      ).data;

      this.contacts = tableData.data;
      this.pagination = tableData.meta;
      this.$root.loader.finish();
    },
    async getContacts() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const contacts = (
        await axios.get(route("vendor.contact.all", this.vendorId))
      ).data;
      this.contacts = contacts.data;
      this.pagination = contacts.meta;
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async updateContactData() {
      this.resetValidationErrors();
      try {
        await axios.post(
          route("vendor.contact.update", this.vendorId),
          this.contact
        );
        this.contact = {};
        this.reload();
        this.$root.notify.success({
          title: "Success",
          message: "Contact book updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
      }
    },
    async deleteContactData(id) {
      try {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#C00202", // Green
          cancelButtonColor: "#6CA925", // Secondary Color
          confirmButtonText: "Yes, delete it!",
        }).then((result) => {
          if (result.isConfirmed) {
            axios
              .delete(route("vendor.contact.delete", id))
              .then((response) => {
                this.reload();
              });
          }
        });
      } catch (error) {
        this.convertValidationNotification(error);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
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
