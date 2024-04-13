<template>
  <div id="Tax Records">
    <div class="card-header">
      <h5>Tax Records</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form @submit.prevent="UpdateTaxData">
        <div class="row mb-2">
          <div class="col-md-3 column__right___padding">
            <label>Tax</label>
            <div class="input-group">
              <input
                type="text"
                id="inp_tax_name"
                name="tax_name"
                class="form-control form-control-sm"
                v-model="tax.tax_name"
                placeholder="Tax"
                aria-label="tax_name"
                aria-describedby="tax_name"
                required
              />
            </div>
            <small
              v-if="validationErrors.tax_name"
              id="msg_tax_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.tax_name }}</small
            >
          </div>
          <div class="col-md-4 column__right___padding column__left___padding">
            <label>Type</label>
            <div class="input-group">
              <select
                class="form-control form-control-sm"
                v-model="tax.tax_type"
                placeholder="Tax Type"
                name="value_types"
                id="value_types"
                required
              >
                <option value="percentage" selected>Percentage</option>
                <option value="amount">Amount</option>
              </select>
            </div>
            <small
              v-if="validationErrors.tax_code"
              id="msg_tax_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.tax_code }}</small
            >
          </div>
          <div class="col-md-4 column__left___padding column__right___padding">
            <label>Value</label>
            <div class="input-group">
              <input
                type="number"
                step="any"
                id="inp_value"
                name="value"
                class="form-control form-control-sm"
                v-model="tax.value"
                placeholder="0.00"
                aria-label="value"
                aria-describedby="value"
                required
              />
            </div>
            <small
              v-if="validationErrors.account_no"
              id="msg_value"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.value }}</small
            >
          </div>
          <div class="col-md-1 column__left___padding mt-4 text-right">
            <button type="submit" class="btn btn-sm custom-button mt-1">
              <font-awesome-icon icon="fa-solid fa-circle-plus" />
            </button>
          </div>
        </div>
      </form>
      <div class="mt-4">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th :class="textClassHead">Tax</th>
                <th :class="iconClassHead">Tax Type</th>
                <th :class="valueClassHead">Value</th>
                <th :class="textClassHead"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="tax in taxes" :key="tax.id" :class="rowClass">
                <td :class="textClassBody">
                  {{ tax.tax_name }}
                </td>
                <td :class="iconClassBody">
                  <span
                    v-if="tax.tax_type == 'percentage'"
                    class="badge badge-pill badge-success"
                    >Percentage</span
                  >
                  <span
                    v-if="tax.tax_type == 'amount'"
                    class="badge badge-pill badge-info"
                    >Amount</span
                  >
                </td>
                <td :class="valueClassBody">
                  {{ tax.value }}
                </td>
                <td class="text-right">
                  <a
                    href="javascript:void(0)"
                    @click.prevent="deleteTax(tax.id)"
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
      iconClassHead: "text-center",
      iconClassBody: "text-center",
      valueClassHead: "text-right",
      valueClassBody: "text-right",
      rowClass: "cursor-pointer",

      search: null,
      page: 1,
      perPage: [25, 50, 100],
      pageCount: 25,
      pagination: {},

      tax: {},
      taxes: [],
    };
  },
  beforeMount() {
    library.add(faHouse);
    library.add(faPlusCircle);
    library.add(faTrash);
    this.getTaxes();
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
        await axios.get(route("vendor.tax.all", this.vendorId), {
          params: {
            page: this.page,
            per_page: this.pageCount,
            "filter[search]": this.search,
          },
        })
      ).data;

      this.taxes = tableData.data;
      this.pagination = tableData.meta;
      this.$root.loader.finish();
    },
    async getTaxes() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const taxes = (await axios.get(route("vendor.tax.all", this.vendorId)))
        .data;
      this.taxes = taxes.data;
      this.pagination = taxes.meta;
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async UpdateTaxData() {
      this.resetValidationErrors();
      try {
        await axios.post(route("vendor.tax.update", this.vendorId), this.tax);
        this.tax = {};
        this.reload();
        this.$root.notify.success({
          title: "Success",
          message: "Tax data updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
      }
    },
    async deleteTax(id) {
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
            axios.delete(route("vendor.tax.delete", id)).then((response) => {
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
