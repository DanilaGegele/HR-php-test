<template>
    <header class="main-header">
        <div class="main-nav">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                            <router-link class="nav-item"
                                        active-class="active"
                                         to="/">
                                <span class="active-item-here"></span><i class="fa fa-dashboard mr-5"></i> <span>Список заказов</span>
                            </router-link>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
</template>

<script>


    export default {

        name: "menu-site",

    }
</script>

<style scoped>

</style>
