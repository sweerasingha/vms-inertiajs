<template>
    <AppLayout title="Vendor Management">
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-1 mt-1">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">Vendor</h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            Vendors Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right py-4" v-if="true">
                                <a href="javascript:void(0)" @click.prevent="newVendor"
                                    class="btn btn-sm btn-neutral float-end">
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
                                <div for="purchase_uom" class="col-form-label">CODE</div>
                                <input type="text" class="form-control form-control-sm" name="code" id="code"
                                    v-model="search_vendor.code" placeholder="Code" @keyup="getSearch" />
                            </div>
                            <div class="col-md-2 column__right___padding column__left___padding">
                                <div for="purchase_uom" class="col-form-label">NAME</div>
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    v-model="search_vendor.name" placeholder="Vendor's Name" @keyup="getSearch" />
                            </div>
                            <div class="col-md-2 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">COUNTRY</div>
                                <Multiselect v-model="this.select_search_country" :options="countries" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Country" label="name" track-by="id" />
                            </div>
                            <div class="col-md-2 column__left___padding column__right___padding">
                                <div for="purchase_uom" class="col-form-label">CURRENCY</div>
                                <Multiselect v-model="this.select_search_currency" :options="currencies" class="z__index"
                                    :showLabels="false" :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Currency" label="name" track-by="id" />
                            </div>
                            <div class="col-md-2 mt-4 column__left___padding">
                                <a href="javascript:void(0)" @click.prevent="clearFilters"
                                    class="btn btn-sm btn-ash float-end mt-2 pt-2">
                                    CLEAR
                                </a>
                            </div>
                            <div class="text-muted ml-auto mx-4 mt-4">
                                <div class="inline-block">
                                    <select class="form-control form-control-sm per-page-entry mt-2" :value="100"
                                        v-model="pageCount" @change="perPageChange">
                                        <option v-for="perPageCount in perPage" :key="perPageCount" :value="perPageCount"
                                            v-text="perPageCount" />
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-4">
                            <div class="table-responsive">
                                <div class="d-flex flex-row mb-3 rounded">
                                    <div class="left d-flex">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-clone"
                                                color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon"
                                                icon="fa-solid fa-arrow-up-from-bracket" color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-cloud-arrow-down"
                                                color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-wrench"
                                                rotation="270" color="#505050" />
                                        </div>
                                        <div class="p-2 border icon_item" v-if="true">
                                            <a @click.prevent="activeSelectedItems(checkVendorItems)">
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-circle-check"
                                                    color="#0bd018" />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item" v-if="true">
                                            <a @click.prevent="inactiveSelectedItems(checkVendorItems)">
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-circle-minus"
                                                    color="#eb0505" />
                                            </a>
                                        </div>
                                        <div class="p-2 border icon_item" v-if="this.checkVendorItems.length > 0 && true">
                                            <a href="javascript:void(0)"
                                                @click.prevent="deleteSelectedItems(checkVendorItems)">
                                                <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-trash"
                                                    color="#eb0505" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="right d-flex ml-auto">
                                        <div class="p-2 border icon_item">
                                            <font-awesome-icon class="icon_item-icon" icon="fa-solid fa-print"
                                                color="#505050" />
                                        </div>
                                    </div>
                                </div>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="checkArea">
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox" @click="selectAll"
                                                    v-if="this.vendors.length > 0" :checked="this.checkAllItems.length==this.checkVendorItems.length"  v-model="checkAllItems" />
                                                </div>
                                            </th>
                                            <th :class="iconClassHead">Status</th>
                                            <th :class="textClassHead">Code</th>
                                            <th :class="textClassHead">Name</th>
                                            <th :class="textClassHead">Country</th>
                                            <th :class="textClassHead">Currency</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="vendor in vendors" :key="vendor.id" :class="rowClass">
                                            <td class="checkArea">
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox"
                                                        v-model="checkVendorItems" v-bind:value="vendor"
                                                        v-bind:id="vendor.id" />
                                                </div>
                                            </td>
                                            <td :class="iconClassBody" class="pt-2">
                                                <label v-if="vendor.status == 1"
                                                    class="badge bg-success text-white fw-bold">Active</label>
                                                <label v-if="vendor.status == 0"
                                                    class="badge bg-warning text-white fw-bold">Deactive</label>
                                            </td>
                                            <td :class="textClassBody">
                                                {{ vendor.code }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ vendor.name }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ vendor.country_name }}
                                            </td>
                                            <td :class="textClassBody">
                                                {{ vendor.currency_name }}
                                            </td>
                                            <td :class="textClassBody" >
                                                <a href="javascript:void(0)" @click.prevent="editVendor(vendor.id)">
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
                                <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info"
                                    role="status" aria-live="polite">
                                    Showing {{ pagination.from }} to {{ pagination.to }} of
                                    {{ pagination.total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_paginate paging_simple_numbers column__right___padding"
                                    id="DataTables_Table_0_paginate">
                                    <nav aria-label="Page navigation" style="float: right">
                                        <ul class="pagination">
                                            <li class="page-item" :class="pagination.current_page == 1 ? 'disabled' : ''">
                                                <a class="page-link" href="javascript:void(0)"
                                                    @click="setPage(pagination.current_page - 1)">
                                                    <i class="fa-solid fa-angles-left"></i>
                                                </a>
                                            </li>
                                            <template v-for="(page, index) in pagination.last_page">
                                                <template v-if="page == 1 ||
                                                    page == pagination.last_page ||
                                                    Math.abs(page - pagination.current_page) < 5
                                                    ">
                                                    <li class="page-item" :key="index" :class="pagination.current_page == page ? 'active' : ''
                                                        ">
                                                        <a class="page-link" @click="setPage(page)">{{
                                                            page
                                                        }}</a>
                                                    </li>
                                                </template>
                                            </template>
                                            <li class="page-item" :class="pagination.current_page == pagination.last_page
                                                    ? 'disabled'
                                                    : ''
                                                ">
                                                <a class="page-link" href="javascript:void(0)"
                                                    @click="setPage(pagination.current_page + 1)">
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
            <div class="modal fade" id="newVendorModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient" id="add_brandLabel">
                                New Vendor
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body">
                                    <form role="form text-left" @submit.prevent="createVendor"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">CODE</div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="code"
                                                    id="code" v-model="vendor.code" placeholder="Code" required />
                                            </div>

                                            <small v-if="validationErrors.code" id="msg_code"
                                                class="text-danger form-text text-error-msg error">{{ validationErrors.code
                                                }}</small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label">NAME</div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" v-model="vendor.name" placeholder="Name" required />
                                            </div>

                                            <small v-if="validationErrors.name" id="msg_name"
                                                class="text-danger form-text text-error-msg error">{{ validationErrors.name
                                                }}</small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="country_id" class="col-md-3 col-form-label">
                                                COUNTRY
                                            </div>
                                            <div class="col-md-9">
                                                <Multiselect v-model="select_country" :options="this.countries"
                                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                                    :searchable="true" placeholder="Select Country" label="name"
                                                    track-by="id" />

                                                <small v-if="validationErrors.country_id" id="msg_country_id"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.country_id }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="currency_id" class="col-md-3 col-form-label">
                                                CURRENCY
                                            </div>
                                            <div class="col-md-9">
                                                <Multiselect v-model="select_currency" :options="this.currencies"
                                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                                    :searchable="true" placeholder="Select Currency" label="name"
                                                    track-by="id" />
                                                <small v-if="validationErrors.currency_id" id="msg_currency_id"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.currency_id }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2" v-if="true">
                                            <button type="submit" class="btn btn-round custom-button btn-sm mb-0">
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

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

