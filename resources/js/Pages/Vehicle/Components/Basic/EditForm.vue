<template>
  <div id="basic-info">
    <div class="card-header">
      <h5>Basic Info</h5>
    </div>
    <div class="card-body pt-0 mt-3">
      <form
        role="form text-left"
        @submit.prevent="updateBasicData"
        enctype="multipart/form-data"
      >
        <div class="row mb-1">
          <div for="code" class="col-md-2 col-form-label">CODE</div>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control form-control-sm"
              name="code"
              id="code"
              v-model="vendor.code"
              required
            />
            <small
              v-if="validationErrors.code"
              id="msg_code"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.code }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="country_id" class="col-md-2 col-form-label">COUNTRY</div>
          <div class="col-md-10">
            <Multiselect
              v-model="select_country"
              :options="this.countries"
              :close-on-select="true"
              :showLabels="false"
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
          <div for="currency_id" class="col-md-2 col-form-label">CURRENCY</div>
          <div class="col-md-10">
            <Multiselect
              v-model="select_currency"
              :options="this.currencies"
              :close-on-select="true"
              :showLabels="false"
              :clear-on-select="false"
              :searchable="true"
              placeholder="Select Currency"
              label="name"
              track-by="id"
            />
            <small
              v-if="validationErrors.currency_id"
              id="msg_currency_id"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.currency_id }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="name" class="col-md-2 col-form-label">NAME</div>
          <div class="col-md-10">
            <input
              type="text"
              class="form-control form-control-sm"
              name="name"
              id="name"
              v-model="vendor.name"
              required
            />
            <small
              v-if="validationErrors.name"
              id="msg_name"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.name }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="address_line_1" class="col-md-2 col-form-label">
            ADDRESS
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-12 mb-1">
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="address_line_1"
                  id="address_line_1"
                  v-model="vendor.address_line_1"
                  placeholder="Address Line #1"
                />
                <small
                  v-if="validationErrors.address_line_1"
                  id="msg_address_line_1"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.address_line_1 }}</small
                >
              </div>
              <div class="col-md-12 mb-1">
                <input
                  type="text"
                  class="form-control form-control-sm"
                  name="address_line_2"
                  id="address_line_2"
                  v-model="vendor.address_line_2"
                  placeholder="Address Line #2"
                />
                <small
                  v-if="validationErrors.address_line_2"
                  id="msg_address_line_2"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.address_line_2 }}</small
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-1">
          <div for="unit" class="col-md-2 col-form-label">PHONE</div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-lg-6 column__right___padding">
                <label>NUMBER 1</label>
                <input
                  class="form-control form-control-sm"
                  type="text"
                  name="contact_1"
                  id="inp_contact_1"
                  v-model="vendor.contact_1"
                  placeholder="Number 1"
                />
                <small
                  v-if="validationErrors.contact_1"
                  id="msg_contact_1"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.contact_1 }}</small
                >
              </div>
              <div class="col-lg-6 column__left___padding">
                <label>NUMBER 2</label>
                <input
                  class="form-control form-control-sm"
                  type="text"
                  name="contact_2"
                  id="inp_contact_2"
                  v-model="vendor.contact_2"
                  placeholder="Number 2"
                />
                <small
                  v-if="validationErrors.contact_2"
                  id="msg_contact_2"
                  class="text-danger form-text text-error-msg error"
                  >{{ validationErrors.contact_2 }}</small
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-1">
          <div for="inp_fax" class="col-md-2 col-form-label">FAX</div>
          <div class="col-md-10">
            <input
              type="number"
              id="inp_fax"
              name="fax"
              class="form-control form-control-sm"
              v-model="vendor.fax"
              placeholder="Fax"
              aria-label="Fax"
              aria-describedby="Fax"
            />
            <small
              v-if="validationErrors.fax"
              id="msg_fax"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.fax }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="inp_brc_no" class="col-md-2 col-form-label">BRC NO.</div>
          <div class="col-md-10">
            <input
              type="text"
              id="inp_brc_no"
              name="brc_no"
              class="form-control form-control-sm"
              v-model="vendor.brc_no"
              placeholder="Business Registration Number"
              aria-label="Business registration Number"
              aria-describedby="Business registration Number"
            />
            <small
              v-if="validationErrors.brc_no"
              id="msg_brc_no"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.brc_no }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="inp_nic_no" class="col-md-2 col-form-label">NIC NO.</div>
          <div class="col-md-10">
            <input
              type="text"
              id="inp_nic_no"
              name="nic_no"
              class="form-control form-control-sm"
              v-model="vendor.nic_no"
              placeholder="NIC Number"
              aria-label="NIC Number"
              aria-describedby="NIC Number"
            />
            <small
              v-if="validationErrors.nic_no"
              id="msg_nic_no"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.nic_no }}</small
            >
          </div>
        </div>
        <div class="row mb-1">
          <div for="inp_web_site" class="col-md-2 col-form-label">WEBSITE</div>
          <div class="col-md-10">
            <input
              type="text"
              id="inp_web_site"
              name="web_site"
              class="form-control form-control-sm"
              v-model="vendor.web_site"
              placeholder="Website"
              aria-label="WEBSITE"
              aria-describedby="WEBSITE"
            />
            <small
              v-if="validationErrors.web_site"
              id="msg_web_site"
              class="text-danger form-text text-error-msg error"
              >{{ validationErrors.web_site }}</small
            >
          </div>
        </div>
        <div class="text-right">
          <button
            type="button"
            class="btn btn-sm btn-round btn-outline-danger mb-0"
            v-if="true"
            @click.prevent="deleteVender">
            <font-awesome-icon icon="fa-solid fa-trash" />
            DELETE
          </button>
          <button v-if="true" type="submit" class="btn btn-round custom-button btn-sm mb-0">
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
import Multiselect from "vue-multiselect";
import Swal from "sweetalert2";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
  faHouse,
  faFloppyDisk,
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
      vendor: {},
      select_country: null,
      select_currency: null,
      countries: [],
      currencies: [],
    };
  },
  beforeMount() {
    library.add(faHouse);
    library.add(faFloppyDisk);
    library.add(faTrash);
    this.getCountries();
    this.getCurrencies();
    this.getVendor();
  },
  watch: {},
  methods: {
    async getVendor() {
      this.$nextTick(() => {
        this.$root.loader.start();
      });
      const vendor = (await axios.get(route("vendors.get", this.vendorId)))
        .data;
      this.vendor = vendor.data;

      const select_country = (
        await axios.get(route("country.get", this.vendor.country_id))
      ).data;
      this.select_country = select_country.data;

      const select_currency = (
        await axios.get(route("currency.get", this.vendor.currency_id))
      ).data;
      this.select_currency = select_currency.data;
      this.$nextTick(() => {
        this.$root.loader.finish();
      });
    },
    async getCountries() {
      const countries = (await axios.get(route("country.all"))).data;
      this.countries = countries.data;
    },
    async getCurrencies() {
      const currencies = (await axios.get(route("currency.all"))).data;
      this.currencies = currencies.data;
    },
    async updateBasicData() {
      this.resetValidationErrors();
      try {
        if (this.select_country) {
          this.vendor.country_id = this.select_country.id;
        }
        if (this.select_currency) {
          this.vendor.currency_id = this.select_currency.id;
        }
        await axios.post(
          route("vendors.basic.update", this.vendorId),
          this.vendor
        );
        this.$root.notify.success({
          title: "Success",
          message: "Vendors updated successfully",
        });
      } catch (error) {
        this.convertValidationError(error);
      }
    },
    async deleteVender() {
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
              .delete(route("vendors.basic.delete", this.vendor.id))
              .then((response) => {
                this.$inertia.visit(route("vendors.index"));
              });
            // Swal.fire("Deleted!", `Vender has been deleted.`, "success");
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
