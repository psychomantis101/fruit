<template>
    <draggable
        class="dragArea"
        tag="ul"
        :list="fruits"
        :group="{ name: 'g1' }"
        item-key="name"
        @change="updateNesting"
    >
        <template #item="{ element }">
            <li>
                <p @dblclick="selectFruit(element.id)" style="cursor: move">{{ element.name }}</p>
                <nested-draggable :fruits="element.children"/>
            </li>
        </template>
    </draggable>

    <div class="modal-overlay" v-show="showEdit">
        <div class="modal">
            <h6>Edit</h6>
            <form>
                <div v-if="errors">
                    <ul v-for="error in errors">
                        {{error.toString()}}
                    </ul>
                </div>
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name"  v-model="selectedFruit.name">
                </div>
            </form>
            <button @click="updateFruit()">Save</button>
        </div>
    </div>
</template>
<script>
import draggable from "vuedraggable";
export default {
    name: "nested-draggable",
    props: {
        fruits: {
            required: true,
            type: Array
        }
    },
    components: {
        draggable
    },
    data() {
        return {
            showEdit: false,
            errors: [],
            selectedFruit:{'name':null}
        };
    },
    methods: {
        updateNesting() {
            console.log('here');
            axios.patch(`api/update-nesting`, {
                fruits:this.fruits
            })
        },

        updateFruit() {
            axios.patch(`api/update-fruit/` + this.selectedFruit.id, {
                name: this.selectedFruit.name
            }).then(response => {
                if (response.data === 'success') {
                    this.showEdit = false;
                }
            }).catch(e => {
                this.errors = e.response.data.errors;
            });
        },

        selectFruit(id) {
            this.selectedFruit = this.fruits.find(x => x.id === id);
            this.showEdit = true;
        }
    }
};
</script>
<style scoped>
.dragArea {
    min-height: 50px;
}
.modal-overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    background-color: #000000da;
}

.modal {
    text-align: center;
    background-color: white;
    height: 500px;
    width: 500px;
    margin-top: 10%;
    padding: 60px 0;
    border-radius: 20px;
}

h6 {
    font-weight: 500;
    font-size: 28px;
    margin: 20px 0;
}

p {
    font-size: 16px;
    margin: 20px 0;
}

button {
    cursor: pointer;
    background-color: #ac003e;
    width: 150px;
    height: 40px;
    color: white;
    font-size: 14px;
    border-radius: 16px;
    margin-top: 50px;
}
</style>
