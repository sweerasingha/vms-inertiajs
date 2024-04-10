<template>
    <nav class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="mb-4 text-center sidenav-header">
                <img src="/img/logo/iMake-Indigo.png" alt="iMake" class="home-logo mt-1" height="150">
            </div>
            <br>
            <div class="mt-5 navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse sidebar_menu" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="mb-3 navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link">
                                <font-awesome-icon icon="fa-solid fa-desktop" />
                                <span class="ml-2 nav-link-text font-weight-400">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#materialMenu" data-toggle="collapse" aria-expanded="true">
                                <font-awesome-icon icon="fa-solid fa-folder-open" /><span class="ml-2">Material</span>
                            </a>
                            <ul class="collapse list-unstyled" id="materialMenu">
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <font-awesome-icon icon="fa-solid fa-folder " class="ml-4" />
                                        <span class="ml-2 hide-menu">All</span>
                                    </a>
                                </li>
                                <!-- Dynamic Material Types Here -->
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <font-awesome-icon icon="fa-solid fa-building-user" />
                                <span class="ml-2 nav-link-text font-weight-400">Vendor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <font-awesome-icon icon="fa-solid fa-people-carry-box" />
                                <span class="ml-2 nav-link-text font-weight-400">GRN</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link">
                                <font-awesome-icon icon="fa-solid fa-users" />
                                <span class="ml-2 nav-link-text font-weight-400">Customer</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#settingsMenu" data-toggle="collapse" aria-expanded="true">
                                <font-awesome-icon icon="fa-solid fa-gear" /><span class="ml-2">Settings</span>
                            </a>
                            <ul class="collapse list-unstyled" id="settingsMenu">
                                <!-- Settings Items Here -->
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <font-awesome-icon icon="fa-solid fa-gear" class="ml-4" />
                                        <span class="ml-2 hide-menu">Vehicle Categories</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <font-awesome-icon icon="fa-solid fa-warehouse" class="ml-4" />
                                        <span class="ml-2 hide-menu">User Management</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

</template>


<script>
import { Link } from '@inertiajs/vue3'
import isArray from 'lodash/isArray';

import { library } from '@fortawesome/fontawesome-svg-core'

import { faBook,faNoteSticky,faArrowUpRightFromSquare, faDice ,faGift, faMoneyBillTransfer, faFileInvoice, faBuildingUser, faBoxesStacked, faFilePen,faCartShopping, faUsers, faArrowRotateRight, faWarehouse, faCoins, faGlobe, faGear, faDesktop, faLayerGroup, faFolder, faInfinity, faFolderOpen, faTruckField, faChartSimple, faListCheck, faPenToSquare, faRightFromBracket, faPercent,faPeopleCarryBox } from '@fortawesome/free-solid-svg-icons'

export default {
    components: {
        Link,
        library,
    },
    data() {
        return {
            materialTypes: [],
        }
    },
    beforeMount() {
        library.add(faCartShopping)
        library.add(faDesktop)
        library.add(faCartShopping)
        library.add(faNoteSticky)
        library.add(faArrowUpRightFromSquare)
        library.add(faMoneyBillTransfer)
        library.add(faFileInvoice)
        library.add(faChartSimple)
        library.add(faLayerGroup)
        library.add(faBuildingUser)
        library.add(faDice)
        library.add(faFolder)
        library.add(faFilePen)
        library.add(faInfinity)
        library.add(faPenToSquare)
        library.add(faFolderOpen)
        library.add(faPercent)
        library.add(faGear)
        library.add(faGift)
        library.add(faGlobe)
        library.add(faCoins)
        library.add(faUsers)
        library.add(faBook)
        library.add(faWarehouse)
        library.add(faArrowRotateRight)
        library.add(faTruckField)
        library.add(faListCheck)
        library.add(faBoxesStacked)
        library.add(faRightFromBracket)
        library.add(faCoins)
        library.add(faPeopleCarryBox)

        // this.getMaterialTypes();

        if(!window.Laravel){
            window.location.reload();
        }
    },
    methods: {
        isActive(route, path) {
            if (isArray(path)) {
                return path.includes(route);
            }
        },
        async getMaterialTypes() {
            // const materialTypes = (await axios.get(route("materialType.all"))).data;
            this.materialTypes = materialTypes.data;
        },
    },
}

</script>

<style lang="css">
.navbar-vertical .navbar-brand-img,
.navbar-vertical .navbar-brand>img {
    max-width: 100%;
    max-height: none;
    margin-top: -60px;
    margin-left: -10px;
}

.navbar-vertical.navbar-expand-xs .navbar-collapse {
    margin-top: -50px;
}
</style>
