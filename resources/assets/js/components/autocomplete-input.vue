<template>
    <div>
        <input v-bind:name="name" v-bind:class="cssclass" v-bind:style="cssstyle" v-model="input" v-on:keyup="keyup"
               v-on:focus="visible=true" v-on:blur="visible=false"/>
        <div v-show="visible" class="list-group" style="position: absolute; z-index: 1000">
            <a v-show="options.length!=0" v-for="option in options" class="list-group-item"
               v-on:clicked="clicked(option)">{{option}}</a>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        name: {required: true},
        cssclass: {required: false},
        cssstyle: {required: false},
        url: {required: true},
        field: {required: true},
        keys: {
            type: Array,
            required: true
        }
    },
    data: function () {
        return {input: "", options: [], visible: false}
    },
    methods: {
        clicked: function (item) {
            this.$emit('clicked', item);
        },
        keyup: function (event) {
            if (this.keys.indexOf(event.keyCode) !== -1) {
                this.$emit('keyup', {input: this.input});
                this.input = "";
            }
        }
    },
    watch: {
        input: _.debounce(function (input) {
            self = this;
            axios.get(this.url + '?' + this.field + '=' + encodeURI(this.input)).then(function (response) {
                self.options = response.data;
            }, 1, {maxWait: 2});
        })
    }
}
</script>