<template>
    <AppLayout title="Vendor - Edit">
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 row align-items-center">
                            <div class="col-lg-6">
                                <h6 class="mb-0 h2 text-dark d-inline-block">
                                    Vendor
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link href="/">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <Link :href="`/vendors`" class="breadcrumb-text">
                                            Vendors Management
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            #{{ this.vendor.code }}
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <div class="mt-4 row">
                <div class="col-lg-2 col-md-2">
                    <div class="nav-wrapper-loc">
                        <ul class="nav nav-pills nav-fill flex-column" id="tabs-icons-text" role="tablist">
                            <li class="mb-2 nav-item">
                                <a class="nav-link active" id="basic-data-tab" data-toggle="tab" href="#basic-data"
                                    role="tab" aria-controls="basic-data" aria-selected="true">
                                    Basic Data</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="contact-book-tab" data-toggle="tab" href="#contact-book" role="tab"
                                    aria-controls="contact-book" aria-selected="true">
                                    Contact Book</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="bank-accounts-tab" data-toggle="tab" href="#bank-accounts"
                                    role="tab" aria-controls="bank-accounts" aria-selected="true">
                                    Bank Accounts</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="finance-records-tab" data-toggle="tab" href="#finance-records"
                                    role="tab" aria-controls="finance-records" aria-selected="true">
                                    Finance Records</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="partner-accounts-tab" data-toggle="tab" href="#partner-accounts"
                                    role="tab" aria-controls="partner-accounts" aria-selected="true">
                                    Partner Accounts</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="tax-records-tab" data-toggle="tab" href="#tax-records" role="tab"
                                    aria-controls="tax-records" aria-selected="true">
                                    Tax Records</a>
                            </li>
                            <!-- <li class="mb-2 nav-item">
                                <a class="btn btn-danger" href="javascript:void(0)" id="delete" @click="deleteVendor">
                                    Delete
                                </a>
                            </li> -->
                            <li hidden></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-10">
                    <div class="shadow card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-data" role="tabpanel">
                                    <BasicEditForm :vendorId="this.vendor.id" />
                                </div>
                                <div class="tab-pane fade show" id="contact-book" role="tabpanel">
                                    <ContactBookAll :vendorId="this.vendor.id" />
                                </div>
                                <div class="tab-pane fade show" id="bank-accounts" role="tabpanel">
                                    <BankAccountsAll :vendorId="this.vendor.id" />
                                </div>
                                <div class="tab-pane fade show" id="finance-records" role="tabpanel">
                                    <FinanceRecordAll :vendorId="this.vendor.id" />
                                </div>
                                <div class="tab-pane fade show" id="partner-accounts" role="tabpanel">
                                    <PartnerAccountsAll :vendorId="this.vendor.id" />
                                </div>
                                <div class="tab-pane fade show" id="tax-records" role="tabpanel">
                                    <TaxRecordsAll :vendorId="this.vendor.id" />
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
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHouse,
    faCircleInfo,
    faCartPlus,
    faDiamond,
} from "@fortawesome/free-solid-svg-icons";

import BasicEditForm from "@/Pages/Vendors/Components/Basic/EditForm.vue";
import BankAccountsAll from "@/Pages/Vendors/Components/BankAccounts/All.vue";
import ContactBookAll from "@/Pages/Vendors/Components/ContactBook/All.vue";
import FinanceRecordAll from "@/Pages/Vendors/Components/FinanceRecords/All.vue";
import PartnerAccountsAll from "@/Pages/Vendors/Components/PartnerAccounts/All.vue";
import TaxRecordsAll from "@/Pages/Vendors/Components/Tax/All.vue";

export default {
    components: {
        AppLayout,
        Link,
        BasicEditForm,
        BankAccountsAll,
        ContactBookAll,
        FinanceRecordAll,
        PartnerAccountsAll,
        TaxRecordsAll,
        library,
    },
    props: {
        vendor: Object,
    },
    data() {
        return {};
    },
    beforeMount() {
        library.add(faCircleInfo);
        library.add(faCartPlus);
        library.add(faDiamond);
        library.add(faHouse);
    },
    watch: {},
    methods: {
        async deleteVendor() {
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
                            .delete(
                                route("vendors.basic.delete", this.vendor.id)
                            )
                            .then((response) => {
                                this.$inertia.visit(route("vendors.index"));
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
.breadcrumb-text {
    color: #6343e9 !important;
}

.nav-link.active {
    background-color: #6343e9 !important;
    color: #fff !important;
}
</style>
