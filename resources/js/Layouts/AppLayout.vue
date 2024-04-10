<template>
    <div>
        <div class="d-flex flex-column content-container">
            <div class="flex-grow-1">
                <Head :title="title ? title : 'IMake'">
                    <link rel="icon" type="image/svg+xml" href="/img/logo/logoN.png" />
                    <slot name="meta_head" />
                </Head>
                <SideBar />
                <div class="main-content" id="panel">
                    <NavBar />
                    <slot name="header" />
                    <div class="container-fluid mt--6">
                        <slot name="content" />
                    </div>
                </div>
                <slot name="modals" />
            </div>
            <Footer />
        </div>
        <Notification ref="notification" />
        <Loader ref="loader" />
    </div>
</template>



<script>
import { Head, Link } from '@inertiajs/vue3'
import SideBar from '@/Components/Main/SideBar.vue';
import NavBar from '@/Components/Main/NavBar.vue';
import Notification from '@/Components/Basic/Notification.vue';
import Loader from '@/Components/Basic/LoadingBar.vue';
import Footer from '@/Components/Main/Footer.vue';


export default {
    components: {
        Head,
        Link,
        SideBar,
        NavBar,
        Notification,
        Loader,
        Footer,
    },
    props: {
        title: String,
    },
    data() {

    },
    mounted() {
        this.$root.notify = this.$refs.notification
        this.$root.loader = this.$refs.loader
    },
    methods: {

    },
}
</script>

<style lang="scss">
body, html {
    height: 100%;
    margin: 0;
}

.content-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

.flex-grow-1 {
    flex-grow: 1;
}
body {
    background-image: url('@/../src/img/banner/bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
}

.bg-header {
    background-color: #55699f;
}

.table-responsive {
    overflow: auto;
}
</style>
