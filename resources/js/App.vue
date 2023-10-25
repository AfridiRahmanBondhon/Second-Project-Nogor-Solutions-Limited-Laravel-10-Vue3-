<template>
    <header>

        <div class="wrapper">

            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <RouterLink class="navbar-brand" to="/">Navbar</RouterLink>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <RouterLink class="nav-link" to="/">Home</RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink class="nav-link" to="/about">About Us</RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink class="nav-link" to="/nogor">Nogor</RouterLink>
                            </li>
                            <li class="nav-item">
                                <RouterLink class="nav-link" to="/profile">User Profile</RouterLink>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <RouterView/>
    <!--<ExampleComponent />-->
</template>

<script>
    import { RouterLink, RouterView } from 'vue-router'
    /*import ExampleComponent from "./components/ExampleComponent.vue";*/
    export default {
        name: "App",
        components:{
            /*ExampleComponent*/
            RouterLink,
            RouterView,
        }
    }
</script>

<style scoped>

</style>
