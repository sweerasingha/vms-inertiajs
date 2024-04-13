<template>
  <div id="bank-account">
    <div class="card-header">
      <h5>Bank Accounts</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form @submit.prevent="updateBankData">
        <div class="row mb-2">
          <div class="col-md-2 column__right___padding">
            <label>BANK</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_bank_name"
                name="bank_name"
                class="form-control form-control-sm"
                v-model="bank.bank_name"
                placeholder="Bank Name"
                aria-label="bank_name"
                aria-describedby="bank_name"
                required
              />
            </div>
            <small
              v-if="validationErrors.bank_name"
              id="msg_bank_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.bank_name }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>CODE</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_bank_code"
                name="bank_code"
                class="form-control form-control-sm"
                v-model="bank.bank_code"
                placeholder="Bank Code"
                aria-label="bank_code"
                aria-describedby="bank_code"
                required
              />
            </div>
            <small
              v-if="validationErrors.bank_code"
              id="msg_bank_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.bank_code }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>BRANCH</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_branch_name"
                name="branch_name"
                class="form-control form-control-sm"
                v-model="bank.branch_name"
                placeholder="Branch Name"
                aria-label="branch_name"
                aria-describedby="branch_name"
                required
              />
            </div>
            <small
              v-if="validationErrors.branch_name"
              id="msg_branch_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.branch_name }}</small
            >
          </div>
          <div class="col-md-2 column__right___padding column__left___padding">
            <label>CODE</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_branch_code"
                name="branch_code"
                class="form-control form-control-sm"
                v-model="bank.branch_code"
                placeholder="Branch Code"
                aria-label="branch_code"
                aria-describedby="branch_code"
                required
              />
            </div>
            <small
              v-if="validationErrors.branch_code"
              id="msg_branch_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.branch_code }}</small
            >
          </div>
          <div
            class="column__right___padding column__left___padding vender-swift-code"
          >
            <label>SWIFT</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_swift_code"
                name="swift_code"
                class="form-control form-control-sm"
                v-model="bank.swift_code"
                placeholder="Swift Code"
                aria-label="swift_code"
                aria-describedby="swift_code"
                required
              />
            </div>
            <small
              v-if="validationErrors.swift_code"
              id="msg_swift_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.swift_code }}</small
            >
          </div>
          <div class="col-md-2 column__left___padding">
            <label>A/C NUMBER</label>
            <div class="input-group">
              <input
                type="number"
                id="inp_account_no"
                name="account_no"
                class="form-control form-control-sm"
                v-model="bank.account_no"
                placeholder="Account No."
                aria-label="account_no"
                aria-describedby="account_no"
                required
              />
            </div>
            <small
              v-if="validationErrors.account_no"
              id="msg_account_no"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.account_no }}</small
            >
          </div>
          <div class="mt-2 pt-2 column__left___padding">
            <label for=""></label>
            <div>
              <button type="submit" class="btn btn-sm custom-button mt-1">
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
                <th :class="textClassHead">Bank Name</th>
                <th :class="textClassHead">Bank Code</th>
                <th :class="textClassHead">Branch Name</th>
                <th :class="textClassHead">Branch Code</th>
                <th :class="textClassHead">Swift Code</th>
                <th :class="textClassHead">Account No.</th>
                <th :class="textClassHead"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="bank in banks" :key="bank.id" :class="rowClass">
                <td :class="textClassBody">
                  {{ bank.bank_name }}
                </td>
                <td :class="textClassBody">
                  {{ bank.bank_code }}
                </td>
                <td :class="textClassBody">
                  {{ bank.branch_name }}
                </td>
                <td :class="textClassBody">
                  {{ bank.branch_code }}
                </td>
                <td :class="textClassBody">
                  {{ bank.swift_code }}
                </td>
                <td :class="textClassBody">
                  {{ bank.account_no }}
                </td>
                <td :class="textClassBody">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="deleteBank(bank.id)"
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
              class="p-0 dataTables_paginate paging_simple_numbers"
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
import Multiselect from "vue-multiselect";
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
    Multiselect,
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

      bank: {},
      banks: [],
    };
  },
  beforeMount() {
    library.add(faHouse);
    library.add(faPlusCircle);
    library.add(faTrash);
    this.getBanks();
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
        await axios.get(route("vendor.bank.all", this.vendorId), {
          params: {
            page: this.page,
            per_page: this.pageCount,
            "filter[search]": this.search,
          },
        })
      ).data;

      this.banks = tableData.data;
      this.pagination = tableData.meta;
      this.$root.loader.finish();
    },
    async getBanks() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const banks = (await axios.get(route("vendor.bank.all", this.vendorId)))
        .data;
      this.banks = banks.data;
      this.pagination = banks.meta;
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async updateBankData() {
      this.resetValidationErrors();
      try {
        await axios.post(route("vendor.bank.update", this.vendorId), this.bank);
        this.bank = {};
        this.reload();
        this.$root.notify.success({
          title: "Success",
          message: "Bank account updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
      }
    },
    async deleteBank(id) {
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
            axios.delete(route("vendor.bank.delete", id)).then((response) => {
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
