<template>
    <header class="main-header">
        <div class="main-nav">
            <nav class="navbar navbar-expand-lg">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                            <router-link class="nav-item"
                                         active-class="active"
                                         tag="li"
                                         to="/">
                                <a class="nav-link">Список заказов</a>
                            </router-link>
                            <router-link class="nav-item"
                                         active-class="active"
                                         tag="li"
                                         to="/editProduct">
                                <a class="nav-link">Список продуктов</a>
                            </router-link>
                    </ul>
                    <div class="text-right nav-link">
                        <span class="nav-link">Температура в Брянске {{weather}} </span>
                    </div>
                </div>
            </nav>
        </div>

    </header>
</template>

<script>


    export default {
        data(){
            return {
                weather: ''
            }
        },
        name: "menu-site",
        mounted() {
            this.$nextTick(function () {
                /**
                 * Загрузить данные по определенному заказу
                 */
                axios.get('/api/v1/getWeather/')
                    .then(response => {
                        this.weather = response.data;
                    });
            });

        }

    }
</script>

<style scoped>

</style>
