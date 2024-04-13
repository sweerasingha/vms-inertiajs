<template>
  <div id="partner-accounts">
    <div class="card-header">
      <h5>Partner Accounts</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form @submit.prevent="updatePartnerData">
        <div class="row mb-2">
          <div class="col-md-3 mb-2 column__right___padding">
            <label>TYPE</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_type"
                name="type"
                class="form-control form-control-sm"
                v-model="partner.type"
                placeholder="Type"
                aria-label="type"
                aria-describedby="type"
                required
              />
            </div>
            <small
              v-if="validationErrors.type"
              id="msg_partner_type"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.type }}</small
            >
          </div>
          <div
            class="col-md-3 mb-2 column__right___padding column__left___padding"
          >
            <label>NAME</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_name"
                name="name"
                class="form-control form-control-sm"
                v-model="partner.name"
                placeholder="Name"
                aria-label="name"
                aria-describedby="name"
                required
              />
            </div>
            <small
              v-if="validationErrors.name"
              id="msg_partner_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.name }}</small
            >
          </div>
          <div
            class="col-md-3 mb-2 column__right___padding column__left___padding"
          >
            <label>ADDRESS LINE 1</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_address_line_1"
                name="address_line_1"
                class="form-control form-control-sm"
                v-model="partner.address_line_1"
                placeholder="Address line 1"
                aria-label="address_line_1"
                aria-describedby="address_line_1"
              />
            </div>
            <small
              v-if="validationErrors.address_line_1"
              id="msg_partner_address_line_1"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.address_line_1 }}</small
            >
          </div>
          <div class="col-md-3 mb-2 column__left___padding">
            <label>ADDRESS LINE 2</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_address_line_2"
                name="address_line_2"
                class="form-control form-control-sm"
                v-model="partner.address_line_2"
                placeholder="Address line 2"
                aria-label="address_line_2"
                aria-describedby="address_line_2"
              />
            </div>
            <small
              v-if="validationErrors.address_line_2"
              id="msg_partner_address_line_2"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.address_line_2 }}</small
            >
          </div>
          <div class="col-md-3 mb-2 column__right___padding">
            <label>CONTACT 1</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_contact_1"
                name="contact_1"
                class="form-control form-control-sm"
                v-model="partner.contact_1"
                placeholder="Contact 1"
                aria-label="contact_1"
                aria-describedby="contact_1"
              />
            </div>
            <small
              v-if="validationErrors.contact_1"
              id="msg_partner_contact_1"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.contact_1 }}</small
            >
          </div>
          <div
            class="col-md-3 mb-2 column__right___padding column__left___padding"
          >
            <label>CONTACT 2</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_contact_2"
                name="contact_2"
                class="form-control form-control-sm"
                v-model="partner.contact_2"
                placeholder="Contact 2"
                aria-label="contact_2"
                aria-describedby="contact_2"
              />
            </div>
            <small
              v-if="validationErrors.contact_2"
              id="msg_partner_contact_2"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.contact_2 }}</small
            >
          </div>
          <div
            class="col-md-3 mb-2 column__right___padding column__left___padding"
          >
            <label>FAX</label>
            <div class="input-group">
              <input
                type="number"
                id="inp_partner_fax"
                name="fax"
                class="form-control form-control-sm"
                v-model="partner.fax"
                placeholder="Fax"
                aria-label="fax"
                aria-describedby="fax"
              />
            </div>
            <small
              v-if="validationErrors.fax"
              id="msg_partner_fax"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.fax }}</small
            >
          </div>
          <div class="col-md-3 mb-2 column__left___padding">
            <label>WEBSITE</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_partner_website"
                name="web_site"
                class="form-control form-control-sm"
                v-model="partner.web_site"
                placeholder="Website"
                aria-label="web_site"
                aria-describedby="web_site"
              />
            </div>
            <small
              v-if="validationErrors.web_site"
              id="msg_partner_website"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.web_site }}</small
            >
          </div>
          <div class="col-md-12 mb-2 text-right">
            <button type="submit" class="btn btn-sm custom-button mt-1">
              <font-awesome-icon icon="fa-solid fa-circle-plus" />
            </button>
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
                <th :class="textClassHead">Type</th>
                <th :class="textClassHead">Name</th>
                <th :class="textClassHead">Address Line 1</th>
                <th :class="textClassHead">Address Line 2</th>
                <th :class="textClassHead">Contact 1</th>
                <th :class="textClassHead">Contact 2</th>
                <th :class="textClassHead">Fax</th>
                <th :class="textClassHead">Website</th>
                <th :class="textClassHead"></th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="partner in partners"
                :key="partner.id"
                :class="rowClass"
              >
                <td :class="textClassBody">
                  {{ partner.type }}
                </td>
                <td :class="textClassBody">
                  {{ partner.name }}
                </td>
                <td :class="textClassBody">
                  {{ partner.address_line_1 }}
                </td>
                <td :class="textClassBody">
                  {{ partner.address_line_2 }}
                </td>
                <td :class="textClassBody">
                  {{ partner.contact_1 }}
                </td>
                <td :class="textClassBody">
                  {{ partner.contact_2 }}
                </td>
                <td :class="textClassBody">
                  {{ partner.fax }}
                </td>
                <td :class="textClassBody">
                  {{ partner.web_site }}
                </td>
                <td :class="textClassBody">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="deletePartner(partner.id)"
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

      partner: {},
      partners: [],
    };
  },
  beforeMount() {
    library.add(faHouse);
    library.add(faPlusCircle);
    library.add(faTrash);
    this.getPartners();
  },
  watch: {},
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
        await axios.get(route("vendor.partner.all", this.vendorId), {
          params: {
            page: this.page,
            per_page: this.pageCount,
            "filter[search]": this.search,
          },
        })
      ).data;

      this.partners = tableData.data;
      this.pagination = tableData.meta;
      this.$root.loader.finish();
    },
    async getPartners() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const partners = (
        await axios.get(route("vendor.partner.all", this.vendorId))
      ).data;
      this.partners = partners.data;
      this.pagination = partners.meta;
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async updatePartnerData() {
      this.resetValidationErrors();
      try {
        await axios.post(
          route("vendor.partner.update", this.vendorId),
          this.partner
        );
        this.partner = {};
        this.reload();
        this.$root.notify.success({
          title: "Success",
          message: "Partner account updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
      }
    },
    async deletePartner(id) {
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
              .delete(route("vendor.partner.delete", id))
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
