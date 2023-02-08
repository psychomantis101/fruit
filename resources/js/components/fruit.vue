<template>
    <div>
        <h3>Fruits -- double click to edit name. drag and drop to change nesting</h3>
        <nested-draggable :fruits="list" />
    </div>
</template>

<script>
import nestedDraggable from "./nested";
export default {
    name: "nested-example",
    display: "Nested",
    order: 15,
    components: {
        nestedDraggable
    },
    data() {
        return {
            list: [],
            showEdit: false,
            errors: [],
            selectedFruit:null
        };
    },
    created() {
        this.fetchFruit();
    },

    methods:{
        async fetchFruit() {
            await axios.get(`api/get-fruits`)
                .then(response => {
                    this.list = response.data;
                })
        },

        updateFruit() {
            axios.patch(`api/update-fruit`, {
                fruit:this.selectedFruit['id'],
                name:this.selectedFruit['name']
            })
        }
    }
};
</script>
<style scoped>
</style>
