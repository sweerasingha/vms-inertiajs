<template>
    <AppLayout title="Material Categories - Edit">
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="row align-items-center mb-3 mt-3">
                            <div class="col-lg-8">
                                <h6 class="h2 text-dark d-inline-block mb-0">
                                    Material Categories Management
                                </h6>
                                <nav aria-label="breadcrumb" class="d-none d-md-block">
                                    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                        <li class="breadcrumb-item">
                                            <Link :href="route('dashboard')">
                                            <font-awesome-icon icon="fa-solid fa-house" color="#505050" />
                                            </Link>
                                        </li>
                                        <li class="breadcrumb-item active breadcrumb-text" aria-current="page">
                                            Material Categories Management
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-lg-4 text-right" v-if="can('create_categories')">
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#newCategoryModal"
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
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-dark text-xxs font-weight-bolder opacity-7 text-start">
                                                Category
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="warehouse_tree" id="warehouse_tree">
                                                        <ul v-if="this.categories">
                                                            <li v-for="category in categories" id="level-1"
                                                                :key="category.id">
                                                                {{ category.name }}
                                                                <span class="tool-box">
                                                                    <!-- <span @click.prevent="newSubCategory(category.id)"
                                                                        class="ms-2 ml-3" >
                                                                        <i class="fa-solid fa-circle-plus text-ash">
                                                                        </i>
                                                                    </span> -->
                                                                    <span @click.prevent="editCategory(category.id)" v-if="can('update_categories')"
                                                                        class="ms-2 ml-2">
                                                                        <i class="fa-solid fa-pencil text-ash"> </i>
                                                                    </span>

                                                                    <span @click.prevent="
                                                                        deleteSubCategory(category.id)
                                                                        " v-if="can('delete_categories')" class="ms-2 ml-2">
                                                                        <i class="fa-solid fa-trash text-ash"> </i>
                                                                    </span>
                                                                </span>
                                                                <!-- <ul v-if="category.children" class="ml-4">
                                                                    <li v-for="subCategory1 in category.children" :key="subCategory1.id">
                                                                        {{ subCategory1.name }}
                                                                        <span class="tool-box">
                                                                            <span
                                                                                @click.prevent="newSubCategory(subCategory1.id)"
                                                                                class="ms-2 ml-3" >
                                                                                <i
                                                                                    class="fa-solid fa-circle-plus text-ash">
                                                                                </i>
                                                                            </span>
                                                                            <span
                                                                                @click.prevent="editSubCategory(subCategory1.id)"
                                                                                class="ms-2 ml-2" >
                                                                                <i class="fa-solid fa-pencil text-ash">
                                                                                </i>
                                                                            </span>
                                                                            <span
                                                                                @click.prevent="deleteSubCategory(subCategory1.id)"
                                                                                class="ms-2 ml-2" >

                                                                                <i class="fa-solid fa-trash text-ash">
                                                                                </i>
                                                                            </span>
                                                                        </span>
                                                                        <ul v-if="subCategory1.children" class="ml-4">
                                                                            <li
                                                                                v-for="subCategory2 in subCategory1.children" :key="subCategory2.id">
                                                                                {{ subCategory2.name }}
                                                                                <span class="tool-box">
                                                                                    <span
                                                                                        @click.prevent="newSubCategory(subCategory2.id)"
                                                                                        class="ms-2 ml-3">
                                                                                        <i
                                                                                            class="fa-solid fa-circle-plus text-ash">
                                                                                        </i>
                                                                                    </span>
                                                                                    <span
                                                                                        @click.prevent="editSubCategory(subCategory2.id)"
                                                                                        class="ms-2 ml-2">
                                                                                        <i
                                                                                            class="fa-solid fa-pencil text-ash">
                                                                                        </i>
                                                                                    </span>
                                                                                    <span
                                                                                        @click.prevent="deleteSubCategory(subCategory2.id)"
                                                                                        class="ms-2 ml-2" >
                                                                                        <i
                                                                                            class="fa-solid fa-trash text-ash">
                                                                                        </i>
                                                                                    </span>
                                                                                </span>
                                                                                <ul v-if="subCategory2.children"
                                                                                    class="ml-4">
                                                                                    <li
                                                                                        v-for="subCategory3 in subCategory2.children" :key="subCategory3.id">
                                                                                        {{ subCategory3.name }}
                                                                                        <span class="tool-box">
                                                                                            <span
                                                                                                @click.prevent="editSubCategory(subCategory3.id)"
                                                                                                class="ms-2 ml-3">
                                                                                                <i
                                                                                                    class="fa-solid fa-pencil text-ash">
                                                                                                </i>
                                                                                            </span>
                                                                                            <span
                                                                                                @click.prevent="deleteSubCategory(subCategory3.id)"
                                                                                                class="ms-2 ml-2">
                                                                                                <i
                                                                                                    class="fa-solid fa-trash text-ash">
                                                                                                </i>
                                                                                            </span>
                                                                                        </span>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul> -->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #modals>
            <div class="modal fade" id="newCategoryModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newCategoryModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                New Category
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0" id="new-category-content">
                            <div class="card-plain">
                                <div class="card-body m-3">
                                    <form role="form text-left" @submit.prevent="createCategory"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-2 col-form-label">CODE</div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-sm" name="code"
                                                    id="code" v-model="category.code" placeholder="Code" required />
                                                <smalll v-if="validationErrors.code" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.code }}</smalll>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-2 col-form-label">NAME</div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" v-model="category.name" placeholder="Name" required />
                                                <small v-if="validationErrors.name" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name }}</small>
                                            </div>
                                        </div>

                                        <div class="text-right mt-2" v-if="can('create_categories')">
                                            <div class="text-right mt-2">
                                                <button type="submit"
                                                    class="btn btn-sm btn-round btn-outline--info btn-md mb-0">
                                                    <i class="fas fa-save"></i>
                                                    CREATE
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal fade" id="newSubCategoryModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newSubCategoryModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                New Sub Category</h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0" id="edit-location-content">
                            <div class="card-plain">
                                <div class="card-body m-3">
                                    <form role="form text-left" @submit.prevent="createSubCategory"
                                        enctype="multipart/form-data" method="POST">
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label text-uppercase">Parent</div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    v-model="this.parent_category.name" readonly>
                                                <input type="hidden" name="parent_id"
                                                    v-model="this.sub_category.parent_id">
                                                <input type="hidden" name="level" v-model="this.sub_category.level">
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">CODE</div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="sub_category.code"
                                                    class="form-control form-control-sm" name="code" id="code"
                                                    placeholder="Code" required>
                                                <small v-if="validationErrors.code" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.code
                                                    }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label">NAME</div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="sub_category.name"
                                                    class="form-control form-control-sm" name="name" id="name"
                                                    placeholder="Name" required>
                                                <small v-if="validationErrors.name" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name
                                                    }}</small>
                                            </div>
                                        </div>

                                        <div class="text-right mt-2">
                                            <div class="text-right mt-2" >
                                                <button type="submit"
                                                    class="btn btn-sm btn-round btn-outline-info btn-md mb-0">
                                                    <i class="fas fa-save"></i>
                                                    CREATE
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="modal fade" id="editCategoryModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="editCategoryModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                Edit Category
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0" id="new-category-content">
                            <div class="card-plain">
                                <div class="card-body m-3">
                                    <form role="form text-left" @submit.prevent="updateCategory"
                                        enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-2 col-form-label">CODE</div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-sm" name="code"
                                                    id="code" v-model="edit_category.code" placeholder="Code" required />
                                                <smalll v-if="validationErrors.code" id="msg_code"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.code }}
                                                </smalll>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-2 col-form-label">NAME</div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" v-model="edit_category.name" placeholder="Name" required />
                                                <small v-if="validationErrors.name" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2" v-if="can('update_categories')">
                                            <button type="submit"
                                                class="btn btn-sm btn-round btn-outline--info btn-md mb-0">
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
            <!-- <div class="modal fade" id="editSubCategoryModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="editSubCategoryModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder text-info text-gradient" id="add_brandLabel">
                                Edit Sub Category</h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">
                                    <font-awesome-icon icon="fa-solid fa-xmark" />
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0" id="edit-location-content">
                            <div class="card-plain">
                                <div class="card-body m-3">
                                    <form role="form text-left" @submit.prevent="updateSubCategory"
                                        enctype="multipart/form-data" method="POST">
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label text-uppercase">Parent</div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    v-model="parent_category.name" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">CODE</div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="edit_sub_category.code"
                                                    class="form-control form-control-sm" name="code" id="code"
                                                    placeholder="Code" required>
                                                <small v-if="validationErrors.code" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.code
                                                    }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="name" class="col-md-3 col-form-label">NAME</div>
                                            <div class="col-md-9">
                                                <input type="text" v-model="edit_sub_category.name"
                                                    class="form-control form-control-sm" name="name" id="name"
                                                    placeholder="Name" required>
                                                <small v-if="validationErrors.name" id="msg_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                    validationErrors.name
                                                    }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2" >
                                            <button type="submit"
                                                class="btn btn-sm btn-round btn-outline-info btn-md mb-0">
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
            </div> -->
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";

