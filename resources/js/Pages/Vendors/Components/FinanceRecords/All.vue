<template>
  <div id="finance-record">
    <div class="card-header">
      <h5>Finance Records</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form
        role="form text-left"
        @submit.prevent="updateFinanceData"
        enctype="multipart/form-data"
      >
        <div class="row mb-1">
          <div for="payee" class="col-md-3 col-form-label">
            PAYEE ACCOUNT CODE
          </div>
          <div class="col-md-9">
            <input
              type="text"
              class="form-control form-control-sm"
              name="payee"
              id="payee"
              v-model="vendorFinanceData.payee_account_code"
              required
            />
            <small
              v-if="validationErrors.payee_account_code"
              id="msg_payee_account_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.payee_account_code }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="gl_code" class="col-md-3 col-form-label">GL CODE</div>
          <div class="col-md-9">
            <input
              type="text"
              class="form-control form-control-sm"
              name="gl_code"
              id="gl_code"
              v-model="vendorFinanceData.gl_code"
              placeholder="GL Code"
              required
            />
            <small
              v-if="validationErrors.gl_code"
              id="msg_gl_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.gl_code }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="unit" class="col-md-3 col-form-label">VAT/TAX(%)</div>
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-6 column__right___padding">
                <label>TAX</label>
                <input
                  class="form-control form-control-sm"
                  type="number"
                  name="tax_no"
                  id="tax_no"
                  v-model="vendorFinanceData.tax_no"
                  placeholder="Tax"
                  step="any"
                />
                <small
                  v-if="validationErrors.tax_no"
                  id="msg_contact_1tax_no"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.tax_no }}</small
                >
              </div>
              <div class="col-md-6 column__left___padding">
                <label>VAT</label>
                <input
                  class="form-control form-control-sm"
                  type="number"
                  name="vat_no"
                  id="vat_no"
                  v-model="vendorFinanceData.vat_no"
                  placeholder="Vat"
                  step="any"
                />
                <small
                  v-if="validationErrors.vat_no"
                  id="msg_vat_no"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.vat_no }}</small
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-1">
          <div for="incoterms" class="col-md-3 col-form-label">INCO TERMS</div>
          <div class="col-md-9">
            <input
              type="text"
              id="incoterms"
              name="incoterms"
              class="form-control form-control-sm"
              v-model="vendorFinanceData.incoterms"
              placeholder="Inco Terms"
              aria-label="incoterms"
              aria-describedby="incoterms"
            />
            <small
              v-if="validationErrors.incoterms"
              id="msg_fax"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.incoterms }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="credit_days" class="col-md-3 col-form-label">
            CREDIT DAYS
          </div>
          <div class="col-md-9">
            <input
              type="number"
              id="credit_days"
              name="credit_days"
              class="form-control form-control-sm"
              v-model="vendorFinanceData.credit_days"
              placeholder="Credit Days"
              aria-label="credit_days"
              aria-describedby="credit_days"
            />
            <small
              v-if="validationErrors.credit_days"
              id="msg_credit_days"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.credit_days }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="payment_terms" class="col-md-3 col-form-label">
            PAYMENT TERM
          </div>
          <div class="col-md-9">
            <select
              v-model="vendorFinanceData.payment_terms"
              class="form-control form-control-sm"
              name="payment_terms"
              id="payment_terms"
              required
            >
              <option value=""></option>
              <option value="0">Cash</option>
              <option value="1">Checks</option>
              <option value="2">Cards</option>
            </select>
            <small
              v-if="validationErrors.payment_terms"
              id="msg_payment_terms"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.payment_terms }}</small
            >
          </div>
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-round custom-button btn-sm mb-0">
            <font-awesome-icon icon="fa-solid fa-floppy-disk" />
            SAVE
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faHouse,
  faFloppyDisk,
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
      vendorFinanceData: {},
    };
  },
  beforeMount() {
    library.add(faHouse);
    library.add(faFloppyDisk);
    library.add(faTrash);
    this.getGetVendorFinanceData();
  },
  watch: {},
  methods: {
    async getGetVendorFinanceData() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const vendorFinanceData = (
        await axios.get(route("vendor.finance.get", this.vendorId))
      ).data;
      if (vendorFinanceData) {
        this.vendorFinanceData = vendorFinanceData;
      }
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async updateFinanceData() {
      // console.log(this.vendorFinanceData);
      this.resetValidationErrors();
      try {
        await axios.post(
          route("vendor.finance.update", this.vendorId),
          this.vendorFinanceData
        );
        this.$root.notify.success({
          title: "Success",
          message: "Finance record updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
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