import Multiselect from "vue-multiselect";

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
    faPen,
} from "@fortawesome/free-solid-svg-icons";

export default {
    components: {
        AppLayout,
        Link,
        library,
        Multiselect,
    },
    data() {
        return {
            textClassBody: "text-start",
            iconClassHead: "text-center",
            iconClassBody: "text-center",
            rowClass: "cursor-pointer",
            textClassHead: "some-default-class",

            search: null,
            page: 1,
            perPage: [25, 50, 100],
            pageCount: 25,
            pagination: {},

            vendor: {},
            select_country: null,
            select_currency: null,
            countries: [],
            currencies: [],
            vendors: [],
            checkVendorItems: [],
            checkAllItems: false,

            search_vendor: {},
            select_search_country: null,
            select_search_currency: null,
        };
    },
    beforeMount() {
        library.add(faHouse);
        library.add(faFloppyDisk);
        library.add(faCirclePlus);
        library.add(faClone);
        library.add(faCloudArrowDown);
        library.add(faSquarePlus);
        library.add(faPrint);
        library.add(faArrowUpFromBracket);
        library.add(faWrench);
        library.add(faCircleCheck);
        library.add(faCircleMinus);
        library.add(faTrash);
        library.add(faXmark);
        library.add(faPen);

        this.getCountries();
        this.getCurrencies();
        this.getVendors();
    },
    watch: {
        select_search_currency: function () {
            this.select_search_currency
                ? (this.search_vendor.currency = this.select_search_currency.id)
                : (this.search_vendor.currency = null);
            this.getSearch();
        },
        select_search_country: function () {
            this.select_search_country
                ? (this.search_vendor.country = this.select_search_country.id)
                : (this.search_vendor.country = null);
            this.getSearch();
        },
        checkAllItems(value) {
            this.vendors.forEach((item, index) => {
                if (index !== 0) {
                    item.selected = value;
                }
            });
            if (this.checkVendorItems.length == this.vendors.length) {
                this.checkVendorItems = [];
            } else {
                this.checkVendorItems = this.vendors;
            }
        },
        checkVendorItems(value) {
            if (this.checkVendorItems.length != this.vendors.length) {
                this.checkAllItems = false;
            }
        },
    },
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
                await axios.get(route("vendors.all"), {
                    params: {
                        page: this.page,
                        per_page: this.pageCount,
                        "filter[search]": this.search,
                        search_vendor_code: this.search_vendor.code,
                        search_vendor_name: this.search_vendor.name,
                        search_vendor_country: this.search_vendor.country,
                        search_vendor_currency: this.search_vendor.currency,
                    },
                })
            ).data;

            this.vendors = tableData.data;
            this.pagination = tableData.meta;

            this.$root.loader.finish();
        },

        async getCountries() {
            const countries = (await axios.get(route("country.all"))).data;
            this.countries = countries.data;
        },
        async getCurrencies() {
            const currencies = (await axios.get(route("currency.all"))).data;
            this.currencies = currencies.data;
        },
        async getVendors() {
            this.$nextTick(() => {
                this.$root.loader.start();
            });
            const vendors = (await axios.get(route("vendors.all"))).data;
            this.vendors = vendors.data;
            this.pagination = vendors.meta;
            this.$nextTick(() => {
                this.$root.loader.finish();
            });
        },
        async createVendor() {
            this.resetValidationErrors();
            try {
                if (this.select_country) {
                    this.vendor.country_id = this.select_country.id;
                }
                if (this.select_currency) {
                    this.vendor.currency_id = this.select_currency.id;
                }
                const vendor = (await axios.post(route("vendors.store"), this.vendor))
                    .data;
                window.location.href = route("vendors.edit", vendor.id);
                $("#newVendorModal").modal("hide");
                this.vendor = {};
                this.select_country = {};
                this.select_currency = {};
                this.$root.notify.success({
                    title: "Success",
                    message: "Vendor created successfully",
                });
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },
        async editVendor(vendorId) {
            // this.$inertia.visit(route('vendors.edit', vendorId));
            window.location.href = route("vendors.edit", vendorId);
        },
        async clearFilters() {
            this.select_search_country = null;
            this.select_search_currency = null;
            this.search_vendor = {};
            this.reload();
        },
        async newVendor() {
            this.$root.loader.start();
            this.select_country = null;
            this.select_currency = null;
            this.vendor = {};
            $("#newVendorModal").modal("show");
            this.$root.loader.finish();
        },
        async inactiveSelectedItems(checkVendorItems) {
            this.$root.loader.start();
            const ids = this.checkVendorItems.map((vendor) => vendor.id);
            axios
                .post(route("vendor.inactive.selected"), { ids })
                .then((response) => {
                    this.checkVendorItems = [];
                    this.reload();
                });
            this.$root.loader.finish();
        },
        async activeSelectedItems(checkVendorItems) {
            this.$root.loader.start();
            const ids = this.checkVendorItems.map((vendor) => vendor.id);
            axios.post(route("vendor.active.selected"), { ids }).then((response) => {
                this.checkVendorItems = [];
                this.reload();
            });
            this.$root.loader.finish();
        },

        selectAll: function (event) {
            if (event.target.checked == false) {
                this.checkVendorItems = [];
            } else {
                this.vendors.forEach((vendor) => {
                    this.checkVendorItems.push(vendor.id);
                });
            }
        },

        async deleteSelectedItems(checkVendorItems) {
            this.$root.loader.start();
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
                        const ids = this.checkVendorItems.map((vendor) => vendor.id);
                        axios.post(route("vendor.delete.selected"), { ids })
                            .then((response) => {
                                this.reload();
                            });
                        // Swal.fire(
                        //     "Deleted!",
                        //     `Vendor has been deleted.`,
                        //     "success"
                        // );
                    }
                });
                this.$root.loader.finish();
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },

    },
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