import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHouse,
    faFloppyDisk,
    faXmark,
    faPlusCircle,
    faTrash,
    faPen,
} from "@fortawesome/free-solid-svg-icons";

export default {
    components: {
        AppLayout,
        Link,
        library,
    },
    data() {
        return {
            category: {},
            edit_sub_category: {},
            edit_category: {},
            sub_category: {},
            parent_category: {},
            categories: [],
        };
    },
    beforeMount() {
        library.add(faHouse);
        library.add(faPen);
        library.add(faFloppyDisk);
        library.add(faPlusCircle);
        library.add(faXmark);
        library.add(faTrash);
        this.getCategoriesLevel1();
        this.treeInitialize();
    },
    watch: {},
    methods: {
        async treeInitialize() {
            // $('#warehouse_tree').jstree({
            //     'core': {
            //         'themes': {
            //             'responsive': false
            //         }
            //     },
            //     'types': {
            //         'default': {
            //             'icon': 'fa fa-folder'
            //         }
            //     },
            //     'plugins': ['types', 'dnd'],
            // });
            // $("#warehouse_tree").jstree('open_all');
        },
        async getCategoriesLevel1() {
            const categories = (await axios.get(route("materialCategory.level1.all")))
                .data;
            this.categories = categories;
            this.treeInitialize();
        },
        async createCategory() {
            this.resetValidationErrors();
            try {
                await axios.post(route("materialCategory.store"), this.category);
                $("#newCategoryModal").modal("hide");
                this.category = {};
                this.getCategoriesLevel1();
                this.$root.notify.success({
                    title: "Success",
                    message: "Material category created successfully.",
                });
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },
        async newSubCategory(id) {
            const parent_category = (
                await axios.get(route("materialCategory.get", id))
            ).data;
            $("#newSubCategoryModal").modal("show");
            this.parent_category = parent_category.data;
        },
        async createSubCategory(id) {
            this.resetValidationErrors();
            console.log(this.sub_category);
            try {
                this.sub_category.parent_id = this.parent_category.id;
                this.sub_category.level = this.parent_category.level + 1;
                console.log(this.sub_category);
                await axios.post(route("materialCategory.store"), this.sub_category);
                $("#newSubCategoryModal").modal("hide");
                this.sub_category = {};
                this.getCategoriesLevel1();
                this.$root.notify.success({
                    title: "Success",
                    message: "Material sub category created successfully.",
                });
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },

        async editCategory(id) {
            const edit_category = (await axios.get(route("materialCategory.get", id)))
                .data;
            $("#editCategoryModal").modal("show");
            this.edit_category = edit_category.data;
        },
        async updateCategory() {
            this.resetValidationErrors();
            try {
                await axios.post(
                    route("materialCategory.update", this.edit_category.id),
                    this.edit_category
                );
                $("#editCategoryModal").modal("hide");
                this.edit_category = {};
                this.getCategoriesLevel1();
                this.$root.notify.success({
                    title: "Success",
                    message: "Material category updated successfully.",
                });
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },

        async editSubCategory(id) {
            const edit_sub_category = (
                await axios.get(route("materialCategory.get", id))
            ).data;
            $("#editSubCategoryModal").modal("show");
            this.edit_sub_category = edit_sub_category.data;
            const parent_category = (
                await axios.get(
                    route("materialCategory.get", this.edit_sub_category.parent_id)
                )
            ).data;
            this.parent_category = parent_category.data;
        },
        async updateSubCategory() {
            this.resetValidationErrors();
            try {
                await axios.post(
                    route("materialCategory.update", this.edit_sub_category.id),
                    this.edit_sub_category
                );
                $("#editSubCategoryModal").modal("hide");
                this.edit_sub_category = {};
                this.parent_category = {};
                this.getCategoriesLevel1();
                this.$root.notify.success({
                    title: "Success",
                    message: "Material category updated successfully.",
                });
            } catch (error) {
                this.convertValidationNotification(error);
            }
        },

        async deleteSubCategory(id) {
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
                            .delete(route("materialCategory.sub.delete", id))
                            .then((response) => {
                                this.getCategoriesLevel1();
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
</style>
