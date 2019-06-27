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
                    <div class="text-right">
                        Температура в Брянске + {{weather}}
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
                 * Загрузить данные по определённому заказу
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
