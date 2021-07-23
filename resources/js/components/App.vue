<template>
    <v-app>
        <v-container>
            <v-fade-transition mode="out-in">
                <router-view></router-view>
            </v-fade-transition>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        name: 'root',
    }
</script>
