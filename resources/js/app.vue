<template>
    <div>here</div>
</template>

<script>
import { VueNestable } from 'vue-nestable'
export default {
    name: "app",

    components:[VueNestable],

    data() {
        return {
            fruits: [],
        };
    },

    created() {
        this.fetchFruit();
    },

    methods: {
        async fetchFruit() {
            await axios.get(`api/get-fruits`)
                .then(response => {
                    this.fruits = response.data;
                })

        },
    }


}
</script>

<style scoped>

</style>
