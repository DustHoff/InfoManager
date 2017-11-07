<template>
    <div>
        <input v-bind:name="name" v-bind:class="cssclass" v-bind:style="cssstyle" v-model="input" v-on:keyup="keyup"
               v-on:focus="toggle" v-on:blur="toggle"/>
        <ul v-show="visible" class="list-group" style="position: absolute; z-index: 1000">
            <li href="#" v-show="options.length!=0" v-for="option in options" class="list-group-item"
                v-on:click="clicked(option)">{{option}}
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    props: {
        name: {required: true},
        cssclass: {required: false},
        cssstyle: {required: false},
        url: {required: false},
        field: {required: false},
        keys: {
            type: Array,
            required: true
        }
    },
    data: function () {
        return {input: "", options: [], visible: false}
    },
    methods: {
        toggle: function () {
            self = this;
            _.delay(function () {
                self.visible = !self.visible;
            }, 500);
        },
        clicked: function (item) {
            this.input = "";
            this.$emit('clicked', {input: item});
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
            if (this.url == null) return;
            self = this;
            axios.get(this.url + '?' + this.field + '=' + encodeURI(this.input)).then(function (response) {
                self.options = response.data;
            }, 1, {maxWait: 2});
        })
    }
}
</script>